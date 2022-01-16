<?php include '../lib/Session.php';
Session::checkSession();
include '../config/config.php';
include '../lib/Database.php';

$db = new Database();
?>


<?php
if (!isset($_GET['deletepostid']) || $_GET['deletepostid'] == NULL) {
  echo "<script>window.location = 'catlist.php';</script>";
}

/** Delete Imgae from db and folder**/
else {
    $postid = $_GET['deletepostid'];
    $query = "SELECT * FROM tbl_post WHERE id = '$postid'";
    $getpost = $db->select($query);
    if ($getpost) {
      while ($delimg = $getpost->fetch_assoc()) {
        $dellink = $delimg['img'];
        unlink($dellink);
      }
    }
   }
   /**End of Delete Imgae from db and folder**/

   $delquery = "DELETE FROM tbl_post WHERE id = '$postid'";
   $deldata = $db->delete($delquery);
   if ($deldata) {
     echo "<script>alert('Post deleted Successfully..!'); </script>";
     echo "<script>window.location = 'postlist.php';</script>";
   }
   else {
     echo "<script>alert('Post Not deleted !'); </script>";
     echo "<script>window.location = 'postlist.php';</script>";
   }

    ?>
