<link rel="stylesheet" href="font-awesome-4.5.0/css/font-awesome.css">
<link rel="stylesheet" href="css/nivo-slider.css" type="text/css" media="screen" />
<link rel="stylesheet" href="style.css">
<?php
$query = "SELECT * FROM tbl_theme WHERE id='1'";
$flow_theme = $db->select($query);
 while ($result = $flow_theme->fetch_assoc()) {
if ($result['theme'] == 'Default') { ?>
  <link rel="stylesheet" href="theme/default.css">
<?php } elseif ($result['theme'] == 'Green') { ?>
<link rel="stylesheet" href="theme/green.css">
<?php } elseif ($result['theme'] == 'Red') {?>
<link rel="stylesheet" href="theme/default.css">
<?php }} ?>
