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

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

function test_input($data){
	$data = htmlspecialchars($data);
	$data = trim($data);
	$data = stripslashes($data);
	return $data;
}

$flag="1";

if(empty($username)){
	$flag="Please enter the User Name";
}
else{
	if(empty($email)){
		$flag="Please enter the E-mail";
	}
	else if(empty($password)){
			$flag="Please enter the password";
		}
	
	else{
		$sql="SELECT username,email FROM users";
		$result=$conn->query($sql);
		$exist=0;
		if($result->num_rows>0){
			while($row=$result->fetch_assoc()){
				if($username == $row["username"]){
					$flag="This user name is already exist";
					$exist=1;
					break;
				}
				if($email==$row["email"]){
					$flag="This E-mail is already exist";
					$exist=1;
					break;
				}
			}
			if($exist==0){
				$stmt=$conn->prepare("INSERT INTO users (username,email,password) VALUES (?,?,?)");
				$stmt->bind_param("sss",$username,$email,$password);
				
				$username = test_input($_POST['username']);
				$email = test_input($_POST["email"]);
				$password = test_input($_POST['password']);	
				
				$stmt->execute();
				
				$stmt->close();
			}
			
		}
		else{
			$stmt=$conn->prepare("INSERT INTO users (username,email,password) VALUES (?,?,?)");
			$stmt->bind_param("sss",$username,$email,$password);
			
			$username = test_input($_POST['username']);
			$email = test_input($_POST["email"]);
			$password = test_input($_POST['password']);	
			
			$stmt->execute();
			
			$stmt->close();
		}
	}
}

if($flag == "1"){
	header('location:login.php?result=Account is created please login '); 
	exit;
}
else{
	header('location:register.php?result='.$flag);
	exit;
}
$conn->close();
}

?>