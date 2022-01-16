
<?php
include 'inc/header.php';
include 'inc/slider.php';
?>
<?php
if (!isset($_GET['category']) || $_GET['category'] == NULL) {
	header("Location: 404.php");
}else {
	$catid = $_GET['category'];
}
 ?>
	<div class="contentsection contemplete clear">
	<div class="maincontent clear">
    <?php
		//Show post by category;;;
      $query = "SELECT * FROM tbl_post WHERE cat=$catid ";
      $post = $db->select($query);
      if ($post) {
      while ($result = $post->fetch_assoc()) {
     ?>

    <div class="samepost clear">
    	<h2><a href="post.php?id=<?php echo $result['id'];?>"><?php echo $result['title']; ?></a></h2>
    	<h4><?php echo $fm->formatDate($result['date']); ?> <a href="#"><?php echo $result['author']; ?></a></h4>
    	 <a href="post.php?id=<?php echo $result['id'];?>"><img src="admin/<?php echo $result['img'];?>" alt="post image"/></a>
    	<p>
    		<?php echo $fm->textShorten($result['body']); ?>
    	</p>
    	<div class="readmore clear">
    		<a href="post.php?id=<?php echo $result['id'];?>">Read More</a>
    	</div>
    </div>
<?php } } else {  ?>
<p> No related post found for!!!</p>
<?php } ?>
</div>
<!--Sidebar include-->
<?php include 'inc/sidebar.php';?>

<!--Footer include-->
<?php include 'inc/footer.php';?>
