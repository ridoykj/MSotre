<?php
// ------------------------------------------------------------------------------
$name = "";
$pass = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $_POST["email"];
}

// ------------------------------------------------------------------------------

$dbUserName = 'root';
$dbUserPass = '';
$dbServerHost = 'localhost';
$dbDataBaseName = 'alluserinfo';
// ------------------------------------------------------------------------------

$connect = mysqli_connect($dbServerHost, $dbUserName, $dbUserPass, $dbDataBaseName);
$sql = "SELECT * FROM userdata WHERE email = '".$email."';";
//$sql = "INSERT INTO `userdata` (`name`, `pass`) VALUES ('".$userid."', '".$pass."');";
$result = mysqli_query($connect, $sql);

if($result->num_rows > 0)
{
	echo "true";
}else
{
	echo "false";
}

// ------------------------------------------------------------------------------
?>