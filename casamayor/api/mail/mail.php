<?php
require("includes/class.phpmailer.php");
require_once("../utils/response.php");

class Mail
{
    // Atributos de usuario
    private $mail;
    
    public function __construct($title, $message, $email )
    {
        $this->mail = new PHPMailer();
        $this->mail->From = ("notificaciones@integradoramedica.com"); //Dirección desde la que se enviarán los mensajes. Debe ser la misma de los datos de el servidor SMTP.
        $this->mail->FromName = "Notificaciones OMA";
        $this->mail->AddAddress( $email ); // Dirección a la que llegaran los mensajes.

        $this->mail->CharSet = 'UTF-8';
        $this->mail->WordWrap = 50;
        $this->mail->IsHTML(true);
        $this->mail->Subject  =  $title;
        $this->mail->Body     =  $message;
        $this->mail->SetLanguage("en");
        $this->mail->AddEmbeddedImage('../files/logo.png', 'logo');

        // Datos del servidor SMTP

        $this->mail->IsSMTP(); 
        $this->mail->Host = "smtp.office365.com:587";  // Servidor de Salida.
        // $this->mail->SMTPDebug = 2;
        $this->mail->SMTPSecure = "tls";
        $this->mail->SMTPAuth = true;
        $this->mail->Username = "notificaciones@integradoramedica.com";  // Correo Electrónico
        $this->mail->Password = "RhE4@*+CH23.m"; // Contraseña
    }
    public function embebedImage($path, $ref){
        $this->mail->AddEmbeddedImage($path, $ref);
    }
    public function send(){
        if( $this->mail->Send() ){
            $response = new response(null, true, null);
            print_r( json_encode( $response ) );
        }
        else{
            $response = new response(null, false, "Error: $mail->ErrorInfo");
            print_r( json_encode( $response ) );
        }
    }
}
?>
