<?php

namespace Controllers;

use Model\Usuario;
use MVC\Router;
use Google\Client;
use Google\Service\Oauth2;
use Model\Alumno;

class AuthController
{
    public static function login(Router $router)
    {
        $alertas = [];
        session_start();
        // Configurar el cliente de Google
        $client = new Client();
        $client->setClientId('231516255944-7s3l5k9r2pguf7qi491u7d2t5sa8tahi.apps.googleusercontent.com'); // Reemplaza con tu ID de cliente
        $client->setClientSecret('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'); // Reemplaza con tu secreto de cliente
        $client->setRedirectUri('http://localhost:3000/'); // URL de redireccionamiento
        $client->addScope('email');
        $client->addScope('profile');

        // Si recibimos un código de autorización de Google
        if (isset($_GET['code'])) {
            $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
            $client->setAccessToken($token);
            // Obtener información del usuario
            $oauth = new Oauth2($client);
            $userInfo = $oauth->userinfo->get();
            $fotoPerfilUrl = $userInfo->picture;
            //debuguear($fotoPerfilUrl);

            // Verificar si el usuario ya existe en tu base de datos
            $usuario = Usuario::where('email', $userInfo->email);
            $alumno = Alumno::where('correo', $userInfo->email);

            if ($usuario || $alumno) {
                if ($usuario->tipo === "Admin" || $usuario->tipo === "CT") {
                    $_SESSION['foto'] = $fotoPerfilUrl;
                    $_SESSION['id'] = $usuario->id;
                    $_SESSION['nombre'] = $usuario->nombre;
                    $_SESSION['apellidos'] = $usuario->apellidos;
                    header("Location: /admin");
                } else {
                    $_SESSION['foto'] = $fotoPerfilUrl;
                    $_SESSION['id'] = $alumno->id;
                    $_SESSION['nombre'] = $alumno->nombre;
                    $_SESSION['apellidos'] = $alumno->apellidos;
                    header("Location: /evaluacion");
                }
            } else {
                Usuario::setAlerta('error', 'No existe una cuenta con este correo');
            }
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new Usuario($_POST);
            $alertas = $auth->validarLogin();
            $usuario = Usuario::where('email', $auth->email);
            $alumno = Alumno::where('correo', $auth->email);

            //Si existe un usuario
            if ($usuario || $alumno) {
                if ($usuario->password === $auth->password || $alumno->password === $auth->password) {
                    if ($usuario->tipo === "Admin" || $usuario->tipo === "CT") {
                        //Admin
                        $_SESSION['id'] = $usuario->id;
                        $_SESSION['nombre'] = $usuario->nombre;
                        $_SESSION['apellidos'] = $usuario->apellidos;
                        header("Location: /admin");
                    } else {
                        session_start();
                        $_SESSION['id'] = $alumno->id;
                        $_SESSION['nombre'] = $alumno->nombre;
                        $_SESSION['apellidos'] = $alumno->apellidos;
                        header('Location: /evaluacion');
                    }
                } else {
                    Usuario::setAlerta('error', 'Contraseña incorrecta');
                }
            } else {
                Usuario::setAlerta('error', 'El usuario no existe');
            }
        }

        $alertas = Usuario::getAlertas();
        $router->render('auth/login', [
            'alertas' => $alertas,
            'client' => $client
        ]);
    }
    
    public static function logout(){
        $_SESSION = [];
        header('Location: /');
    }
}
