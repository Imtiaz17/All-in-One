<?php
session_start();
if (!isset($_SESSION['id'])){
	header("Location: admin.php");
}
require_once '../core/init.php'; 
include 'includes/head.php';
 include 'includes/navbar.php';
 $conn= new Database();
$id=$_GET['id'];
 if(isset($_GET['id']) && !empty($_GET['id']))
{
	$id=$_GET['id'];
	$query="select * from admin where id ='$id'";
	$getData=$conn->getall($query)->fetch_assoc();

}
?>
<?php 

   	if ( isset($_POST['update'])) {
	$name=mysqli_real_escape_string($conn->db,$_POST['name']);
	$username=mysqli_real_escape_string($conn->db,$_POST['username']);
	$email=mysqli_real_escape_string($conn->db,$_POST['email']);
	$pass=mysqli_real_escape_string($conn->db,$_POST['pass']);
	if ($name==''|| $username==''|| $email==''|| $pass=='') {
		$error=" <div class='alert alert-danger' ><strong>Error!</strong> Field must not be empty ! </div>";
		
	}else
	{
	$dbupdate="update admin set name='$name',username='$username',email='$email',password='$pass'  where id ='$id'"; 
	$update=$conn->adminupdate($dbupdate);
   
}

   	}
   
   	?>
<div class="container">
<div class="panel panel-default">
	<div class="panel-heading">
	<h4>Admin Profile <span class="pull-right"> <a class="btn btn-primary"  href="index.php">Back</a></span></h4>
		</div>
	<?php if (isset($error)) {
	echo "<h4 style='color:red'>".$error."</h4>";
} ?>
		<div class="panel-body" style="max-width: 600px; margin: 0 auto">
			<form action="" method="POST">
				<div class="form-group"> 
					<label for="name"> Name</label>
					<input type="text" id="name" name="name" class="form-control" value="<?=$getData['name'];?>">

				</div>
				<div class="form-group"> 
					<label for="username"> User Name</label>
					<input type="text" id="username" name="username" class="form-control"value="<?=$getData['username'];?>">

				</div>
				<div class="form-group"> 
					<label for="email"> Email Address</label>
					<input type="text" id="email" name="email" class="form-control" value="<?=$getData['email'];?>">

				</div>
				
				<div class="form-group"> 
					<label for="pass"> Password</label>
					<input type="text" id="pass" name="pass" class="form-control" value="<?=$getData['password'];?>">

				</div>
				<input type="submit" name="update" value="Update" class="form-control  btn btn-success">
			</form>
		</div>
	</div>
</div>