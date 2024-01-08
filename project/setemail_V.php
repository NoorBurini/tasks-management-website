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
$username= test_input($_POST['username']);
$email = test_input($_POST['email']);

$result = $_REQUEST['result'];
$user = $_REQUEST['user'];

$flag="1";

    if(empty($email)){
			$flag="Please enter the new E-mail";
	}
	
	else{
		$sql="SELECT * FROM users";
		$result=$conn->query($sql);
		$emailexist=0;
		
		if($result->num_rows>0){
			while($row=$result->fetch_assoc()){
				if($email == $row["email"]){
					$emailexist=1;
				}
			}
			if($emailexist==0){
				$sql2="UPDATE users SET email='$email' WHERE username='$username'";
				$result2=$conn->query($sql2);
			}
			elseif($emailexist==1){
				$flag="This E-mail is already used";
			}
			
		}
	}


if($flag == "1"){
	header('location:HomePage.php?user='.$username.'&msg=E-mail is updated successfully');
	exit;
}
else{
	header('location:edit_email.php?result='.$flag."&user=".$user); 
	exit;
}
$conn->close();
}

?>