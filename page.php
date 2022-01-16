<?php
include 'inc/header.php';

?>
<?php
if (!isset($_GET['pageid']) || $_GET['pageid'] == NULL) {
  echo "<script>window.location = '404.php';</script>";
}else {
    $id = $_GET['pageid'];
}
 ?>

<?php
$pageQ = "SELECT * FROM tbl_pages WHERE id='$id' ";
$sPage = $db->select($pageQ);
if ($sPage) {
while ($rPage = $sPage->fetch_assoc()) {
?>
	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">
				<h2><?php echo $rPage['title']; ?></h2>
        <?php echo $rPage['body']; ?>

	</div>

		</div>
		<?php include 'inc/sidebar.php'; ?>

	</div>
<?php }}else {header("Location:404.php");
} ?>

<?php include 'inc/footer.php' ?>
	<div class="fixedicon clear">
		<a href="http://www.facebook.com"><img src="images/fb.png" alt="Facebook"/></a>
		<a href="http://www.twitter.com"><img src="images/tw.png" alt="Twitter"/></a>
		<a href="http://www.google.com"><img src="images/gl.png" alt="GooglePlus"/></a>
		<a href="http://www.linkedin.com"><img src="images/in.png" alt="LinkedIn"/></a>
	</div>
</body>
</html>
