<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>


        <div class="grid_10">

            <div class="box round first grid">
                <h2>Update Category</h2>
               <div class="block copyblock">
  <?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $theme = mysqli_real_escape_string($db->link, $_POST['theme']);
      $query= "UPDATE tbl_theme SET theme='$theme' WHERE id='1' ";
      $update_theme = $db->update($query);
      if ($update_theme) {
       echo "Theme Updated Successfully!";
     }else {
       echo "Theme not updated";
     }
}
   ?>

   <?php
  $query = "SELECT * FROM tbl_theme WHERE id='1'";
  $flow_theme = $db->select($query);
    while ($result = $flow_theme->fetch_assoc()) {
  ?>
                 <form action="" method="post">
                    <table class="form">
                        <tr>
                            <td>
                                <input type="radio" name="theme" <?php if ($result['theme'] == 'Default'){echo "checked";}?> value="Default">Default
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="radio" name="theme" <?php if ($result['theme'] == 'Green'){echo "checked";}?> value="Green">Green
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="radio" <?php if ($result['theme'] == 'Red'){echo "checked";}?> name="theme" value="Red">Red
                            </td>
                        </tr>
						            <tr>
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>

                  <?php  } ?><!--End of while loop and if condition-->
                </div>
            </div>
        </div>
        <div class="clear">
        </div>
    </div>
  <?php include 'inc/footer.php'; ?>
