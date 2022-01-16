<?php include 'inc/header.php'; ?>

<?php
if (!isset($_GET['id']) || $_GET['id'] == NULL) {
	header("Location: 404.php");
}else {
	$id = $_GET['id'];
}
 ?>
	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">
				<?php
        $query = "SELECT * FROM tbl_post WHERE id= $id";
				$post = $db->select($query);
				if ($post) {
				while ($result = $post->fetch_assoc()) {
				 ?>
				<h2><?php echo $result['title']; ?></h2>
				<h4><?php echo $fm->formatDate($result['date']); ?> <a href="#"><?php echo $result['author']; ?></a></h4>
			<img src="admin/<?php echo $result['img'];?>" alt="post image"/>
				<?php echo $result['body']; ?>


				<div class="relatedpost clear">
					<h2>Related articles</h2>
					<?php
           $catid = $result['cat'];
					 $query = "SELECT * FROM tbl_post WHERE cat='$catid' order by rand() limit 6";
					$relatedpost = $db->select($query);
					if ($relatedpost) {
					while ($rresult = $relatedpost->fetch_assoc()) {

					 ?>
					<a href="post.php?id=<?php echo $rresult['id'];?>"><img src="admin/<?php echo $rresult['img'];?>" alt="post image"/></a>
				<?php } }else {echo "No related post found!!";	} ?>
				</div>
	</div>
		</div>
<?php } } else {header("Location: 404.php");	} ?>
	<?php include 'inc/sidebar.php'; ?>
	<?php include 'inc/footer.php'?>
