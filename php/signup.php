<?php
// ------------------------------------------------------------------------------
$name = "";
$email = "";
$birthday = "";
$gender = "";
$pass = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST["name"];
  $email = $_POST["email"];
  $birthday = $_POST["birthday"];
  $gender = $_POST["gender"];
  $pass = $_POST["pass"];
}
echo $name;
// ------------------------------------------------------------------------------

$dbUserName = 'root';
$dbUserPass = '';
$dbServerHost = 'localhost';
$dbDataBaseName = 'alluserinfo';
echo $name.'ha ha >> '.$pass;
// ------------------------------------------------------------------------------

$connect = mysqli_connect($dbServerHost, $dbUserName, $dbUserPass, $dbDataBaseName);
$sql = "INSERT INTO `userdata` (`name`, `email`, `birthday`, `gender`, `pass`) VALUES ('".$name."', '".$email."', '".$birthday."', '".$gender."', '".$pass."');";
$result = mysqli_query($connect, $sql);

// ------------------------------------------------------------------------------
/* $json_array = array();
while($row = mysqli_fetch_assoc($result))
{
	$json_array[] = $row;
}
echo json_encode($json_array); */
?>