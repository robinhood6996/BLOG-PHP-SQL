<!-- Page Title Set-->

<!-- Page Title-->
<?php if (isset($_GET['pageid'])) {
	$pId = $_GET['pageid'];
	$ptitleQ = "SELECT * FROM tbl_pages WHERE id='$pId'";
	$title = $db->select($ptitleQ);
	if ($title) {
	  while ($result = $title->fetch_assoc()) { ?>

    	<title>	<?php echo $result['title'];?> | <?php echo TITLE; ?></title>

	  <?php
	} }

	//Post title
}elseif (isset($_GET['id'])) {
	$postid = $_GET['id'];
	$postQ = "SELECT * FROM tbl_post WHERE id='$postid'";
	$postT = $db->select($postQ);
	if ($postT) {
	    while ($posts = $postT->fetch_assoc()) {
?>
<title><?php echo $posts['title']; ?> | <?php echo TITLE;?></title>
<?php

	   } }
//category title,,,..

}elseif (isset($_GET['category'])) {
	$catId = $_GET['category'];
	$catQ = "SELECT * FROM tbl_category WHERE id ='$catId'";
	$cats = $db->select($catQ);
	if ($cats) {
		while ($catr = $cats->fetch_assoc()) { ?>
<title><?php $titlecat = $catr['name']; $titlecat .= " Categories Posts"; echo $titlecat; ?> | <?php echo TITLE;?></title>
	<?php
		}
	}
	//Defult page title;;;
}else {?>
	<title><?php echo $fm->title(); ?> | <?php echo TITLE;?></title>
<?php
}
 ?>
<!--End of page title-->

	<meta name="language" content="English">
	<!--Meta Tags & description from post-->
	<?php
	if(isset($_GET['id'])) {
		$postid = $_GET['id'];
		$postQ = "SELECT * FROM tbl_post WHERE id='$postid'";
		$postT = $db->select($postQ);
		if ($postT) {
		    while ($posts = $postT->fetch_assoc()) {
	 ?>
	<meta name="description" content="<?php echo $posts['meta_description'];?>">
	<meta name="keywords" content="<?php echo $posts['tags'];?>">
<?php } } }else{?>
	<meta name="description" content="<?php echo META_DESCRIPTION; ?>">
	<meta name="keywords" content="<?php echo KEYWORDS; ?>">
<?php
}?>

	<!--Meta Tags & description from post-->
	<meta name="author" content="Delowar">
