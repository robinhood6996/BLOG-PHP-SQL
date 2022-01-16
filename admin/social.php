<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
        <div class="grid_10">

            <div class="box round first grid">
                <h2>Update Social Media</h2>
                <div class="block">
  <?php
$sData = "SELECT * FROM tbl_social WHERE id='1'";
$rData = $db->select($sData);
if ($rData) {
  while ($result = $rData->fetch_assoc()) {
   ?>
                <form action="" method="post">
                    <table class="form">
                        <tr>
                            <td>
                                <label>Facebook</label>
                            </td>
                            <td>
                                <input type="text" name="fb" value="<?php echo $result['fb'];?>" class="medium" />
                            </td>
                      </tr>
						             <tr>
                            <td>
                                <label>Twitter</label>
                            </td>
                            <td>
                                <input type="text" name="tw" value="<?php echo $result['tw'];?>" class="medium" />
                            </td>
                        </tr>

						 <tr>
                            <td>
                                <label>LinkedIn</label>
                            </td>
                            <td>
                                <input type="text" name="ln" value="<?php echo $result['link'];?>" class="medium" />
                            </td>
                        </tr>

						 <tr>
                            <td>
                                <label>Google Plus</label>
                            </td>
                            <td>
                                <input type="text" name="gp" value="<?php echo $result['gp']; ?>" class="medium" />
                            </td>
                        </tr>

						 <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Update"/>
                            </td>
                        </tr>
                    </table>
                    </form>
                  <?php } } ?>
                </div>

                <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                  $fb = $fm->validation($_POST['fb']);
                  $tw = $fm->validation($_POST['tw']);
                  $ln = $fm->validation($_POST['ln']);
                  $gp = $fm->validation($_POST['gp']);

                  $fb = mysqli_real_escape_string($db->link,$fb);
                  $tw = mysqli_real_escape_string($db->link, $tw);
                  $ln = mysqli_real_escape_string($db->link, $ln);
                  $gp = mysqli_real_escape_string($db->link, $gp);


                  if ($fb == "" || $tw == "" || $ln == "" || $gp == "") {
                      echo "<span class='error'>Feild Must not be empty!!! </span>";
                  }
                  else {
                  $uDataQuery = "UPDATE tbl_social
                                 SET
                                 fb   ='$fb',
                                 tw   ='$tw',
                                 link ='$ln',
                                 gp   ='$gp'
                                 WHERE id='1'";

                  $upSocial =  $db->update($uDataQuery);
                  if ($upSocial) {
                    echo "Data Updated successfully";
                  }else {
                    echo "Update might have some problem.";
                  }
                            }  }


                 ?>
            </div>
        </div>
        <?php include 'inc/footer.php'; ?>
