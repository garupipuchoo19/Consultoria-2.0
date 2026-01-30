<?php

require_once __DIR__ . '/PHPMailer/src/Exception.php';
require_once __DIR__ . '/PHPMailer/src/PHPMailer.php';
require_once __DIR__ . '/PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

/* =====================================
   CORREO DE CONFIRMACIÓN AL CLIENTE
   ===================================== */
function enviarCorreoConfirmacion($correoDestino) {

    $mail = new PHPMailer(true);

    try {
        // CONFIG SMTP GMAIL
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'consultoriaubam1987@gmail.com';
        $mail->Password   = 'izwqdsujyftwnpkg';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // REMITENTE
        $mail->setFrom('consultoriaubam1987@gmail.com', 'Consultoría Tech');
        $mail->addAddress($correoDestino);

        // CONTENIDO
        $mail->isHTML(true);
        $mail->Subject = 'Hemos recibido tu mensaje';
        $mail->Body = "
            <h3>Gracias por contactarnos 👋</h3>
            <p>Tu información fue recibida correctamente.</p>
            <p>Un asesor se pondrá en contacto contigo.</p>
            <br>
            <small>Consultoría Tech</small>
        ";

        $mail->send();
        return true;

    } catch (Exception $e) {
        return false;
    }
}

/* =====================================
   CORREO AL ADMIN
   ===================================== */
function enviarCorreoAdmin($mensaje) {

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'consultoriaubam1987@gmail.com';
        $mail->Password   = 'izwqdsujyftwnpkg';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        $mail->setFrom('consultoriaubam1987@gmail.com', 'Chatbot');
        $mail->addAddress('crizaak@gmail.com');

        $mail->isHTML(true);
        $mail->Subject = 'Nuevo mensaje del chatbot';
        $mail->Body = "
            <p><strong>Nuevo mensaje recibido:</strong></p>
            <p>$mensaje</p>
        ";

        $mail->send();

    } catch (Exception $e) {
        // silencioso
    }
}
