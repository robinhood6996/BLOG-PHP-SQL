<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<?php
if (!isset($_GET['editpostid']) || $_GET['editpostid'] == NULL) {
  echo "<script>window.location = 'catlist.php';</script>";
}else {
    $postid = $_GET['editpostid'];
}
 ?>
        <div class="grid_10">

            <div class="box round first grid">
                <h2>Update Post</h2>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = mysqli_real_escape_string($db->link, $_POST['title']);
    $cat = mysqli_real_escape_string($db->link, $_POST['cat']);
    $body = mysqli_real_escape_string($db->link, $_POST['body']);
    $tags = mysqli_real_escape_string($db->link, $_POST['tags']);
    $meta_desc = mysqli_real_escape_string($db->link, $_POST['meta_desc']);
    $author = mysqli_real_escape_string($db->link, $_POST['author']);
    $userid = mysqli_real_escape_string($db->link, $_POST['userid']);

    $permited  = array('jpg', 'jpeg', 'png', 'gif');
    $file_name = $_FILES['img']['name'];
    $file_size = $_FILES['img']['size'];
    $file_temp = $_FILES['img']['tmp_name'];

    $div = explode('.', $file_name);
    $file_ext = strtolower(end($div));
    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
    $uploaded_image = "upload/".$unique_image;

    if ($title == "" || $cat == "" || $body == "" || $tags == "" || $meta_desc == "" || $author == "" || $userid == "") {
        echo "<span class='error'>Feild Must not be empty!!! </span>";
    }
    else {

    if (!empty($file_name)) {
    if ($file_size >1048567) {
     echo "<span class='error'>Image Size should be less then 1MB!</span>";
    }
     elseif (in_array($file_ext, $permited) === false) {
     echo "<span class='error'>You can upload only:-"
     .implode(', ', $permited)."</span>";
    }

    else{
  move_uploaded_file($file_temp, $uploaded_image);
      $query = "UPDATE tbl_post
      SET
      cat = '$cat',
      title = '$title',
      body = '$body',
      img = '$uploaded_image',
      author = '$author',
      tags = '$tags',
      meta_description = '$meta_desc',
      userid = '$userid'
      WHERE id='$postid'";
    $update_row = $db->update($query);
    if ($update_row) {
     echo "<span class='success'>Post edited successfullt 11..!</span>";
    }else {
     echo "<span class='error'>Post not edited it might have some problem</span>";
    }
    }

  }else {
      $query = "UPDATE tbl_post
      SET
      cat = '$cat',
      title = '$title',
      body = '$body',
      author = '$author',
      tags = '$tags',
      meta_description = '$meta_desc',
      userid = '$userid'
      WHERE id='$postid'";
    $update_row = $db->update($query);
    if ($update_row) {
     echo "<span class='success'>Post edited successfullt 22..!</span>";
    }else {
     echo "<span class='error'>Post not edited it might have some problem</span>";
    }
}
  }

  }

    ?>

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
                            <input type="text" name="title" value="<?php echo $swpost['title'] ;?>" class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Category</label>
                            </td>
                            <td>
                                <select id="select" name="cat">
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
                                <input name="img" type="file" />
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea name="body" class="tinymce">

                                  <?php echo $swpost['body'] ;?>
                                </textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Tags</label>
                            </td>
                            <td>
                                <input type="text" name="tags" value="<?php echo $swpost['tags'] ?>" class="medium" />
                            </td>
                          <tr>
                            <td>
                                <label>Meta Description</label>
                            </td>
                            <td>
                                <input type="text" name="meta_desc" value="<?php echo $swpost['meta_description'] ?>" class="medium" />
                            </td>
                          </tr>
                        </tr>
                        <tr>
                            <td>
                                <label>Author</label>
                            </td>
                            <td>
                                <input type="text" name="author" value="<?php echo $swpost['author'] ?>" class="medium" />
                                <input type="hidden" name="userid" value="<?php echo Session::get('userId'); ?>" class="medium" />
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
