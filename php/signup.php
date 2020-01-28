<?php
// ------------------------------------------------------------------------------
$userid = "";
$pass = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $userid = $_POST["userid"];
  $pass = $_POST["password"];
}

// ------------------------------------------------------------------------------

$dbUserName = 'root';
$dbUserPass = '';
$dbServerHost = 'localhost';
$dbDataBaseName = 'userinfo';
echo $userid.'ha ha >> '.$pass;
// ------------------------------------------------------------------------------

$connect = mysqli_connect($dbServerHost, $dbUserName, $dbUserPass, $dbDataBaseName);
$sql = "INSERT INTO `userdata` (`userid`, `pass`) VALUES ('".$userid."', '".$pass."');";
$result = mysqli_query($connect, $sql);

// ------------------------------------------------------------------------------
/* $json_array = array();
while($row = mysqli_fetch_assoc($result))
{
	$json_array[] = $row;
}
echo json_encode($json_array); */
?>