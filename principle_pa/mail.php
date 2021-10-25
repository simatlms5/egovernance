<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include('../principal/vendor/autoload.php');

function smtp_mailer($to,$subject,$name,$docno){
$mail = new PHPMailer(true);

try {
    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();    
    
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );
    
    //Send using SMTP
    $mail->Host       = 'localhost';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = false;                                   //Enable SMTP authentication
    $mail->Username   = 'egov@simat.ac.in';                     //SMTP username
    $mail->Password   = 'simat123#';                               //SMTP password
    // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    $mail->isSendmail();

    //Recipients
    $mail->setFrom('egov@simat.ac.in', 'E-Governance');
    $mail->addAddress($to,$name);     
              
   
   
     

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = 'Your Certificate application has been Approved. Please loging to E-Governance portal to download the certificate using your <b>Document Number  : ';
    $mail->Body .= $docno;
    $mail->Body .= '</b> and <b>Admission Number</b>. Or Click this link below : <br>http://simat.ac.in/simatlms/studentModule/certdownload.php?docno='.$docno.' <br><br><br> This is an auto-generated message hence there is no need to reply.';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

}