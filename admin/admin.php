<?php 
session_start();
if (isset($_SESSION['id'])) {
	header("Location: index.php");
}
require_once'../core/init.php';
$conn= new Database();
if (isset($_POST['submit'])) {
	$email=mysqli_real_escape_string($conn->db,$_POST['mail']);
	$pass=mysqli_real_escape_string($conn->db,$_POST['pass']);

	$result="select * from admin where email='$email' and password='$pass'";
	$run=mysqli_query($conn->db,$result);
	$cheak=mysqli_num_rows($run);
	if ($cheak > 0) {
		while ($row=mysqli_fetch_array($run)) {
			 $_SESSION['bid']=$row['name'];
			 $_SESSION['id']=$row['id'];

		}
		header("Location: index.php");
	}
	else
	{
		
		$error='wrong username or password';
	}
	

}


?>

<!DOCTYPE html>
<html>
<head>
	<title>Admin Login</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
<div class="login">

	
    <?php if (isset($_GET['msg'])){
    	?>

<marquee scrollamount="5" behavior="scroll" width="100%">
	<h3 style="text-shadow: 0 0 3px #FF0000;"><?php echo $_GET['msg']; ?></h3>
</marquee>

<?php } ?>
<h1 style="text-shadow: 1px 1px 2px black, 0 0 25px blue, 0 0 5px darkblue;">Admin Login</h1>

    <?php if (isset($error)) {
	echo "<h4 style=' text-align:center; color:red' t>".$error."</h4>";
} ?>
<form method="post" action="admin.php">
    	<input type="text" name="mail" placeholder="Email" required="required" />
        <input type="password" name="pass" placeholder="Password" required="required" />
        <button type="submit" name="submit" class="btn btn-primary btn-block btn-large">Log in</button>
    </form>
</div>
</body>
</html>
