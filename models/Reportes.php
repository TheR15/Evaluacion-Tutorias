<?php

namespace Model;

use CpChart\Data;
use CpChart\Image;
use Dompdf\Dompdf;

class Reportes
{
    public static function generarGrafica($datos, $pregunta)
    {
        $data = new Data();
        if ($pregunta == 1) {
            $data->addPoints([$datos['totalOpcion5Pregunta1'], $datos['totalOpcion4Pregunta1'], $datos['totalOpcion3Pregunta1'], $datos['totalOpcion2Pregunta1'], $datos['totalOpcion1Pregunta1']], "Alumnos");
        }
        if ($pregunta == 2) {
            $data->addPoints([$datos['totalOpcion5Pregunta2'], $datos['totalOpcion4Pregunta2'], $datos['totalOpcion3Pregunta2'], $datos['totalOpcion2Pregunta2'], $datos['totalOpcion1Pregunta2']], "Alumnos");
        }
        if ($pregunta == 3) {
            $data->addPoints([$datos['totalOpcion5Pregunta3'], $datos['totalOpcion4Pregunta3'], $datos['totalOpcion3Pregunta3'], $datos['totalOpcion2Pregunta3'], $datos['totalOpcion1Pregunta3']], "Alumnos");
        }
        if ($pregunta == 4) {
            $data->addPoints([$datos['totalOpcion5Pregunta4'], $datos['totalOpcion4Pregunta4'], $datos['totalOpcion4Pregunta4'], $datos['totalOpcion2Pregunta4'], $datos['totalOpcion1Pregunta4']], "Alumnos");
        }
        $data->addPoints(["Opcion 5", "Opcion 4", "Opcion 3", "Opcion 2", "Opcion 1"], "Opciones");
        $data->setSerieDescription("Opciones", "Opciones");
        $data->setAbscissa("Opciones");

        // Configurar paleta de colores - AZUL FUERTE para todas las barras
        $data->setPalette("Alumnos", [
            "R" => 0,
            "G" => 0,
            "B" => 255,
            "Alpha" => 100  // Azul fuerte RGB(0, 0, 255)
        ]);

        /* Create the Image object */
        $image = new Image(1000, 400, $data);
        // Fondo blanco sólido (eliminando los gradientes grises)
        $image->drawFilledRectangle(0, 0, 1000, 400, [
            "R" => 255,
            "G" => 255,
            "B" => 255,
            "Alpha" => 100
        ]);

        $image->setFontProperties(["FontName" => "calibri.ttf", "FontSize" => 15]);
        /* Draw the chart scale */
        $image->setGraphArea(100, 30, 1000, 400);
        $image->drawScale([
            "CycleBackground" => true,
            "DrawSubTicks" => true,
            "GridR" => 0,
            "GridG" => 0,
            "GridB" => 0,
            "GridAlpha" => 10,
            "Pos" => SCALE_POS_TOPBOTTOM
        ]);

        /* Turn on shadow computing */
        $image->setShadow(true, ["X" => 1, "Y" => 1, "R" => 253, "G" => 254, "B" => 254, "Alpha" => 10]);
        /* Draw the chart */
        $image->drawBarChart([
            "DisplayPos" => LABEL_POS_INSIDE,
            "DisplayValues" => true,
            "Rounded" => true,
            "Surrounding" => 30,
            "DisplayColor" => DISPLAY_MANUAL,  // Permite configurar el color manualmente
            "FontColor" => ["R" => 255, "G" => 255, "B" => 255, "Alpha" => 100]  // Blanco puro
        ]);

        /* Write the legend */
        $image->drawLegend(570, 215, ["Style" => LEGEND_NOBORDER, "Mode" => LEGEND_HORIZONTAL]);

        /* Render to variable */
        ob_start();
        if ($pregunta == 1) {
            $image->render("P1" . $datos['tipo'] . ".png"); // Especificar un archivo de salida
            $rutaImagen = "P1" . $datos['tipo'] . ".png";
        }
        if ($pregunta == 2) {
            $image->render("P2" . $datos['tipo'] . ".png"); // Especificar un archivo de salida
            $rutaImagen = "P2" . $datos['tipo'] . ".png";
        }
        if ($pregunta == 3) {
            $image->render("P3" . $datos['tipo'] . ".png"); // Especificar un archivo de salida
            $rutaImagen = "P3" . $datos['tipo'] . ".png";
        }
        if ($pregunta == 4) {
            $image->render("P4" . $datos['tipo'] . ".png"); // Especificar un archivo de salida
            $rutaImagen = "P4" . $datos['tipo'] . ".png";
        }
        $imageData = ob_get_clean();
        return $rutaImagen;
    }

