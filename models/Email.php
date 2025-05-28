<?php

namespace Model;

require '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;

class Email
{
    protected $email;
    protected $nombre;
    public function __construct($email, $nombre)
    {
        $this->email = $email;
        $this->nombre = $nombre;
    }

    public function enviarCorreo()
    {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Port = 587;
        $mail->Username = 'rodrigochg17@gmail.com';
        $mail->Password = 'ipjfiygebyetesup';

        $mail->setFrom('EvaluacionTutorias@itstacambaro.com');
        $mail->addAddress(trim($this->email));
        $mail->Subject = 'Reporte de Evaluacion de Tutorias del ITST';

        $mail->AddAttachment('EvaluacionTutorias.pdf');
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';
        $contenido = '<html>';
        $contenido .= "<p><strong>Hola " . $this->nombre . " </strong>Se te ha enviado tu reporte de evaluación de tutorías.</p>";
        $contenido .= "</html>"; 
        $mail->Body = $contenido;
        $mail->send();
        //Eliminamos el archivo PDF
        unlink('EvaluacionTutorias.pdf');
    }
    public function correoRegistro($password)
    {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Port = 587;
        $mail->Username = 'rodrigochg17@gmail.com';
        $mail->Password = 'ipjfiygebyetesup';

        $mail->setFrom('EvaluacionTutorias@itstacambaro.com');
        $mail->addAddress(trim($this->email));
        $mail->Subject = 'Evaluacion de tutorias del ITST';
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';
        $contenido = '<html>';
        $contenido .= "<p><strong>Hola " . $this->nombre . " </strong></p>";
        $contenido .= "<p>Haz recibido este correo del Instituto Tecnologico Superior de Tacambaro para que puedar realizar tu evaluacion de tutorias</p>";
        $contenido .= "<p>Tu correo es: <strong>" . $this->email . " </strong></p>";
        $contenido .= "<p>Tu contraseña es: <strong>" . $password . " </strong></p>";
        $contenido .= "<a href='http://192.168.21.106:3000/'>Haz clic aqui para realizar tu evaluacion</a>";
        $contenido .= "</html>"; 
        $mail->Body = $contenido;
        $mail->send();
        //Eliminamos el archivo PDF
        unlink('EvaluacionTutorias.pdf');
    }
    public function correoEvaluacionRealizada()
    {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Port = 587;
        $mail->Username = 'rodrigochg17@gmail.com';
        $mail->Password = 'ipjfiygebyetesup';

        $mail->setFrom('EvaluacionTutorias@itstacambaro.com');
        $mail->addAddress(trim($this->email));
        $mail->Subject = 'Evaluacion de tutorias del ITST';
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';
        $contenido = '<html>';
        $contenido .= "<p><strong>Hola " . $this->nombre . " </strong></p>";
        $contenido .= "<p>Por este medio le informo que has completado la evaluación correctamente.</p>";
        $contenido .= "<p>Saludos cordiales</p>";
        $contenido .= "<p>Instituto Tecnologico Superior de Tacambaro</p>";
        $contenido .= "</html>"; 
        $mail->Body = $contenido;
        $mail->send();
    }
}
