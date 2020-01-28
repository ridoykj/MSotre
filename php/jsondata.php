<?php
$connect = mysqli_connect('localhost','root','','userinfo');
$sql = "SELECT * FROM userdata;";
$result = mysqli_query($connect, $sql);
$json_array = array();
while($row = mysqli_fetch_assoc($result))
{
	$json_array[] = $row;
}
echo json_encode($json_array);

//echo '<pre>';
//print_r($json_array);
//echo '</pre>';
?>