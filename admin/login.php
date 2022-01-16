<?php include '../lib/Session.php';
Session::checkLogin();
?>
<?php include '../config/config.php';?>
<?php include '../lib/Database.php';?>
<?php include '../helpers/Format.php';?>

<?php
$db = new Database();
$fm = new Format();
?>
<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">

    <!--Login procedure;;;-->
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
 $username = $fm->validation($_POST['username']);
 $password = $fm->validation($_POST['password']);

 $username = mysqli_real_escape_string($db->link,$username);
 $password = mysqli_real_escape_string($db->link,$password);

 $query = "SELECT * FROM tbl_user WHERE username='$username' AND password='$password' ";
 $result = $db->select($query);

//Matching with Database
 if ($result != false) {
   $value = $result->fetch_assoc();
     //Input value check;;;
     Session::set("login",true);
     Session::set("username", $value['username']);
     Session::set("userId", $value['id']);
     Session::set("userRole", $value['role']);
     header("Location: index.php");//redirect to admin dashboard;;;
 }else {
   echo "<span style='color:red;font-size:18px;'>Username and password not matched..!!</span>";
 }// End of Matching with Database;;;

}
 ?>

		<form action="login.php" method="post">
			<h1>Admin Login</h1>
			<div>
				<input type="text" placeholder="Username" required="" name="username"/>
			</div>
			<div>
				<input type="password" placeholder="Password" required="" name="password"/>
			</div>
			<div>
				<input type="submit" value="Log in" />
			</div>
		</form><!-- form -->
    <div class="button">
			<a href="forgotpass.php">Forgot Password</a>
		</div><!-- button -->
		<div class="button">
			<a href="login.php">Fakhrul Islam Robin</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>
