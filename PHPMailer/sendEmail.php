<?php
function sendMail($mailTo, $bodyContent, $mailSubject) {
    require 'PHPMailer/PHPMailerAutoload.php';

    $mail = new PHPMailer;

    $mail->isSMTP();                                   // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';                    // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                            // Enable SMTP authentication
    $mail->Username = 'tranngochung1302@gmail.com';          // SMTP username
    $mail->Password = 'abcd@1234'; // SMTP password
    $mail->SMTPSecure = 'tls';                         // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                 // TCP port to connect to

    $mail->setFrom('tranngochung1302@gmail.com', 'DCT SPORTS');
    $mail->addReplyTo('tranngochung1302@gmail.com', 'DCT SPORTS');
    $mail->addAddress($mailTo);   // Add a recipient
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    $mail->isHTML(true);  // Set email format to HTML
    $mail->Subject = $mailSubject;
    $mail->Body = $bodyContent;

    if (!$mail->send()) {
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo "success";
    }
}
sendMail('tranngochung13021998@gmail.com','gửi ngày', 'tranngochung1302@gmail.com');
?>

