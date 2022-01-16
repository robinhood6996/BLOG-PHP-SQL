<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
        <div class="grid_10">

    <?php if ($_SERVER['REQUEST_METHOD'] == 'POST'){
       $tomail = $fm->validation($_POST['tomail']);
       $fromemail = $fm->validation($_POST['frommail']);
       $subject = $fm->validation($_POST['subject']);
       $message =$fm->validation($_POST['message']);
       $sendMail = mail($tomail, $subject, $message, $fromemail);
       if ($sendMail) {
         echo "Mail send successfully!";
       }else {
         echo "Something went wrong!";
       }
       }




     ?>

            <div class="box round first grid">
                <h2>Reply Message</h2>

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
                                <label>To</label>
                            </td>
                            <td>
                                <input type="email" value="<?php echo $msgread['email']; ?>" name="tomail" class="medium" readonly />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>from</label>
                            </td>
                            <td>
                                <input type="email" name="frommail"  class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Subject</label>
                            </td>
                            <td>
                                <input type="text" name="subject"  class="medium" />
                            </td>
                        </tr>


                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Message</label>
                            </td>
                            <td>
                                <textarea name="message" class="tinymce">
                                  <?php echo $msgread['message']; ?>
                                </textarea>
                            </td>
                        </tr>


						               <tr>
                            <td></td>
                            <td>
                                <input style="background:green;color:white;" type="submit" name="submit" Value="Send" />
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
