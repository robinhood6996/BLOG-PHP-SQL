<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
        <div class="grid_10">

            <div class="box round first grid">
                <h2>Add New Post</h2>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = mysqli_real_escape_string($db->link, $_POST['title']);
    $cat = mysqli_real_escape_string($db->link, $_POST['cat']);
    $body = mysqli_real_escape_string($db->link, $_POST['body']);
    $tags = mysqli_real_escape_string($db->link, $_POST['tags']);
    $author = mysqli_real_escape_string($db->link, $_POST['author']);
    $userid = mysqli_real_escape_string($db->link, $_POST['userid']);
    $meta_desc = mysqli_real_escape_string($db->link, $_POST['meta_desc']);

    $permited  = array('jpg', 'jpeg', 'png', 'gif');
    $file_name = $_FILES['img']['name'];
    $file_size = $_FILES['img']['size'];
    $file_temp = $_FILES['img']['tmp_name'];

    $div = explode('.', $file_name);
    $file_ext = strtolower(end($div));
    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
    $uploaded_image = "upload/".$unique_image;

    if ($title == "" || $cat == "" || $body == "" || $tags == "" || $meta_desc == "" || $author == "" ||   $file_name == "" || $userid == "" ) {
        echo "<span class='error'>Feild Must not be empty!!! </span>";
    }
    elseif ($file_size >1048567) {
     echo "<span class='error'>Image Size should be less then 1MB!</span>";
    }
     elseif (in_array($file_ext, $permited) === false) {
     echo "<span class='error'>You can upload only:-"
     .implode(', ', $permited)."</span>";
    }

    else{
    move_uploaded_file($file_temp, $uploaded_image);
    $query = "INSERT INTO tbl_post(cat, title, body, img, author, tags, meta_description,userid)
    VALUES('$cat','$title','$body', '$uploaded_image', '$author', '$tags','$meta_desc','$userid')";
    $inserted_rows = $db->insert($query);
    if ($inserted_rows) {
     echo "<span class='success'>New Post added...!</span>";
    }else {
     echo "<span class='error'>Failed to post !</span>";
    }
    }

  }

    ?>

                <div class="block">
                 <form action="" method="post" enctype="multipart/form-data">
                    <table class="form">

                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text" name="title" placeholder="Enter Post Title..." class="medium" />
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
                          <option value="<?php echo $show_cat_option['id']; ?>"><?php echo $show_cat_option['name']; ?></option>
  <?php }} ?>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Upload Image</label>
                            </td>
                            <td>
                                <input name="img" type="file" />
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea name="body" class="tinymce"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Tags</label>
                            </td>
                            <td>
                                <input type="text" name="tags" placeholder="Enter tags..." class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Meta Description</label>
                            </td>
                            <td>
                                <input type="text" name="meta_desc" placeholder="Enter meta Description" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Author</label>
                            </td>
                            <td>
                                <input type="text" name="author" value="<?php echo Session::get('username'); ?>" class="medium" />
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
