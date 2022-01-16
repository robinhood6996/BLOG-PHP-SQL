<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

        <div class="grid_10">

            <div class="box round first grid">
                <h2>Update Copyright Text</h2>
                <div class="block copyblock">
                  <?php
                $sData = "SELECT * FROM tbl_copy WHERE id='1'";
                $rData = $db->select($sData);
                if ($rData) {
                  while ($result = $rData->fetch_assoc()) {
                   ?>
                 <form action="" method="post">
                    <table class="form">
                        <tr>
                            <td>
                                <input type="text" value="<?php echo $result['note']; ?>" name="copyright" class="large" />
                            </td>
                        </tr>

						 <tr>
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>
                  <?php } } ?>

                  <?php
                  if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                    $c = $fm->validation($_POST['copyright']);
                   $c = mysqli_real_escape_string($db->link, $c);
                    if ($c == "") {
                        echo "<span class='error'>Feild Must not be empty!!! </span>";
                    }
                    else {
                    $uDataQuery = "UPDATE tbl_copy
                                   SET
                                   note   ='$c'
                                   WHERE id='1'";

                    $upC =  $db->update($uDataQuery);
                    if ($upC) {
                      echo "Data Updated successfully";
                    }else {
                      echo "Update might have some problem.";
                    }
                              }  }


                   ?>
                </div>
            </div>
        </div>
          <?php include 'inc/footer.php'; ?>
