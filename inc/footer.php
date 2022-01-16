	<div class="footersection templete clear">
	  <div class="footermenu clear">
			<ul>
				<li><a href="#">Home</a></li>
				<?php
		$pageQ = "SELECT * FROM tbl_pages";
		$sPage = $db->select($pageQ);
		if ($sPage) {
		while ($rPage = $sPage->fetch_assoc()) {
		?>
					<li><a href="page.php?pageid=<?php echo $rPage['id']; ?>"><?php echo $rPage['title'] ?></a></li>
			<?php }} ?>
			</ul>
	  </div>
		<?php
	$sData = "SELECT * FROM tbl_copy WHERE id='1'";
	$rData = $db->select($sData);
	if ($rData) {
		while ($result = $rData->fetch_assoc()) {
		 ?>
	  <p>&copy;<?php echo $result['note']; echo Date('Y'); ?></p>
	<?php }} ?>

	</div>
	<?php
	$sql = "SELECT * FROM tbl_social WHERE id = '1'";
	$socil = $db->select($sql);
	if ($socil) {
		while ($result = $socil->fetch_assoc()) {
			?>

	<div class="fixedicon clear">
		<a href="<?php echo $result['fb'];?>"><img src="images/fb.png" alt="Facebook"/></a>
		<a href="<?php echo $result['tw'];?>"><img src="images/tw.png" alt="Twitter"/></a>
		<a href="<?php echo $result['link'];?>"><img src="images/in.png" alt="LinkedIn"/></a>
		<a href="<?php echo $result['gp'];?>"><img src="images/gl.png" alt="GooglePlus"/></a>
	</div>
<?php }} ?>
<script type="text/javascript" src="js/scrolltop.js"></script>
</body>
</html>
