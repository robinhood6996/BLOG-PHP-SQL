<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<?php
if (!isset($_GET['viewpostid']) || $_GET['viewpostid'] == NULL) {
  echo "<script>window.location = 'postlist.php';</script>";
}else {
    $postid = $_GET['viewpostid'];
}
 ?>
        <div class="grid_10">

            <div class="box round first grid">
                <h2>Update Post</h2>
            <?php if ($_SERVER['REQUEST_METHOD'] == 'POST') {
              echo "<script>window.location = 'postlist.php';</script>";
            } ?>
                <div class="block">
  <?php
$query = "SELECT * FROM tbl_post WHERE id='$postid'";
$postedit = $db->select($query);
if ($postedit) {
  while ($swpost = $postedit->fetch_assoc()) {
   ?>
                 <form action="" method="post" enctype="multipart/form-data">
                    <table class="form">

                        <tr>
                          <td>
                            <label>Title</label>
                             </td>
                                <td>
                            <input type="text" readonly value="<?php echo $swpost['title'] ;?>" class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Category</label>
                            </td>
                            <td>
                                <select id="select" readonly>
                                  <option> Select Category</option>

  <?php
    $cat_query = "SELECT * FROM tbl_category";
    $cat_option = $db->select($cat_query);
    if ($cat_option) {
    while ($show_cat_option = $cat_option->fetch_assoc()) {
   ?>
                          <option
            <?php if($swpost['cat'] == $show_cat_option['id']){ ?>
                          selected="selected"
            <?php } ?>
                          value="<?php echo $show_cat_option['id']; ?>"><?php echo $show_cat_option['name']; ?></option>
  <?php }} ?>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Upload Image</label>
                            </td>
                            <td>
                              <img src="<?php echo $swpost['img']; ?>" alt="" height="80px" width="200px"></br>
                              
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea readonly class="tinymce">

                                  <?php echo $swpost['body'] ;?>
                                </textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Tags</label>
                            </td>
                            <td>
                                <input type="text" readonly value="<?php echo $swpost['tags'] ?>" class="medium" />
                            </td>
                          <tr>
                            <td>
                                <label>Meta Description</label>
                            </td>
                            <td>
                                <input type="text" readonly value="<?php echo $swpost['meta_description'] ?>" class="medium" />
                            </td>
                          </tr>
                        </tr>
                        <tr>
                            <td>
                                <label>Author</label>
                            </td>
                            <td>
                                <input type="text" readonly value="<?php echo $swpost['author'] ?>" class="medium" />
                                <input type="hidden" name="userid" value="<?php echo Session::get('userId'); ?>" class="medium" />
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
