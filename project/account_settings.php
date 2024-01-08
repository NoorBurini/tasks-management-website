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
<title>Settings</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="style.css">
<style>
h2{
	font-family:courier;
	background-color:white;
}
</style>
</head>


<body>

<div class="container" style="padding-top:15px; border:2px solid black;">
<h1 style="font-family:lucida handwriting; color:#502474; margin-top:20px; margin-bottom:30px;" >Edit Account Information</h1>
<?php
	if($_SERVER["REQUEST_METHOD"]=="GET"){
		$user=test_input($_REQUEST['user']);
	}
?>

<div class="btn-group-vertical" style="margin-top:5px;">
<a href="edit_user.php?result=<?php echo ''; ?> &user=<?php echo $user; ?>" class="btn btn-lg px-5" style="color:white; background-color:#502474;" >Edit User Name</a>
<br>
<a href="edit_email.php?result=<?php echo ''; ?> &user=<?php echo $user; ?>" class="btn btn-lg px-5" style="color:white; background-color:#502474;" >Edit E-mail</a>
<br>
<a href="edit_pass.php?result=<?php echo ''; ?> &user=<?php echo $user; ?>" class="btn btn-lg px-5" style="color:white; background-color:#502474;" >Edit Password</a>
<br>
<a href="HomePage.php?user=<?php echo $user; ?>&msg=1" class="btn btn-lg px-5" style="color:white; background-color:#502474;" >Back</a>

</div>



</div>

</body>

</html>