<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<?php if (!Session::get('userRole') == '0'){
 echo "<script>window.location = 'index.php';</script>";

} ?>

        <div class="grid_10">

            <div class="box round first grid">
                <h2>Add New User</h2>
               <div class="block copyblock">
  <?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $fm->validation($_POST['username']);
    $email = $fm->validation($_POST['email']);
    $password = $fm->validation(md5($_POST['password']));
    $userRole = $fm->validation($_POST['role']);

    $username = mysqli_real_escape_string($db->link, $username);
    $email = mysqli_real_escape_string($db->link, $email);
    $password = mysqli_real_escape_string($db->link, $password);
    $userRole = mysqli_real_escape_string($db->link, $userRole);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      echo "<span class='error'>This email is worng please enter valid mail.</span>";
    }else {


    if ($username == "" || $email == "" || $password == "" || $userRole == "") {
       echo "<span class='error'>Feild Must not be empty!!! </span>";
    }else {

 $mailquery = "SELECT * FROM tbl_user WHERE email='$email' LIMIT 1";
 $mailCheck = $db->select($mailquery);
if ($mailCheck != false) {
echo "<span class='error'>Mail Already Exit! Please try with another valid email address</span>";
}
    else {
      $query= "INSERT INTO tbl_user(username, password,email, role) VALUES('$username', '$password','$email', '$userRole')";
      $adduser = $db->insert($query);
      if ($adduser) {
        echo "<span class='success'>User Created successfully..! </span>";
      }else {
       echo "<span class='error'>User create operation failed! </span>";
      }
    }
}
} }
   ?>
                 <form action="" method="post">
                    <table class="form">
                        <tr>
                          <td><label>Username</label></td>
                            <td>
                                <input type="text" name="username" placeholder="Enter UserName..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                          <td><label>Email</label></td>
                            <td>
                                <input type="email" name="email" placeholder="Enter Valid Email..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                          <td><label>Password</label></td>
                            <td>
                                <input type="text" name="password" placeholder="Enter a Password" class="medium" />
                            </td>
                        </tr>
                        <tr>
                          <td><label>User Role</label></td>
                          <td>
                          <select id="select" name="role">
                            <option> Select user role</option>
                            <option value="0">Admin</option>
                            <option value="1">Editor</option>
                            <option value="2">Moderator</option>
                          </select>
                          </td>
                        </tr>
						            <tr>
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
        <div class="clear">
        </div>
    </div>
  <?php include 'inc/footer.php'; ?>
