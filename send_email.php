<?php
    ini_set( 'display_errors', 1 );
    error_reporting( E_ALL );
    error_reporting(1);
    $from = "tranngochung1302@gmail.com";
    $to = "tranngochung13021998@gmail.com";
    $subject = "Checking PHP mail";
    $message = "PHP mail works just fine";
    $headers = "From:" . $from;
    $send = mail($to,$subject,$message, $headers);
    echo "The email message was sent.";
    if($send){
echo "Gui email thanh cong";
}else{
	echo "Khong gui duoc email";
}
?>