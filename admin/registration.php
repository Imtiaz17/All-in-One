<?php
session_start();
if (!isset($_SESSION['id'])){
	header("Location: admin.php");
}
require_once '../core/init.php'; 
include 'includes/head.php';
include 'includes/navbar.php';
include 'user.php';
?>
<?php
	$user= new User();
	if (isset($_POST['register'])) {
		$userrg= $user->userRegistration($_POST);
	}
		
	

?>
<div class="container">
<div class="panel panel-default">
	<div class="panel-heading">
	<h4>Admin Registration</h4>
		</div>
		<div class="panel-body" style="max-width: 600px; margin: 0 auto">
			<?php 
			if (isset($userrg)) {
				echo $userrg;
			}
			?>
			<?php if (isset($_GET['msg'])) {
	echo "<h3  style='color:green' >".$_GET['msg']."</h3>";
} ?>
<script type="text/javascript">
function chkName()
{
		var uname=document.getElementById("username").value;
		if(uname){
			$.ajax({
				type:"POST",
				url:"ajax.php",
				data:{username:uname},
				dataType:"text",
				success:function(data)
				{
					$('#avail').html(data);
					

				}
			});
		}
		else {
			$('avail').html("")
			return false;
		}
	}

</script>

			<form action="" method="POST">
				<div class="form-group"> 
					<label for="name"> Name</label>
					<input type="text" name="name" id="name"  class="form-control" >
					

				</div>
				<div class="form-group"> 
					<label for="username"> User Name</label>
					<input type="text"  name="username" id="username" onkeyup="chkName();" class="form-control">
				<div id="avail"></div>
				</div>
				<div class="form-group"> 
					<label for="email"> Email Address</label>
					<input type="text"  name="email" class="form-control">

				</div>
				
				<div class="form-group"> 
					<label for="pass"> Password</label>
					<input type="password" name="pass" class="form-control">

				</div>
				<input type="submit" name="register" value="submit" class="form-control  btn btn-success ">
			</form>
		</div>
	</div>
</div>
