<?php
error_reporting(0);
function test_input($data){
	$data = htmlspecialchars($data);
	$data = stripslashes($data);
	$data = trim($data);
	return $data;
}

?>

<!DOCTYPE html>

<html>
<head>
<title>Notifications</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="style.css">
<style>
h2{
	font-family:courier;
}
a img{
	float:right; 
	width:35px; 
	height:35px; 
	margin:10px;
}
a img:hover{
	width:40px; 
	height:40px;
	margin:5px;
}
.task{
	display:inline-block;  
	margin-left:20px;
	color:#20124d;
	font-weight:bold;
}

</style>
</head>


<body>

<div class="container" style="padding-top:15px; border:2px solid black;">
<h1 style="font-family:lucida handwriting; color:#502474; margin-top:20px; margin-bottom:30px;" >Notifications</h1>

<?php

	if($_SERVER["REQUEST_METHOD"]=="GET"){
		$user=test_input($_REQUEST['user']);
	}
	
	$servername="localhost";
	$username="root";
	$pass="";
	$dbname="mydb";

	$conn=new mysqli($servername,$username,$pass,$dbname);

	if($conn->connect_error){
		die("connection failed : " . $conn->connect_error);
	}
	else{
		$current_date=date('Y-m-d');
		$sql=("SELECT * FROM tasks WHERE username='$user' and date='$current_date'");
		$res=$conn->query($sql);
		if($res->num_rows>0){
		echo "<h2 class=\"alert-danger\">Tasks for Today</h2>";
		while($row=$res->fetch_assoc()){
				echo "<div style=\" padding:5px;  padding-bottom:10px; text-align:left; background-color:#d9b0fb;\">
				<h2 class=\"task\">".$row['title']."</h2>
				
				<a href=\"view_task.php?user=".$user."&tit=".$row['title']."\" title=\"show task details\">
				<img src=\" img/info.png\" alt=\"info\">
				</a>
				
				<a href=\"delete_task.php?user=".$user."&tit=".$row['title']."\" title=\"delete task\">
				<img src=\" img/del.png\" alt=\"delete\" >
				</a>
				
				<a href=\"edit_tasks.php?user=".$user."&tit=".$row['title']."\" title=\"edit task\">
				<img src=\" img/edit.png\" alt=\"info\">
				</a>
				
				</div>";
			}
		}
		else{
			echo "<h2 class=\"alert-danger\">No Tasks for Today</h2>";	
		}
	}
?>



<div class="btn-group-vertical" style="margin-top:5px; padding:5px;">

<a href="HomePage.php?user=<?php echo $user; ?>&msg=1" class="btn btn-lg px-5" style="color:white; background-color:#502474; margin-top:35px;" >Back</a>

</div>






</div>

</body>

</html>