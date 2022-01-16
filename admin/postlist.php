<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

  <div class="grid_10">
      <div class="box round first grid">
          <h2>Post List</h2>
          <div class="block">
              <table class="data display datatable" id="example">
		<thead>
			<tr>
        <th width="5%">No.</th>
				<th width="10%">Post Title</th>
				<th width="15%">Description</th>
				<th width="5%">Category</th>
				<th width="15%">Image</th>
        <th width="5%">Author</th>
        <th width="10%">Tags</th>
        <th width="10%">Meta Desc.</th>
        <th width="10%">Date</th>
				<th width="15%">Action</th>
			</tr>
		</thead>
		<tbody>

<?php
$query = "SELECT tbl_post.*, tbl_category.name FROM tbl_post
         INNER JOIN tbl_category
         ON tbl_post.cat = tbl_category.id
         ORDER BY tbl_post.title DESC";
$post = $db->select($query);
if ($post) {
 $i = 0;
 while ($show_post = $post->fetch_assoc()) {
   $i++;
    ?>
			<tr class="odd gradeX">
  				<td><?php echo $i; ?></td>
          <td><?php echo "<b>".$show_post['title']." </b>" ;?></td>
  				<td><?php echo $fm->textShorten($show_post['body'],50);?></td>
          <td><?php echo $show_post['name']; ?></td>
	       <td><img src="<?php echo $show_post['img'] ;?>" height="40px" width="60px"/></td>
  				<td><?php echo $show_post['author'] ;?></td>
          <td><?php echo $show_post['tags'] ;?></td>
          <td><?php echo $show_post['meta_description'] ;?></td>
          <td><?php echo $fm->formatDate($show_post['date']); ?></td>
  				<td>
              <a href="viewpost.php?viewpostid=<?php echo $show_post['id'];?>">View</a>
            <?php
if (Session::get('userId') == $show_post['userid'] || Session::get('userRole') == '0') { ?>

             ||<a href="editpost.php?editpostid=<?php echo $show_post['id'];?>">Edit</a> || <a onclick="return confirm('Are you sure to delete ?')" href="delpost.php?deletepostid=<?php echo $show_post['id'];?>">Delete</a>
           <?php } ?>

            </td>
			</tr>
<?php } } ?>
		</tbody>
	</table>

         </div>
      </div>
  </div>
  <div class="clear">
  </div>
</div>
<div class="clear">
</div>
<script type="text/javascript">
      $(document).ready(function () {
      setupLeftMenu();
      $('.datatable').dataTable();
		  setSidebarHeight();
      });
  </script>

<?php include 'inc/footer.php'; ?>
