<?php
namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Dotenv\Dotenv;

if (!isset($_ENV['MAIL_MAILER'])) {
    $dotenv = Dotenv::createImmutable(dirname(__DIR__));
    $dotenv->load();
}

define('MAIL_HOST', $_ENV['MAIL_HOST']);
define('MAIL_USERNAME', $_ENV['MAIL_USERNAME']);
define('MAIL_PASSWORD', $_ENV['MAIL_PASSWORD']);
define('MAIL_PORT', $_ENV['MAIL_PORT']);

class Email {
    public $nombre;
    public $apellido;
    public $email;
    public $token;

    public function __construct($nombre, $apellido, $email, $token) {
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->email = $email;
        $this->token = $token;
    }

    public function enviarConfirmacion() {
        $mail = new PHPMailer();
    
        try {
            //Server settings
            $mail->isSMTP();
            $mail->Host = MAIL_HOST;
            $mail->SMTPAuth = true;
            $mail->Username = MAIL_USERNAME;
            $mail->Password = MAIL_PASSWORD;
            $mail->Port = MAIL_PORT;
        
            //Recipients
            $mail->setFrom('admin@taskly.com', 'Taskly');
            $mail->addAddress($this->email, $this->nombre . " " . $this->apellido);
        
            //Content
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';
            $mail->Subject = 'Confirma tu cuenta';

            $contenido = "<html>";
            $contenido .= "<p><strong>Hola, " . $this->nombre . " " . $this->apellido . "</strong>. Has creado tu cuenta en Taskly
            , solo debes confirmarla presionando el siguiente enlace</p>";
            $contenido .= "<p>Presiona aquí: <a href='http://localhost:3000/confirmar-cuenta?token=" . $this->token . "'>Confirmar cuenta</a></p>";
            $contenido .= "</html>"; 

            $mail->Body = $contenido;
        
            return $mail->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
