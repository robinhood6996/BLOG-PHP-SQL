<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php
if (!isset($_GET['catid']) || $_GET['catid'] == NULL) {
  echo "<script>window.location = 'catlist.php';</script>";
}else {
    $id = $_GET['catid'];
}
 ?>

        <div class="grid_10">

            <div class="box round first grid">
                <h2>Update Category</h2>
               <div class="block copyblock">
  <?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $name = mysqli_real_escape_string($db->link, $name);
    if (empty($name)) {
       echo "<span class='error'>Feild Must not be empty!!! </span>";
    }else {
      $query= "UPDATE tbl_category SET name='$name' WHERE id='$id' ";
      $update_cat = $db->update($query);
      if ($update_cat) {
        echo "<span class='success'>Category Update successfully..! </span>";
      }else {
       echo "<span class='error'>Category Update operation failed! </span>";
      }
    }
}
   ?>

   <?php
  $query = "SELECT * FROM tbl_category WHERE id='$id' order by id desc";
  $flow_cat = $db->select($query);
  if ($flow_cat) {
    while ($result = $flow_cat->fetch_assoc()) {
    ?>
                 <form action="" method="post">
                    <table class="form">
                        <tr>
                            <td>
                                <input type="text" name="name" value="<?php echo $result['name'] ?>" class="medium" />
                            </td>
                        </tr>
						            <tr>
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>

                  <?php } } ?><!--End of while loop and if condition-->
                </div>
            </div>
        </div>
        <div class="clear">
        </div>
    </div>
  <?php include 'inc/footer.php'; ?>
