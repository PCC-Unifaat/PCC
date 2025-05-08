<?php
namespace Classes\Models;

require 'vendor/autoload.php';
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
class EmailModel{

		public $opt,$mailer;
		public $email = 'recuperacao@paginasdotempo.com.br';//Trocar e-mail aqui!
		public $senha = "\qXI:-K'jR(5Pe$";//Trocar senha aqui!

		public static function sendEmail($to,$assunto,$mensagem,$altMensagem){
			
			$mail = new PHPMailer(true);

			try {
				//Server settings
				//$mail->SMTPDebug = SMTP::DEBUG_SERVER;                    //Enable verbose debug output
				$mail->isSMTP();                                            //Send using SMTP
				$mail->Host       = 'smtp.titan.email';                     //Set the SMTP server to send through
				$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
				$mail->Username   = EMAIL_VERIFICACAO;    //SMTP username
				$mail->Password   = "\qXI:-K'jR(5Pe$";                      //SMTP password
				$mail->SMTPSecure = 'tsl';            						//Enable implicit TLS encryption
				$mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
				
				//Recipients
				$mail->setFrom(EMAIL_VERIFICACAO, 'MedClock');
				$mail->addAddress($to);     //Add a recipient
				 

				//Attachments
				//$mail->addAttachment(INCLUDE_PATH_STATIC.'images/logo/webp');         //Add attachments
				//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    				//Optional name

				//Content
				$mail->isHTML(true);                                  //Set email format to HTML
				$mail->Subject = $assunto;
				$mail->Body    = $mensagem;
				$mail->AltBody = $altMensagem;
				$mail->CharSet = "utf-8";
				$mail->send();
				
				return true;
			} catch (Exception $e) {
				return false;
			}
		}

		public static function htmlPageMail($token,$id,$tipo){
			
			if($tipo == 'autenticar-email'){
				$variaveis = ['$url' => INCLUDE_PATH.'autenticar?token='.$token.'&id='.$id];
				$html = file_get_contents(INCLUDE_PATH_STATIC.'pages/autenticar-email.html');
			}else if($tipo == 'recuperar-senha'){
				$variaveis = ['$url' => INCLUDE_PATH.'recuperar_senha?token='.$token.'&id='.$id];
				$html = file_get_contents(INCLUDE_PATH_STATIC.'pages/recuperar-senha.html');
			}else
				return false;
			
			$html = str_replace(array_keys($variaveis), array_values($variaveis), $html);
			return $html;
		}
	}
?>
