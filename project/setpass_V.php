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

function test_input($data){
	$data = htmlspecialchars($data);
	$data = trim($data);
	$data = stripslashes($data);
	return $data;
}
$name=test_input($_POST['name']);
$email = test_input($_POST['email']);
$password = test_input($_POST['password']);

$result = $_REQUEST['result'];
$user = $_REQUEST['user'];

$flag="1";

	if(empty($email)){
		$flag="Please enter the E-mail";
	}
	else if(empty($password)){
			$flag="Please enter the password";
	}
	
	else{
		$sql="SELECT email FROM users WHERE username='$name'";
		$result=$conn->query($sql);
		$exist=0;
		if($result->num_rows>0){
			while($row=$result->fetch_assoc()){
				if($email == $row["email"]){
					$sql2="UPDATE users SET password='$password' WHERE email='$email'";
					$result2=$conn->query($sql2);
					break;
				}
				else{
					$flag="Invalid E-mail";
				}
			}
		}

	}


if($flag == "1"){
	header('location:HomePage.php?user='.$name.'&msg=Password is updated successfully');
	exit;
}
else{
	header('location:edit_pass.php?result='.$flag."&user=".$user); 
	exit;
}
$conn->close();
}

?>