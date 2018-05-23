<?php
session_start();
if (!isset($_SESSION['id'])) {
	header("Location: admin.php?msg=".urlencode('You are not an Admin! Please Log in'));
 		exit();
}
require_once '../core/init.php'; 
include 'includes/head.php';
 include 'includes/navbar.php';
 $db= new Database();
 $sql="select * from admin order by id" ;
 $query=$db->getall($sql);
 
?>
<div class="row">
	<div class="col-md-3"><?php if (isset($_GET['msg'])) {
	echo "<h3 style='color:green; width: auto' class='form-control ' >".$_GET['msg']."</h3>";
} ?></div>
	<div class="col-md-6">
		<marquee scrollamount="5" behavior="scroll" width="100%">
	<h3 style="text-shadow: 0 0 3px #FF0000;">Welcome "<strong>
		<?php 

		echo $_SESSION["bid"];
		?>
			
		</strong>" To The Admin Panel Of All In One</h3>
</marquee>
	</div>
	<div class="col-md-3"></div>
</div>
<div class="container">
<div class="panel panel-default">
	<div class="panel-heading">
		<h4>User List</h4>
		
	</div>
	<div class="panel-body">
		<table class="table  table-striped">
			<th width="20%">Serial</th>
			<th width="20%">Name</th>
			<th width="20%">Username</th>
			<th width="20%">Email</th>
			<th width="20%">Action</th>
			<?php while ($result=mysqli_fetch_assoc($query)): ?>
			<tr>
				<td><?=$result['id'] ;?></td>
				<td><?=$result['name'] ;?></td>
				<td><?=$result['username'] ;?></td>
				<td><?=$result['email'] ;?></td>
				<?php if ($_SESSION['id']==$result['id']){?> 
				<td> <a  class="btn btn-primary" href="adminprofile.php?id=<?= $result['id']; ?>">View</a></td>
			<?php }?>
				
			</tr>
			<?php endwhile ;?>
		
		</table>
	</div>
</div></div>