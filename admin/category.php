<?php

session_start();
if (!isset($_SESSION['id'])){
	header("Location: admin.php");
}
require_once'../core/init.php ';
include 'includes/head.php';
include 'includes/navbar.php';
$conn= new Database();
$sql="SELECT * FROM categories ORDER BY category";
$pquery=$conn->getall($sql);

//delete brand
if(isset($_GET['delete']) && !empty($_GET['delete']))
{
	$delete_id=(int)$_GET['delete'];
	$delete_id=sanitize($delete_id);
	$sql="delete from categories where id ='$delete_id'";
	$edit_result=$conn->catdelete($sql);
	header('Location:category.php');

}
//edit brand
if(isset($_GET['edit']) && !empty($_GET['edit']))
{
	$edit=(int)$_GET['edit'];
	$edit_id=sanitize($edit);
	$sql2="select * from categories where id='$edit_id'";
	$edit_result=$conn->getall($sql2);
	$dbrand=mysqli_fetch_assoc($edit_result);

}
//add
if(isset($_POST['add'])){

	if($_POST['addcategory'] == ""){
		$error='you must enter a category';
	}
	else
	{
	$category=$_POST['addcategory'];
	$sql="SELECT * FROM categories WHERE category='$category'";
	$result=$conn->getall($sql);
	$count=mysqli_num_rows($result);
	if ($count > 0) {
		$error=$category.' already exists';
	}
	else
	{
	if(isset($_GET['edit'])){
	$upsql="UPDATE categories SET category ='$category' WHERE id ='$edit_id'";
	$up=$conn->catupdate($upsql);
	}
	else{
	$addsql="insert into categories (category) values ('$category')";
	$final= $conn->catinsert($addsql);
	}
	
	}

    }
}

?>
<?php if (isset($error)) {
	echo "<h4 style='color:red'>".$error."</h4>";
} ?>
<center><h2>Add category</h2></center>
<hr>
<?php if (isset($_GET['msg'])) {
	echo "<h3  style='color:green' >".$_GET['msg']."</h3>";
} ?>
<div class="container">
	<div class="col-md-3"></div>
	<div class="col-md-6">
		<form class="form-inline" action="category.php.<?=((isset($_GET['edit']))?'?edit='.$edit_id:'');?>" method="post">
   <div class="form-group mx-sm-3" style="margin-left: 70px;">
   	<?php $brand_value='';
   	if (isset($_GET['edit'])){
   		$brand_value=$dbrand['category'];
   	}else
   	{
   		if (isset($_POST['category']))
   		{
   			$brand_value=sanitize($_POST['category']);
   		}
   	}?>
   
    <input type="text" class="form-control" name="addcategory" id="addcat" placeholder="Add a category" value="<?=$brand_value;?>">
    <?php if (isset($_GET['edit'])): ?>
    <a href="category.php" class="btn btn-default">Cancel</a>
	<?php endif; ?>
  
  <input type="submit"  name="add" value="<?=((isset($_GET['edit']))?'Edit':'Add');?> Category" class="btn btn-success" >
  </div>
  <br>
  <br>
</form>
<table class="table table-bordered table-striped table-condensed">
	<th>Edit</th><th>Category</th><th>Delete</th>
	<?php while ($result=mysqli_fetch_assoc($pquery)): ?>
	<tr>
		<td><a href="category.php?edit=<?= $result['id']; ?>" class="btn btn-xs btn-default"><span class ="glyphicon glyphicon-pencil" ></span></a></td>
		
		<td> <?=$result['category'] ;?></td>
		<td><a href="category.php?delete=<?= $result['id']; ?>"  class="btn btn-xs btn-default"><span class="glyphicon glyphicon-remove-sign"></span></a></td>
	</tr>
<?php endwhile ;?>
</table>
</div>
	</div>
