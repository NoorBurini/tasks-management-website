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
<title>Home</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="style.css">
<style>
h2{
	margin-top:10px;
	color:white;
	font-weight:bold;	
}
button a{

	background-color:#20124d;
	color:white;
	padding-right:20px;
	padding-left:20px;
	font-size:20px;
	text-decoration:none;
	float:right;
}
button a:hover{
	background-color:#13063c;
	color:white;
}
li a:hover{
	background-color:#d9d7dd;
	color:black;
}
li a{
	padding:5px;
	text-decoration:none;
	color:black;
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


<div class="container-fluid btn-group" style="margin-top:0px; padding:1px; background-color:#20124d;">
<?php
	$result='';
	if($_SERVER["REQUEST_METHOD"]=="GET"){
		$user=test_input($_REQUEST['user']);
		echo "<h2 style="."float:left; color:white;".">Welcome ".$user."</h2>";		
	}
?>
	<button type="button" class="btn"><a href="add_task.php?result=<?php echo ''; ?> &user=<?php echo $user; ?>" target="_self">Add new task</a></button>
	<button type="button" class="btn"><a href="not.php?user=<?php echo $user; ?>">Notifications</a></button>

	<div class="btn group" style="margin-top:1px;">
	<button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown"><a href="#">Search</a></button>
	<ul class="dropdown-menu">
		<li><a href="S_title.php?user=<?php echo $user; ?>">Search by title</a></li>
		<li><a href="S_date.php?user=<?php echo $user; ?>">Search by date</a></li>
		<li><a href="S_class.php?user=<?php echo $user; ?>">Search by class</a></li>
		<li><a href="S_priority.php?user=<?php echo $user; ?>">Search by priority</a></li>
	</ul>
	</div>

	<button type="button" class="btn"><a href="account_settings.php?user=<?php echo $user; ?>" target="_self">Settings</a></button>
	<button type="button" class="btn"><a href="login.php" target="_self">Log out</a></button>	

</div>


<div class="container" style="margin-top:10px; padding-top:15px; background-color:transparent;" >

<h1 style="font-family:lucida handwriting; color:white; margin-top:0px; margin-bottom:20px;" >My tasks</h1>


	<?php

		if($_SERVER["REQUEST_METHOD"]=="GET"){
			$msg=test_input($_REQUEST['msg']);
			if($msg!='1')
			echo "<div class=\"container alert alert-success alert-dismissible\" style=\"margin-top:0px; padding:5px;\">
	<button type=\"button\" class=\"btn-close btn-sm\" data-bs-dismiss=\"alert\"></button>".$msg."</div>";
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
		$sql=("SELECT * FROM tasks WHERE username='$user'");
		$res=$conn->query($sql);
		if($res->num_rows>0){
			echo "<img src=\"img/p.jpg\" style=\"margin:10px;\">";
			while($row=$res->fetch_assoc()){
				echo "<div style=\" padding:5px; text-align:left;\">
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
			echo "<p class=\" alert alert-primary\">There are No tasks</p>";
			echo "<img src=\"img/p.jpg\" style=\"margin:10px;\">";
		}
		
		
		$conn->close();
	}

	
	?>
	



</div>

</body>

</html>