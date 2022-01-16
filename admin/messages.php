<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Inbox</h2
  <?php
if (isset($_GET['seenmsg'])){
$seenId = $_GET['seenmsg'];
  $seenQuery = "UPDATE tbl_msg
                SET status='1'
               WHERE id='$seenId'";
  $tnsferToSeen = $db->update($seenQuery);

  if ($tnsferToSeen) {
    echo "This message sent to the seenbox!";
  }else {
    echo "Something went wrong!";
  }
}


   ?>
        <div class="block">
            <table class="data display datatable" id="example">
	<thead>
		<tr>
  			<th>Serial No.</th>
  			<th>Name</th>
        <th>Email</th>
        <th>Message</th>
        <th>Date</th>
  			<th>Action</th>
		</tr>
	</thead>
	<tbody>
    <?php
$mquery = "SELECT * FROM tbl_msg WHERE status='0'";
$rmsg = $db->select($mquery);
if ($rmsg) {
  $i = 0;
  while ($dmsg = $rmsg->fetch_assoc()) {
     ?>
		<tr class="odd gradeX">
  			<td><?php echo $i; ?></td>
  			<td><?php echo $dmsg['firstname'].''.$dmsg['lastname'];?></td>
        <td><?php echo $dmsg['email']; ?></td>
        <td><?php echo $fm->textshorten($dmsg['message'],30);?></td>
        <td><?php echo $fm->formatdate($dmsg['times']);?></td>
  			<td><a href="viewmsg.php?msgid=<?php echo $dmsg['id'];?>">View</a>
             || <a href="replymsg.php?msgid=<?php echo $dmsg['id'];?>">Reply</a>
             || <a onclick="return confirm('Are you sure to move this into seenbox ?')" href="?seenmsg=<?php echo $dmsg['id'];?>">Seen</a></td>
		</tr>
<?php } } ?>
	</tbody>
</table>
       </div>
    </div>
</div>



<div style="width:80%;" class="grid_10">
    <div class="box round first grid">
        <h2>Seen Message</h2>
<?php
//Sent to inbox from seen box;;;
if (isset($_GET['unseenmsgid'])) {
  $unseenId = $_GET['unseenmsgid'];
$unseenQuery = "UPDATE tbl_msg
              SET status='0'
             WHERE id='$unseenId'";
 $doseen = $db->update($unseenQuery);
 if ($doseen) {
   echo "This messsage sent to the Inbox!";
 }else {
   echo "Somethig went wrong!";
 }
}


//Delete Message from seenbox!!

if (isset($_GET['delmsgid'])) {
  $delmsgId = $_GET['delmsgid'];
$delmsgQuery = "DELETE FROM tbl_msg
             WHERE id='$delmsgId'";
 $dodel = $db->update($delmsgQuery);
 if ($dodel) {
   echo "This messsage sent to the Inbox!";
 }else {
   echo "Somethig went wrong!";
 }
}
 ?>
        <div class="block">
          <table class="data display datatable" id="example">
<thead>
  <tr>
      <th>Serial No.</th>
      <th>Name</th>
      <th>Email</th>
      <th>Message</th>
      <th>Date</th>
      <th>Action</th>
  </tr>
</thead>
<tbody>
  <?php
$mquery = "SELECT * FROM tbl_msg WHERE status='1'";
$rmsg = $db->select($mquery);
if ($rmsg) {
$i = 0;
while ($dmsg = $rmsg->fetch_assoc()) {
   ?>
  <tr class="odd gradeX">
      <td><?php echo $i; ?></td>
      <td><?php echo $dmsg['firstname'].''.$dmsg['lastname'];?></td>
      <td><?php echo $dmsg['email']; ?></td>
      <td><?php echo $fm->textshorten($dmsg['message'],30);?></td>
      <td><?php echo $fm->formatdate($dmsg['times']);?></td>
      <td><a href="?unseenmsgid=<?php echo $dmsg['id'];?>">Unseen</a>
           || <a href="viewmsg.php?msgid=<?php echo $dmsg['id'];?>">Open</a>
           || <a onclick="return confirm('Are you sure to delete this message ?')" href="?delmsgid=<?php echo $dmsg['id'];?>">Delete</a></td>
  </tr>
<?php } } ?>
</tbody>
</table>
       </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
    setupLeftMenu();
    $('.datatable').dataTable();
    setSidebarHeight();
    });
</script>

<?php include 'inc/footer.php'; ?>
