<?php include '../lib/Session.php';
Session::checkSession();
include '../config/config.php';
include '../lib/Database.php';
include '../helpers/Format.php';
$db = new Database();
?>


<?php
if (!isset($_GET['delpage']) || $_GET['delpage'] == NULL) {
  echo "<script>window.location = 'index.php';</script>";
}

/** Delete Imgae from db and folder**/
else {
    $pageid = $_GET['delpage'];
   }
   /**End of Delete Imgae from db and folder**/

   $delquery = "DELETE FROM tbl_pages WHERE id = '$pageid'";
   $deldata = $db->delete($delquery);
   if ($deldata) {
     echo "<script>alert('Page deleted Successfully..!'); </script>";
     echo "<script>window.location = 'index.php';</script>";
   }
   else {
     echo "<script>alert('Page Not deleted !'); </script>";
     echo "<script>window.location = 'index.php';</script>";
   }

    ?>
