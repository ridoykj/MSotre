<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'alluserinfo';
$dbTable = 'userdata';
$requestType = '';

main();
function main()
{
	createDataBase();
	createTable();
	global $requestType;
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$requestType = $_POST["request"];
		request();
	}
}

function createDataBase()
{
	global $servername, $username, $password, $dbname;
	$conn = mysqli_connect($servername, $username, $password);
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
	$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
	mysqli_query($conn, $sql);
	mysqli_close($conn);
}


function createTable()
{
	global $servername, $username, $password, $dbname, $dbTable;
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
	$sql = "CREATE TABLE $dbname.$dbTable
	( `id` INT NULL AUTO_INCREMENT ,
	`name` VARCHAR(25) NOT NULL ,
	`email` VARCHAR(30) NOT NULL ,
	`birthday` VARCHAR(12) NOT NULL ,
	`gender` VARCHAR(8) NOT NULL ,
	`pass` VARCHAR(30) NOT NULL , PRIMARY KEY (`id`)
	);";
	mysqli_query($conn, $sql);
	mysqli_close($conn);
}


function request()
{
	global $requestType;
	switch ($requestType) {
		case 'create':
			CREATE();
			break;

		case 'delete':
			DELETE();
			break;

		case 'update':
			UPDATE();
			break;

		case 'search':
			break;

		case 'read':
			READ();
			break;

		case 'login':
			login();
			break;

		default:
			echo "Wrong Requested ridoykj";
			break;
	}
}

function CREATE()
{
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$name = $_POST["name"];
		$email = $_POST["email"];
		$birthday = $_POST["birthday"];
		$gender = $_POST["gender"];
		$pass = $_POST["pass"];
	}

	if (!check($email)) {
		global $servername, $username, $password, $dbname, $dbTable;
		$conn = mysqli_connect($servername, $username, $password, $dbname);
		$sql = "INSERT INTO `$dbTable` (`name`, `email`, `birthday`, `gender`, `pass`) VALUES ('$name', '$email', '$birthday', '$gender', '$pass');";

		mysqli_query($conn, $sql);
		mysqli_close($conn);
	} else {
		echo "false";
	}
}

function DELETE()
{
	# code...
}

function UPDATE()
{
	# code...
}

function check($email)
{
	global $servername, $username, $password, $dbname, $dbTable;
	$connect = mysqli_connect($servername, $username, $password, $dbname);
	$sql = "SELECT * FROM $dbTable WHERE email = '" . $email . "';";
	$result = mysqli_query($connect, $sql);

	if ($result->num_rows > 0) {
		return true;
	} else {
		return false;
	}
}

function login()
{
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$email = $_POST["email"];
		$pass = $_POST["pass"];
	}

	global $servername, $username, $password, $dbname, $dbTable;
	$connect = mysqli_connect($servername, $username, $password, $dbname);
	$sql = "SELECT * FROM $dbTable WHERE email = '" . $email . "' AND pass = '" . $pass . "';";
	$result = mysqli_query($connect, $sql);
	if ($result->num_rows > 0) {
		READ();
	} else {
		echo "rid777";
	}
}

function READ()
{
	global $servername, $username, $password, $dbname, $dbTable;
	$connect = mysqli_connect($servername, $username, $password, $dbname);
	$sql = "SELECT * FROM $dbTable;";
	$result = mysqli_query($connect, $sql);
	$json_array = array();
	while ($row = mysqli_fetch_assoc($result)) {
		$json_array[] = $row;
	}
	echo json_encode($json_array);
}
