<?php
// define variables and set to empty values
$email = "";
$pass = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $_POST["email"];
  $pass = $_POST["pass"];
}
// >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

$dbUserName = 'root';
$dbUserPass = '';
$dbServerHost = 'localhost';
$dbDataBaseName = 'alluserinfo';

$connect = mysqli_connect($dbServerHost, $dbUserName, $dbUserPass, $dbDataBaseName);
$sql = "SELECT * FROM userdata WHERE email= '".$email."' AND pass= '".$pass."';";
//$result = mysqli_query($connect, $sql);
$result = $connect->query($sql);
if($result->num_rows > 0)
{
	$json_array = array();
	$sql = "SELECT * FROM userdata;";
	$result = $connect->query($sql);
	while($row = mysqli_fetch_assoc($result))
	{
		$json_array[] = $row;
	}
	$myfile = fopen("temp.json", "w");
	$str = 'u = '.$email.' p ='.$pass;
	fwrite($myfile, json_encode($json_array));
	fclose($myfile);
	echo json_encode($json_array);
	
}else
{
	echo "rid777";
}


// >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
/* $connect = mysqli_connect('localhost','root','','userinfo');
$sql = "SELECT * FROM userdata;";
$result = mysqli_query($connect, $sql);
$json_array = array();
while($row = mysqli_fetch_assoc($result))
{
	$json_array[] = $row;
}
echo json_encode($json_array); */
?>