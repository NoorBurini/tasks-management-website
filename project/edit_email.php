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
<title>Edit E-mail</title>
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
<h1 style="font-family:lucida handwriting; color:#502474; margin-top:20px; margin-bottom:30px;" >Set New E-mail</h1>
<?php
	if($_SERVER["REQUEST_METHOD"]=="GET"){
		$result=test_input($_REQUEST['result']);
		$user=test_input($_REQUEST['user']);
		echo "<h2 class="." alert-danger".">".$result."</h2>";
	}
?>
<form method="post" action="<?php echo htmlspecialchars("setemail_V.php?result=".$result."&user=".$user); ?>">
<label for="username" >User Name</label><br>
<input type="input" id="username" name="username" value="<?php echo $user; ?>" readonly>
<br>
<label for="email">New E-mail</label><br>
<input type="input" id="email" name="email">
<br>



<div class="btn-group-vertical" style="margin-top:5px; padding:5px;">
<input type="submit" class="btn btn-lg px-5" value="Submit" style="color:white; background-color:#502474;" >
<a href="HomePage.php?user=<?php echo $user; ?>&msg=1" class="btn btn-lg px-5" style="color:white; background-color:#502474;" >Back</a>
</div>

</form>

</div>

</body>

</html>