<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>


        <div class="grid_10">

            <div class="box round first grid">
                <h2>Update Profile</h2>
    <?php
    if (!isset($_GET['userid']) || $_GET['userid'] == NULL) {
      echo "<script>window.location = 'userlist.php';</script>";
    }else {
        $userId = $_GET['userid'];
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      echo "<script>window.location = 'userlist.php'</script>";
    }
     ?>

                <div class="block">

  <?php
$query = "SELECT * FROM tbl_user WHERE id='$userId'";
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
                            <input type="text" readonly value="<?php echo $user['name'] ;?>" class="medium" />
                            </td>
                        </tr>

                        <tr>
                          <td>
                            <label>Username</label>
                             </td>
                                <td>
                            <input type="text" readonly value="<?php echo $user['username'] ;?>" class="medium" />
                            </td>
                        </tr>


                        <tr>
                          <td>
                            <label>E-mail</label>
                             </td>
                                <td>
                            <input type="text" readonly value="<?php echo $user['email'] ;?>" class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Details</label>
                            </td>
                            <td>
                                <textarea readonly class="tinymce">

                                  <?php echo $user['details'] ;?>
                                </textarea>
                            </td>
                        </tr>

						              <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="OK" />
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
