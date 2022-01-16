<?php
include 'inc/header.php';

?>

	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">
				<h2>Contact us</h2>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
         $fname = $fm->validation($_POST['firstname']);
         $lname = $fm->validation($_POST['lastname']);
         $email = $fm->validation($_POST['email']);
         $msg = $fm->validation($_POST['body']);

         $fname = mysqli_real_escape_string($db->link,$fname);
         $lname = mysqli_real_escape_string($db->link,$lname);
         $email = mysqli_real_escape_string($db->link,$email);
         $msg = mysqli_real_escape_string($db->link,$msg);

         $error = "";
         if (empty($fname)) {
         	$error = "First name must not be empty!";
        }elseif(empty($lname)) {
        	$error = "Last name must not be empty!";
        }elseif(empty($email)) {
        	$error = "Email field must not be empty!";
        }elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        	$error = "Message field must not be empty!";
        }
        elseif(empty($msg)) {
        	$error = "Message field must not be empty!";
        }else {
        	$smsgQuery = "INSERT INTO tbl_msg(firstname, lastname, email, message) VALUES('$fname', '$lname', '$email', '$msg')";
          $inmsg = $db->insert($smsgQuery);
          if ($inmsg) {
            echo "<span style='color:green;font-weight:800;'>Your message sent successfully! Check your email to get answer.</span>";
          }

        }
        }
        ?>
			<?php
if (isset($error)) {
echo "<span style='color:red;'>$error</span>";
}
if (isset($success)) {
	echo "<span style='color:green;'>$success</span>";
}

			 ?>
			<form action="" method="post">
				<table>
				<tr>
					<td>Your First Name:</td>
					<td>
					<input type="text" name="firstname" placeholder="Enter first name" />
					</td>
				</tr>
				<tr>
					<td>Your Last Name:</td>
					<td>
					<input type="text" name="lastname" placeholder="Enter Last name" />
					</td>
				</tr>

				<tr>
					<td>Your Email Address:</td>
					<td>
					<input type="email" name="email" placeholder="Enter Email Address" />
					</td>
				</tr>
				<tr>
					<td>Your Message:</td>
					<td>
					<textarea name="body"></textarea>
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
					<input type="submit" name="submit" value="Submit"/>
					</td>
				</tr>
		</table>
	<form>
 </div>

		</div>
		<?php include 'inc/sidebar.php'; ?>
	</div>
<?php include 'inc/footer.php'; ?>
    <div class="fixedicon clear">
		<a href="http://www.facebook.com"><img src="images/fb.png" alt="Facebook"/></a>
		<a href="http://www.twitter.com"><img src="images/tw.png" alt="Twitter"/></a>
		<a href="http://www.google.com"><img src="images/gl.png" alt="GooglePlus"/></a>
		<a href="http://www.linkedin.com"><img src="images/in.png" alt="LinkedIn"/></a>
	</div>
</body>
</html>
