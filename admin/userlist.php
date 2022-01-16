<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Users List</h2>
  <?php
if (isset($_GET['deluserid'])) {
  $del_user_id = $_GET['deluserid'];
  $usr_del_query = "DELETE FROM tbl_user WHERE id = '$del_user_id'";
  $deleteUser = $db->delete($usr_del_query);
  if ($deleteUser) {
    echo "<span class='success'>User Delete successfully..! </span>";
  }else {
   echo "<span class='error'>User Delete operation failed! </span>";
  }
}

   ?>
                <div class="block">
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th> Name</th>
              <th>UserName</th>
              <th>Email</th>
              <th>Desciption</th>
              <th>Role</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
            <?php
            $query = "SELECT * FROM tbl_user";
            $user = $db->select($query);
            if ($user) {
              $i = 0;
             while ($showuser = $user->fetch_assoc()) {
               $i++
             ?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $showuser['name']; ?></td>
              <td><?php echo $showuser['username']; ?></td>
              <td><?php echo $showuser['email']; ?></td>
              <td><?php echo $showuser['details']; ?></td>
              <td><?php if($showuser['role'] == '0') {
                echo "Admin";
              }elseif ($showuser['role'] == '1') {
                echo "Editor";
              }elseif ($showuser['role'] == '2') {
                echo "Moderator";
              } ?></td>
							<td><a href="viewUser.php?userid=<?php echo $showuser['id'];?>">View</a> ||
                <a onclick="return confirm('Are you sure to delete ?')" href="?deluserid=<?php echo $showuser['id'];?>">Delete</a></td>
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
