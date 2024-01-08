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

$username = test_input($_POST["username"]);
$password = test_input($_POST["password"]);

$flag="1";

if(empty($username)){
	$flag="Please enter the user name";
}
else if(empty($password)){
		$flag="Please enter the password";
		}
else{
	$sql="SELECT username,password FROM users";
	$result=$conn->query($sql);
	$exist=0;
	if($result->num_rows>0){
		while($row=$result->fetch_assoc()){
			if($username == $row["username"]){
				$exist=1;
				if($password!=$row["password"]){
					$flag="password is not correct";
				}
			}
				
		}
		
		if($exist!=1){
			$flag="This user name does not exist";
		}
			
	}
	else{
		$flag="This user name does not exist";
	}
}


if($flag == "1"){
	header('location:HomePage.php?user='.$username.'&msg=1');
	exit;
}
else{
	header('location:login.php?result='.$flag); 
	exit;
}
$conn->close();
}


?>