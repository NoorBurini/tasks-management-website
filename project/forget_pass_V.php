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
$email = test_input($_POST['email']);
$password = test_input($_POST['password']);

$result = $_REQUEST['result'];


$flag="1";

	if(empty($email)){
		$flag="Please enter the E-mail";
	}
	else if(empty($password)){
			$flag="Please enter the password";
	}
	
	else{
		$sql="SELECT * FROM users";
		$result=$conn->query($sql);
		$exist=0;
		if($result->num_rows>0){
			while($row=$result->fetch_assoc()){
				if($email == $row["email"]){
					$exist=1;
					$username=$row["username"];
					$sql2="UPDATE users SET password='$password' WHERE email='$email'";
					$result2=$conn->query($sql2);
					break;
				}
			}
			if($exist==0){
				$flag="This E-mail does not exist";
			}
			
		}
		else{
			$flag="This E-mail does not exist";
		}
	}


if($flag == "1"){
	header('location:login.php?result=Password is updated'); 
	exit;
}
else{
	header('location:forget_pass.php?result='.$flag); 
	exit;
}
$conn->close();
}

?>