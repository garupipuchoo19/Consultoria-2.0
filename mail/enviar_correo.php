<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/PHPMailer/Exception.php';
require __DIR__ . '/PHPMailer/PHPMailer.php';
require __DIR__ . '/PHPMailer/SMTP.php';

/* =====================================
   CORREO AL CLIENTE
   ===================================== */
function enviarCorreoConfirmacion($correoDestino) {

    $mail = new PHPMailer(true);

    try {
        // CONFIG SMTP GMAIL
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'luxprower19@gmail.com';   // correo empresa
        $mail->Password   = 'izwqdsujyftwnpkg';       // 🔐 contraseña de aplicación
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // REMITENTE
        $mail->setFrom('luxprower19@gmail.com', 'Consultoría Tech');
        $mail->addAddress($correoDestino);

        // CONTENIDO
        $mail->isHTML(true);
        $mail->Subject = 'Hemos recibido tu mensaje';
        $mail->Body = "
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

/* =====================================
   CORREO AL ADMIN
   ===================================== */
function enviarCorreoAdmin($mensaje) {

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'luxprower19@gmail.com';
        $mail->Password   = 'izwqdsujyftwnpkg';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        $mail->setFrom('luxprower19@gmail.com', 'Chatbot');
        $mail->addAddress('crizaak@gmail.com'); // admin

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
