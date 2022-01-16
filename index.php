
<?php
include 'inc/header.php';
include 'inc/slider.php';
?>

	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
<!--Pagination-->
<?php
$per_page = 3;
if (isset($_GET['page'])) {
	$page = $_GET['page'];
}else {
	$page = 1;
}
$start_from = ($page-1) * $per_page;
 ?>
<!--Pagination-->

						<?php
			        $query = "SELECT * FROM tbl_post limit $start_from, $per_page";
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

			<?php } ?><!--End of while loop-->
<!--Pagination-->
<?php
$query = 'select * from tbl_post';
$result = $db->select($query);
$total_rows = mysqli_num_rows($result);
$total_pages = ceil($total_rows/$per_page);

 echo "<span class='pagination'><a href='index.php?page=1'>".'First page'." </a>";
 for ($i=1; $i <= $total_pages ; $i++) {
 	echo "<a href='index.php?page=".$i."'> ".$i." </a>";
 }
 echo "<a href='index.php?page=$total_pages'>".'Last page'." </a></span>"; ?>

<!--Pagination-->

			<?php }else {header("Location:404.php");} ?> <!--End of if condition-->
		</div>

			<!--Sidebar include-->

		<?php include 'inc/sidebar.php';?>
		</div>

              <!--Footer include-->

<?php include 'inc/footer.php';?>
