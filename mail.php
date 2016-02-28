<?
//mail variables:
$host = "smtp.mail.yahoo.com"; // smtp.gmail.com
$port = "25"; //465 for gmail
$username = "studentutilities@yahoo.com"; // example@gmail.com
$password ="Tc&Tt&C@s_Utilities"; // gmail password
$from_name = "Student Utilities"; //your name
#$email="makrandgupta@hotmail.com"; // Recipients email ID
#$name="Test"; // Recipient's name
#$subject = "Testing the PHPMailer"; //subject of message
#$body = "hullo"; // body of message
$custom_header = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$custom_header .= "From: ".$username . "\r\n";
$custom_header .= 'X-Mailer: PHP/' . phpversion();

//put the variables into the main mail variable and adust the settings
require('phpmailer/class.phpmailer.php');

$mail=new PHPMailer();
$mail->IsSMTP(); // send via SMTP
$mail->SMTPSecure = "ssl";  
$mail->Host=$host;  
$mail->Port=$port;   
$mail->Username   = $username ;// SMTP account username  
$mail->Password   = $password;  
$mail->SMTPKeepAlive = true;  
$mail->Mailer = "smtp"; 
$mail->IsSMTP(); // telling the class to use SMTP  
$mail->SMTPAuth   = true;                  // enable SMTP authentication  
$mail->CharSet = 'utf-8';  
$mail->SMTPDebug  = 0; 
$mail->From = $username;
$mail->FromName = $from_name;
$mail->AddAddress($email,$name);
$mail->AddReplyTo($username,$from_name);
$mail->WordWrap = 50; // set word wrap
//$mail->AddAttachment("/var/tmp/file.tar.gz"); // attachment
//$mail->AddAttachment("/tmp/image.jpg", "new.jpg"); // attachment
$mail->IsHTML(true); // send as HTML
$mail->Subject = $subject;
$mail->Body =$body; //HTML Body

//send the mail!
if(!$mail->Send())
{
echo "Mailer Error: " . $mail->ErrorInfo;
$error=1;
}
else
{
$error=0;
}
?> 