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
<title>View Task Details</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="style.css">
<style>
h2{
	font-family:courier;
	background-color:white;
}
input,select{	
    width: 80%;
    box-sizing: border-box;
	background-color:#d9d7dd;
	margin-top:10px;
	margin-bottom:10px;
	padding-right:20px;
	padding-left:20px;	
	padding-top:8px;
	padding-bottom:8px;
	font-size:20px;
}


</style>
</head>


<body>

<div class="container" style="padding-top:15px; border:2px solid black;">
<h1 style="font-family:lucida handwriting; color:#502474; margin-top:20px; margin-bottom:30px;" >Task Details</h1>
<?php

	if($_SERVER["REQUEST_METHOD"]=="GET"){
		$user=test_input($_REQUEST['user']);
		$tit=test_input($_REQUEST['tit']);
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
		$sql=("SELECT * FROM tasks WHERE username='$user' and title='$tit'");
		$res=$conn->query($sql);
		while($row=$res->fetch_assoc()){
				$t=$row['title'];
				$d=$row['date'];
				$c=$row['class'];
				$p=$row['priority'];
				$desc=$row['description'];
			}
	}
?>


<form>

<label for="title">Task Title </label><br>
<input type="text" id="title" name="title" value="<?php echo $t;?>" readonly>
<br>
<label for="date">Due Date</label><br>
<input type="text" id="date" name="date" value="<?php echo $d;?>" readonly>
<br>
<label for="desc" >Description </label><br>
<input type="text" id="desc" name="desc" value="<?php echo $desc;?>" readonly>
<br>
<label for="class" >Classification </label><br>
<input type="text" id="class" name="class" value="<?php echo $c;?>" readonly>
<br>
<label for="priority" >Priority </label><br>
<input type="text" id="priority" name="priority" value="<?php echo $p;?>" readonly>
	 
<br>

<div class="btn-group-vertical" style="margin-top:5px; padding:5px;">

<a href="HomePage.php?user=<?php echo $user; ?>&msg=1" class="btn btn-lg px-5" style="color:white; background-color:#502474;" >Back</a>

</div>

</form>





</div>

</body>

</html>