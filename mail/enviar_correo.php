<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/PHPMailer/Exception.php';
require __DIR__ . '/PHPMailer/PHPMailer.php';
require __DIR__ . '/PHPMailer/SMTP.php';

function enviarCorreoConfirmacion($correoDestino) {

    $mail = new PHPMailer(true);

    try {
        // CONFIG SMTP GMAIL
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'TU_CORREO@gmail.com';      // 🔴 cambia
        $mail->Password   = 'TU_APP_PASSWORD';          // 🔴 cambia
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // REMITENTE
        $mail->setFrom('TU_CORREO@gmail.com', 'Consultoría Tech');
        $mail->addAddress($correoDestino);

        // CONTENIDO
        $mail->isHTML(true);
        $mail->Subject = 'Hemos recibido tu mensaje';
        $mail->Body    = "
          <h3>Gracias por contactarnos 👋</h3>
          <p>Hemos recibido tu información correctamente.</p>
          <p>Un asesor se pondrá en contacto contigo a la brevedad.</p>
          <br>
          <small>Consultoría Tech</small>
        ";

        $mail->send();
        return true;

    } catch (Exception $e) {
        return false;
    }
}
