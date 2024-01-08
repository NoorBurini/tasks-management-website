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


$user = $_REQUEST['user'];
$tit = $_REQUEST['tit'];
	
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
				if($title == $row["title"] && $title!=$tit){
					$flag="This task is already exist";
					$exist=1;
					break;
				}
			}
			if($exist==0){
				$sql2="UPDATE tasks SET title='$title',date='$date',priority='$priority',class='$class',description='$desc' WHERE title='$tit'";
			    $result2=$conn->query($sql2);
			}
	
		}
			
			
			
	}
	

if($flag == "1"){
	header('location:HomePage.php?user='.$user.'&msg=Task is edited successfully'); 
	exit;
}
else{
	header('location:edit_tasks.php?result='.$flag.'&user='.$user);
	exit;
}
$conn->close();
}

?>