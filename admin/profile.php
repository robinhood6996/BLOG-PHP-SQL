<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<?php
$userId = Session::get('userId');
$userRole = Session::get('userRole');
 ?>
        <div class="grid_10">

            <div class="box round first grid">
                <h2>Update Post</h2>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = mysqli_real_escape_string($db->link, $_POST['name']);
    $username = mysqli_real_escape_string($db->link, $_POST['username']);
    $email = mysqli_real_escape_string($db->link, $_POST['email']);
    $details = mysqli_real_escape_string($db->link, $_POST['details']);


    if ($name == "" || $username == "" || $email == "" || $details == "") {
        echo "<span class='error'>Feild Must not be empty!!! </span>";
    }else {
      $updateUserQuery = "UPDATE tbl_user
                          SET name='$name',
                          username= '$username',
                          email = '$email',
                          details = '$details'
                          WHERE id='$userId'";
       $updateuser = $db->update($updateUserQuery);
       if ($updateuser) {
         echo "User updated successfully!!";
       }else {
         echo "User update operation failed";
       }
    }


  }

    ?>

                <div class="block">

  <?php
$query = "SELECT * FROM tbl_user WHERE id='$userId' AND role='$userRole'";
$useredit = $db->select($query);
if ($useredit) {
  while ($user = $useredit->fetch_assoc()) {
   ?>
                 <form action="" method="post" enctype="multipart/form-data">
                    <table class="form">

                        <tr>
                          <td>
                            <label>Name</label>
                             </td>
                                <td>
                            <input type="text" name="name" value="<?php echo $user['name'] ;?>" class="medium" />
                            </td>
                        </tr>

                        <tr>
                          <td>
                            <label>Username</label>
                             </td>
                                <td>
                            <input type="text" name="username" value="<?php echo $user['username'] ;?>" class="medium" />
                            </td>
                        </tr>


                        <tr>
                          <td>
                            <label>E-mail</label>
                             </td>
                                <td>
                            <input type="text" name="email" value="<?php echo $user['email'] ;?>" class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Details</label>
                            </td>
                            <td>
                                <textarea name="details" class="tinymce">

                                  <?php echo $user['details'] ;?>
                                </textarea>
                            </td>
                        </tr>

						              <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>

                    </table>
                    </form>
                  <?php } } ?>
                </div>
            </div>

            <script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
            <script type="text/javascript">
                $(document).ready(function () {
                    setupTinyMCE();
                    setDatePicker('date-picker');
                    $('input[type="checkbox"]').fancybutton();
                    $('input[type="radio"]').fancybutton();
                });
            </script>
<?php include 'inc/footer.php'; ?>
