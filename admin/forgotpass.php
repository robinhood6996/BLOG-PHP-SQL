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
<title>Password Recovery</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">

    <!--Login procedure;;;-->
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
 $email = $fm->validation($_POST['email']);
 $email = mysqli_real_escape_string($db->link,$email);
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  echo "<span style='color:red;font-size:18px;'>Invalid Email Address!</span>";
}else {
 $query = "SELECT * FROM tbl_user WHERE email='$email' LIMIT 1 ";
 $result = $db->select($query);
 if ($result != false) {

   while ($value = $result->fetch_assoc()) {
     $userId = $value['id'];
     $userName = $value['username'];
   }
   $text = substr($email, 0, 3);
   $rand = chr(rand(0, 32768));
   $newPass = "$text$rand";
   $password = md5($newPass);
  $updateQuery = "UPDATE tbl_user
                  SET password = $password
                  WHERE id = $userId";
  $updatePass = $db->update($updateQuery);
  $to = "$email";
  $from = "maleksarker35@gmail.com";
  $headers = "From: $from /n";
  $headers .= 'MIME-Version: 1.0';
  $headers .= 'Content-type: text/html; charset=iso-8859-1';
  $subject = "Your Password";
  $message = "Your Username is".$userName."Password is:".$newPass."Please Login with this data and go";
echo $message;
     //$sendMail= mail($to, $subject, $message, $headers);
     /*if ($sendMail) {
         echo "<span style='color:green;font-size:18px;'>Plese Check your emailn for password..!</span>";
     }else {
       echo "<span style=color:red;font-size:18px;'>Mail Didn't Sent..!</span>";
     }*/


 }else {
        echo "<span style='color:red;font-size:18px;'> Email Address Doesn't Matched!</span>";
 }

} }

 ?>

		<form action="" method="post">
			<h1>Recovery Password</h1>
			<div>
				<input type="text" placeholder="Enter Your Email" required="" name="email"/>
			</div>
			<div>
				<input type="submit" value="Submit" />
			</div>
		</form><!-- form -->
    <div class="button">
			<a href="login.php">Login</a>
		</div><!-- button -->
		<div class="button">
			<a href="login.php">Fakhrul Islam Robin</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>
