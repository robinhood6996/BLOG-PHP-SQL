<?php include 'config/config.php';?>
<?php include 'lib/Database.php';?>
<?php include 'helpers/Format.php';?>

<?php
$db = new Database();
$fm = new Format();
?>

<!DOCTYPE html>
<html>
<head>

  <?php
        include 'scripts/meta.php';
	      include 'scripts/css.php';
        include 'scripts/js.php';
	?>


</head>

<body>
	<div class="headersection templete clear">
		<a href="#">
			<div class="logo">
				<?php
$query = "SELECT * FROM tsl WHERE id='1'";
$readData = $db->select($query);
if ($readData) {
while ($result = $readData->fetch_assoc()) {
				 ?>
				<img src="admin/<?php echo $result['logo'];?>" alt="Logo"/>
				<h2><?php echo $result['title']; ?></h2>
				<p style="margin-left:110px;"><?php echo $result['slogan']; ?></p>
					<?php }} ?>
			</div>

		</a>
		<div class="social clear">
		<?php
$sql = "SELECT * FROM tbl_social WHERE id = '1'";
$socil = $db->select($sql);
if ($socil) {
	while ($result = $socil->fetch_assoc()) {
		?>
			<div class="icon clear">
				<a href="<?php echo $result['fb']; ?>" target="_blank"><i class="fa fa-facebook"></i></a>
				<a href="<?php echo $result['tw']; ?>" target="_blank"><i class="fa fa-twitter"></i></a>
				<a href="<?php echo $result['link']; ?>" target="_blank"><i class="fa fa-linkedin"></i></a>
				<a href="<?php echo $result['gp']; ?>" target="_blank"><i class="fa fa-google-plus"></i></a>
			</div>
		<?php }} ?>
			<div class="searchbtn clear">

			<form action="search.php" method="get">
				<input type="text" name="search" placeholder="Search keyword..."/>
				<input type="submit" name="submit" value="Search"/>
			</form>

			</div>
		</div>
	</div>
<div class="navsection templete">
	<?php
	$path = $_SERVER['SCRIPT_FILENAME'];
	$cpage = basename($path, '.php');
	 ?>
	<ul>
		<li><a <?php if($cpage == 'index'){ echo "id='active'";}?>href="index.php">Home</a></li>

						<?php
				$pageQ = "SELECT * FROM tbl_pages";
				$sPage = $db->select($pageQ);
				if ($sPage) {
				while ($rPage = $sPage->fetch_assoc()) {
				?>
				<!--Page highlight-->
		<li><a <?php if (isset($_GET['pageid']) && $_GET['pageid'] == $rPage['id']) {
			echo "id='active'";
		} ?>href="page.php?pageid=<?php echo $rPage['id']; ?>"><?php echo $rPage['title'] ?></a></li>
	<?php }} ?>
	<li><a <?php if($cpage == 'contact'){ echo "id='active'";}?> href="contact.php">Contact</a></li>
	</ul>
</div>
