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

$result = $_REQUEST['result'];
$user = $_REQUEST['user'];

	
$title = $_POST['title'];
$date = $_POST['date'];
$priority = $_POST['priority'];
$desc = $_POST['desc'];
$class=$_POST['class'];

function test_input($data){
	$data = htmlspecialchars($data);
	$data = trim($data);
	$data = stripslashes($data);
	return $data;
}

$flag="1";	
	
	if(empty($title)){
		$flag="Please enter the task title";
	}
	elseif(empty($date)){
		$flag="Please enter the due date";
	}
	elseif(empty($desc)){
		$flag="Please add description";
	}
	elseif(empty($class)){
		$flag="Please add a classification";
	}
	elseif(empty($priority)){
			$flag="Please choose priority";
	}
	else{
		$sql="SELECT title FROM tasks WHERE username='$user'";
		$res=$conn->query($sql);
		$exist=0;
		if($res->num_rows>0){
			while($row=$res->fetch_assoc()){
				if($title == $row["title"]){
					$flag="This task is already exist";
					$exist=1;
					break;
				}
			}
			if($exist==0){
				$sql2="INSERT INTO tasks (username,title,date,priority,class,description) 
				VALUES ('$user','$title','$date','$priority','$class','$desc')";
				$result2=$conn->query($sql2);
			}
	
		}
		else{
			$sql2="INSERT INTO tasks (username,title,date,priority,class,description) 
			VALUES ('$user','$title','$date','$priority','$class','$desc')";
			$result2=$conn->query($sql2);
		}
	}
	

if($flag == "1"){
	header('location:HomePage.php?user='.$user.'&msg=New task is added successfully'); 
	exit;
}
else{
	header('location:add_task.php?result='.$flag.'&user='.$user);
	exit;
}
$conn->close();

}

?>