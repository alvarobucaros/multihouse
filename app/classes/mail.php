<?php
use  PHPMailer \ PHPMailer \ PHPMailer ; 
use  PHPMailer \ PHPMailer \ Exception ;

require_once( 'Exception.php');
require_once( 'PHPMailer.php');
require_once( 'SMTP.php');

$mail = new PHPMailer();


try {
    //$mail = new PHPMailer(); //New instance, with exceptions enabled

    $to = 'alvaro.oycsoft@gmail.com';
	$mail->AddAddress($to);
	$mail->From  = 'alvarobucaros@hotmail.com'; //$_POST['femail'];
        $mail->FromName  = 'AlvaroOrtiz ';//$_POST['name'];
	$mail->Subject  = "Test Email using PHP";
        $mensaje = $mail->Subject;
	$body   = "<table>
                <tr>
                    <th colspan='2'>El mensaje</th>
                 </tr>

                 <tr>
                    <td style='font-weight:bold'>Usuario :</td>
                        <td>".'AlvaroOrtiz '."</td>
                 </tr>

                 <tr>
                  <td style='font-weight:bold'>E-mail : </td>
                  <td>".'alvaro.oycsoft@gmail.com'."</td>
                </tr>

                <tr>
                  <td style='font-weight:bold'>Celular : </td>
                  <td>".'3174142133'."</td>
                </tr>

                <tr>
                  <td style='font-weight:bold'>Texto : </td>
                  <td>".$mensaje."</td>
                </tr>
<table>";
	$body = preg_replace('/\\\\/','', $body); //Strip backslashes
echo $body;
	$mail->MsgHTML($body);

	$mail->IsSMTP();                           // tell the class to use SMTP
	$mail->SMTPAuth   = true;                  // enable SMTP authentication
	$mail->Port       = 25;                    // set the SMTP server port
	//$mail->Host       = "mail.yourdomain.com"; // SMTP server
	//$mail->Username   = "name@domain.com";     // SMTP server username
	//$mail->Password   = "password";            // SMTP server password

	$mail->IsSendmail();  // tell the class to use Sendmail
	$mail->AddReplyTo("admin@smarttutorials.net");
	$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
	$mail->WordWrap   = 80; // set word wrap

//	$mail->AddAttachment($_FILES['image']['tmp_name'],
//                         $_FILES['image']['name']);
	$mail->IsHTML(true); // send as HTML
	$mail->Send();
	echo 'Ha sido enviado...';
} catch (phpmailerException $e) {
	echo $e->errorMessage();
}
?>
