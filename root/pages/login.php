<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Log In</title>
	<link rel="stylesheet" type="text/css" href="./../css/reg.css">
</head>
<body>

	<div class="header">
		<h2 style="text-align: center;">Log In</h2>
	</div>
	<form action="" method="POST">
		<div class="input-group">
			<label for="username">Username :</label>
			<input type="text" name="username" required>
		</div>
		<div class="input-group">
			<label for="password">Password :</label>
			<input type="password" name="password" requied>
</div>
		<div class="input-group">
		<button class="btn" type="submit" name="log_user">Submit</button>
</div>
<label>
          new user? <strong><a href="registration.php">create your account</a></strong>
      </label>
	</form>
<?php
if (isset($_POST["log_user"])) {
	
$url = "https://gcettbiaans22.herokuapp.com/api/auth";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
   "Content-Type: application/x-www-form-urlencoded",
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
$username=$_REQUEST['username'];
$password=$_REQUEST['password'];
// echo $username."<br>".$password;
$data = "username=$username&password=$password&grant_type=password";

curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
//for debug only!
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
$resp = curl_exec($curl);
curl_close($curl);
// var_dump($resp);
$obj=json_decode($resp);
$_SESSION['code']=$obj;
foreach($obj as $key=>$value){
	if($key=='detail'){
		echo "<br><h3><p align='center'>".$obj->detail."</p></h3>";
	}
	else{
		echo "<script>location.href = "."'index2.php';</script>";
	}
}

}
?>
</body>
</html>