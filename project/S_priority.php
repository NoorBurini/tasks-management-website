<?php
error_reporting(0);
function test_input($data){
	$data = htmlspecialchars($data);
	$data = stripslashes($data);
	$data = trim($data);
	return $data;
}
$user = $_REQUEST['user'];
$priority = $_POST['priority'];
?>

<!DOCTYPE html>

<html>
<head>
<title>Search by priority</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="style.css">
<style>
h2{
	font-family:courier;
}
select{	
    
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
.task{
	display:inline-block;  
	margin-left:20px;
	color:#20124d;
	font-weight:bold;
	background-color:#d9b0fb;
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

</style>
</head>


<body>

<div class="container" style="padding-top:15px; padding-bottom:35px; border:2px solid black;">
<h1 style="font-family:lucida handwriting; color:#502474; margin-top:20px; margin-bottom:30px;" >Search By Priority</h1>



<form method="post" action="<?php echo htmlspecialchars("S_priority.php?user=".$user."&priority=".$priority); ?>">
<label for="priority" style=" margin-left:15px;">Task Priority</label>
<select id="priority" name="priority">
	  <option selected></option>
      <option>1.high priority</option>
      <option>2.medium priority</option>
      <option>3.low priority</option>
</select>

<input type="submit" class="btn btn-lg px-5" value="search" style="color:white; background-color:#502474;" >

</form>


<?php
	$servername="localhost";
	$username="root";
	$pass="";
	$dbname="mydb";

	$conn=new mysqli($servername,$username,$pass,$dbname);

	if($conn->connect_error){
		die("connection failed : " . $conn->connect_error);
	}
	else{
		$user = $_REQUEST['user'];
		$priority = $_POST['priority'];
		
		$sql=("SELECT * FROM tasks WHERE username='$user' and priority='$priority'");
		$res=$conn->query($sql);
		if($res->num_rows>0){
			while($row=$res->fetch_assoc()){
				echo "<div style=\" padding:5px; padding-bottom:10px; text-align:left; background-color:#d9b0fb;\">
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
			echo "<p class=\" alert alert-primary\">No Result</p>";
		}
	}
?>

<a href="HomePage.php?user=<?php echo $user; ?>&msg=1" class="btn btn-lg px-5" style="color:white; margin-top:35px; background-color:#502474;" >Back</a>

</div>

</body>

</html>