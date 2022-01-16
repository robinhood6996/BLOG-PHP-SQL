<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<style media="screen">
  .actiondel{margin-left: 10px;padding: 4px 2px; background: red;color:white;}
</style>
<?php
if (!isset($_GET['pageid']) || $_GET['pageid'] == NULL) {
  echo "<script>window.location = 'index.php';</script>";
}else {
    $id = $_GET['pageid'];
}
 ?>
        <div class="grid_10">

            <div class="box round first grid">
                <h2>Add New Page</h2>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = mysqli_real_escape_string($db->link, $_POST['title']);
    $body = mysqli_real_escape_string($db->link, $_POST['body']);

    if ($title == "" || $body == "") {
        echo "<span class='error'>Feild Must not be empty!!! </span>";
    }
    else{
    $query = "UPDATE tbl_pages SET title='$title', body='$body' WHERE id='$id'";
    $inserted_rows = $db->update($query);
    if ($inserted_rows) {
     echo "<span class='success'>Page updated successfully...!</span>";
    }else {
     echo "<span class='error'>Failed to update this page !</span>";
    }
    }

  }

    ?>

                <div class="block">
          <?php
  $pageQ = "SELECT * FROM tbl_pages WHERE id='$id' ";
  $sPage = $db->select($pageQ);
  if ($sPage) {
    while ($rPage = $sPage->fetch_assoc()) {
    ?>

                 <form action="" method="post" enctype="multipart/form-data">
                    <table class="form">

                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text" name="title" value="<?php echo $rPage['title']; ?>" class="medium" />
                            </td>
                        </tr>


                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea name="body" class="tinymce">
                                <?php echo $rPage['body'];?>
                                </textarea>
                            </td>
                        </tr>

						               <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                                <span class="actiondel"><a  onclick="return confirm('Are you sure to delete ?')" href="deletepage.php?delpage=<?php echo $rPage['id'] ;?>">Delete</a></span>
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
