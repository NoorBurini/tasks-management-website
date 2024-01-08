<?php
$servername="localhost";
$user="root";
$pass="";
$dbname="mydb";

$conn=new mysqli($servername,$user,$pass,$dbname);

if($conn->connect_error){
	die("connection failed : " . $conn->connect_error);
}
else{

$tit = $_REQUEST['tit'];
$user = $_REQUEST['user'];


function test_input($data){
	$data = htmlspecialchars($data);
	$data = trim($data);
	$data = stripslashes($data);
	return $data;
}

		$sql="DELETE FROM tasks WHERE username='$user' and title='$tit'";
		$res=$conn->query($sql);

	header('location:HomePage.php?user='.$user.'&msg=task is deleted successfully'); 
	exit;

$conn->close();

}

?>