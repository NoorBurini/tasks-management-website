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
<title>Log in</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="style.css">
<style>
h2{
	font-family:courier;
}
</style>
</head>


<body>


<div class="row" style="padding-top:15px; background-color:transparent;" >
<div class="col-md-6" style="background-color:white; border:1px solid black;">
<h2 style="font-family:lucida handwriting; color:#502474; margin-top:20px; margin-bottom:30px;" >Login</h2>
<img src="img/user1.png" alt="user icon" style="width:150px; height:150px; margin-bottom:20px;">
<?php
	
	if($_SERVER["REQUEST_METHOD"]=="GET"){
		$result=test_input($_REQUEST['result']);
		echo "<h2 class="." alert-danger".">".$result."</h2>";
	}
?>
<form method="post" action="<?php echo htmlspecialchars("login_V.php"); ?>">
<label for="username">User Name</label><br>
<input type="input" id="username" name="username">
<br>
<label for="pass" >Password</label><br>
<input type="password" id="pass" name="password">
<br>
<input type="submit" class="btn btn-lg px-5" value="log in" style="color:white; background-color:#502474;" >

</form>

<a href="forget_pass.php?result=" style="color:#0b5394;">forgot password?</a>
<br>
<a href="register.php?result=" style="color:#0b5394;">create new account</a>

</div>

<div class="col-md-6" style="background-color:#612ccc; border:1px solid black;">
	<h2 style="font-family:lucida handwriting; color:white; margin-top:20px;" >Welcome to task manager website</h2>
	<img src="img/img2.png" alt="picture" width="500" height="450" style="margin-top:40px;">
</div>

</div>

</body>

</html>