    public static function generarPDF($datos, $rutaImagen1, $rutaImagen2, $rutaImagen3, $rutaImagen4, $metodo, $tipo)
    {
        setlocale(LC_TIME, 'es_Mx.UTF-8');
        $fecha = strftime('%A, %e de %B del %Y');

        $imagePathLogo = 'build/img/logos.png';
        $imageDataLogo = base64_encode(file_get_contents($imagePathLogo));
        $imageSrcLogo = 'data:image/png;base64,' . $imageDataLogo;

        $rutaImagen1 = $_SERVER['DOCUMENT_ROOT'] . "/$rutaImagen1";
        $imagePath1 = $rutaImagen1;
        $imageData1 = base64_encode(file_get_contents($imagePath1));
        $imageSrc1 = 'data:image/png;base64,' . $imageData1;

        $rutaImagen2 = $_SERVER['DOCUMENT_ROOT'] . "/$rutaImagen2";
        $imagePath2 = $rutaImagen2;
        $imageData2 = base64_encode(file_get_contents($imagePath2));
        $imageSrc2 = 'data:image/png;base64,' . $imageData2;

        $rutaImagen3 = $_SERVER['DOCUMENT_ROOT'] . "/$rutaImagen3";
        $imagePath3 = $rutaImagen3;
        $imageData3 = base64_encode(file_get_contents($imagePath3));
        $imageSrc3 = 'data:image/png;base64,' . $imageData3;

        $rutaImagen4 = $_SERVER['DOCUMENT_ROOT'] . "/$rutaImagen4";
        $imagePath4 = $rutaImagen4;
        $imageData4 = base64_encode(file_get_contents($imagePath4));
        $imageSrc4 = 'data:image/png;base64,' . $imageData4;

        // Verifica si la imagen existe
        if (!file_exists($rutaImagen1)) {
            echo "La imagen no existe en la ruta: " . $rutaImagen1;
            return;
        }
        // instantiate and use the dompdf class
        $dompdf = new Dompdf();
        $html = "
        <html>
        <head>
            <meta charset='UTF-8'>
        </head>
        <body>
            <style>
                .fecha{
                    font-size: 15px;
                    text-align: right;
                    margin-bottom:10px;
                    margin-top:10px;
                }
                .logo img {
                    width: 125px;
                }

                .aa img{
                    width: 500px;
                }
                .logo {
                    text-align: right; /* Alinea el contenido a la derecha */
                }
                .logo-left {
                    text-align: left; /* Alinea el contenido a la izquierda */
                }
                .preguntas {
                    max-width: 100%; /* La imagen no superará el ancho disponible */
                    height: auto; /* Mantiene la proporción de la imagen */
                    display: block; /* Centra la imagen horizontalmente */
                    margin: 0 auto; /* Centra la imagen horizontalmente */
                    margin-bottom: 110px; /* Espacio entre imágenes */
                }
            </style>
            <div class='logo'>
                <div class='logo-left'>
                    <img src='$imageSrcLogo' alt='Logo' style='width:100%;'>
                </div>
            </div>
            <h2 class='fecha' style='font-size:15px;'>Instituto Tecnologico Superior de Tacambaro</h2>
            <h2 class='fecha'>$fecha</h2>
            <h2 style='font-size:15px;'>$tipo: <span style='font-weight:800;'>" . $datos['tipo'] . "</span></h2>
            <h2 style='font-size:15px;'>Promedio: <span style='font-weight:800;'>" . $datos['promedio'] . "</span></h2> 
            <h3>Pregunta 1</h3>
            <p>Genera un clima de confianza que permite el logro de los propositos de la tutoria</p>
            <img class='preguntas' src='$imageSrc1' alt='Imagen de ejemplo' style='max-width: 100%; height: auto; display: block; margin: 0 auto;'>
            <h3>Pregunta 2</h3>
            <p>Calidad de la informacion proporcionada al tutorado</p>
            <img class='preguntas' src='$imageSrc2' alt='Imagen de ejemplo' style='max-width: 100%; height: auto; display: block; margin: 0 auto;'>
            <h3>Pregunta 3</h3>
            <p>Disponibilidad y calidad en la atención tutorial</p>
            <img class='preguntas' src='$imageSrc3' alt='Imagen de ejemplo' style='max-width: 100%; height: auto; display: block; margin: 0 auto;'>
            <h3>Pregunta 4</h3>
            <p>Planeación y preparación en los procesos de la Tutoria</p>
            <img class='preguntas' src='$imageSrc4' alt='Imagen de ejemplo' style='max-width: 100%; height: auto; display: block; margin: 0 auto;'>";

        if($tipo === 'Tutor'){
            $html .= "
            <h3>Comentarios de los alumnos</h3>
            <p>". $datos['comentarios'] . "</p>
            ";
        }

        $html .= "
            <div style='margin-top:150px; text-align: center;'>
                <hr style='width:250px;'></hr
                <p style=''>Atentamente</p>
                <p style=''>MTI. Adrian Silviano Mandujano Reguera</p>
            </div>
        </body>
        </html>";
        $dompdf->loadHtml($html);

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        if ($metodo === "descarga") {
            $dompdf->stream();
        }

        if ($metodo === "correo") {
            $reportePDF = $dompdf->output();
            // Guardar en el servidor
            file_put_contents('EvaluacionTutorias.pdf', $reportePDF);
        }

        unlink($rutaImagen1);
        unlink($rutaImagen2);
        unlink($rutaImagen3);
        unlink($rutaImagen4);
    }
}
