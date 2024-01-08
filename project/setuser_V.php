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
$name = test_input($_POST['name']);
$username = test_input($_POST['username']);

$result = $_REQUEST['result'];
$user = $_REQUEST['user'];

$flag="1";

	if(empty($username)){
		$flag="Please enter the new user name";
	}
	else{
		$sql="SELECT * FROM users";
		$result=$conn->query($sql);
		$userexist=0;
		
		if($result->num_rows>0){
			while($row=$result->fetch_assoc()){
				if($username == $row["username"]){
					$userexist=1;
				}
			}
			if($userexist==0){
				$sql2="UPDATE users SET username='$username' WHERE username='$name'";
				$result2=$conn->query($sql2);
				
				$sql3="UPDATE tasks SET username='$username' WHERE username='$name'";
				$result3=$conn->query($sql3);
			}
			elseif($userexist==1){
				$flag="This user name is used";
			}
			
		}
	}


if($flag == "1"){
	header('location:HomePage.php?user='.$username.'&msg=User name is updated successfully'); 
	exit;
}
else{
	header('location:edit_user.php?result='.$flag."&user=".$user); 
	exit;
}
$conn->close();
}

?>