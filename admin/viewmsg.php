<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
        <div class="grid_10">

    <?php if ($_SERVER['REQUEST_METHOD'] == 'POST'){
      echo "<script>window.location = 'messages.php';</script>";

    }




     ?>

            <div class="box round first grid">
                <h2>Add New Page</h2>

<?php
if (!isset($_GET['msgid']) || $_GET['msgid'] == NULL) {
  echo "<script>window.location = 'messages.php';</script>";
}else {
    $msgid = $_GET['msgid'];
}
 ?>

                <div class="block">

        <?php
      $query = "SELECT * FROM tbl_msg WHERE id='$msgid'";
      $msgget = $db->select($query);
      if ($msgget) {
        while ($msgread = $msgget->fetch_assoc()) {
         ?>
                 <form action="" method="post">
                    <table class="form">

                        <tr>
                            <td>
                                <label>Name</label>
                            </td>
                            <td>
                                <input type="text" value="<?php echo $msgread['firstname'].''.$msgread['lastname']; ?>" name="name" class="medium" readonly />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Email</label>
                            </td>
                            <td>
                                <input type="email" value="<?php echo $msgread['email']; ?>" name="email"  class="medium" readonly />
                            </td>
                        </tr>


                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea name="body" cols="80" rows="20" readonly>
                                  <?php echo $msgread['message']; ?>
                                </textarea>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Date</label>
                            </td>
                            <td>
                                <input type="text" value="<?php echo $msgread['times'] ?>" name="time" class="medium" readonly/>
                            </td>
                        </tr>

						               <tr>
                            <td></td>
                            <td>
                                <input style="background:green;color:white;" type="submit" name="submit" Value="Mark As Seen" />
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
