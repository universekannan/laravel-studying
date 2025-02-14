<?php
$token = 'qgdRfyBz81cmhKdNREEW9Mb3Ztiiimp66EoUXJ2uPILfvXCljmGomkWPmPBR';
$mobile = mysql_real_escape_string($_POST['phone']);
$msg = mysql_real_escape_string($_POST['message']);
$site = 'http://localhost/sms/';
$url = "http://api.fast2sms.com/sms.php?token=".$token."&mob=".$mobile."&mess=".$msg."&sender=".$site."&route=0";
$homepage = file_get_contents($url);
if($homepage)
{
  echo "Message Send Compleated...";
}
else{
  echo "Something Went Wrong...";
}
?>
