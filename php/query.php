<?php
// ------------------------------------------------------------------------------
$userid = "";
$pass = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $userid = $_POST["userid"];
}

// ------------------------------------------------------------------------------

$dbUserName = 'root';
$dbUserPass = '';
$dbServerHost = 'localhost';
$dbDataBaseName = 'userinfo';
// ------------------------------------------------------------------------------

$connect = mysqli_connect($dbServerHost, $dbUserName, $dbUserPass, $dbDataBaseName);
$sql = "SELECT * FROM userdata WHERE userid = '".$userid."';";
//$sql = "INSERT INTO `userdata` (`userid`, `pass`) VALUES ('".$userid."', '".$pass."');";
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