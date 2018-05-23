	<?php 
	$db=mysqli_connect("localhost","root","","aio");
	if (isset($_POST['username'])) {
			$username=$_POST['username'];
			$sql="select * from admin where username='$username'";
			$query=mysqli_query($db,$sql);
			if (mysqli_num_rows($query)>0) {
				 echo '<span class="text-danger">Username not availble</span> ';
			}
			else
			{
				echo '<span class="text-success">Available</span> ';

			}
			exit();
		}