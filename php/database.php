<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "alluserinfo";
$dbTable = "userdata";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $birthday = $_POST["birthday"];
    $gender = $_POST["gender"];
    $pass = $_POST["pass"];
}
echo $name . 'ha ha >> ' . $pass;
$conn = mysqli_connect($servername, $username, $password, $dbname);

$sql = "INSERT INTO `$dbTable` (`id`, `name`, `email`, `birthday`, `gender`, `pass`) VALUES (NULL, '$name', '$email', '$birthday', '$gender', '$pass');";

mysqli_query($conn, $sql);
mysqli_close($conn);
echo 'I am here';
?>