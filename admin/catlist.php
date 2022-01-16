<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Category List</h2>
  <?php
if (isset($_GET['deletecat'])) {
  $del_cat_id = $_GET['deletecat'];
  $cat_del_query = "DELETE FROM tbl_category WHERE id = '$del_cat_id'";
  $deleteCat = $db->delete($cat_del_query);
  if ($deleteCat) {
    echo "<span class='success'>Category Delete successfully..! </span>";
  }else {
   echo "<span class='error'>Category Delete operation failed! </span>";
  }
}

   ?>
                <div class="block">
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Category Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
            <?php
            $query = "SELECT * FROM tbl_category";
            $cat = $db->select($query);
            if ($cat) {
              $i = 0;
             while ($showCat = $cat->fetch_assoc()) {
               $i++
             ?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $showCat['name']; ?></td>
							<td><a href="editcat.php?catid=<?php echo $showCat['id'];?>">Edit</a> ||
                <a onclick="return confirm('Are you sure to delete ?')" href="?deletecat=<?php echo $showCat['id'];?>">Delete</a></td>
						</tr>

            <?php }}else {   echo "no data found"; } ?>

					</tbody>
				</table>

               </div>
            </div>

        </div>
        <div class="clear">
        </div>
    </div>

    <script type="text/javascript">
   $(document).ready(function (){
     setupLeftMenu();
     $('.datatable').dataTable();
     setSidebarHeight();
   });
    </script>
      <?php include 'inc/footer.php'; ?>
