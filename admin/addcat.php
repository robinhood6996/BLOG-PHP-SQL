<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
        <div class="grid_10">

            <div class="box round first grid">
                <h2>Add New Category</h2>
               <div class="block copyblock">
  <?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $name = mysqli_real_escape_string($db->link, $name);
    if (empty($name)) {
       echo "<span class='error'>Feild Must not be empty!!! </span>";
    }else {
      $query= "INSERT INTO tbl_category(name) VALUES('$name')";
      $addcat = $db->insert($query);
      if ($addcat) {
        echo "<span class='success'>Category Inserted successfully..! </span>";
      }else {
       echo "<span class='error'>Category Insert operation failed! </span>";
      }
    }
}
   ?>
                 <form action="" method="post">
                    <table class="form">
                        <tr>
                            <td>
                                <input type="text" name="name" placeholder="Enter Category Name..." class="medium" />
                            </td>
                        </tr>
						            <tr>
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
        <div class="clear">
        </div>
    </div>
  <?php include 'inc/footer.php'; ?>
