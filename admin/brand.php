<?php
session_start();
if (!isset($_SESSION['id'])){
	header("Location: admin.php");
}

require_once'../core/init.php ';
include 'includes/head.php';
include 'includes/navbar.php';
$conn= new Database();
$sql="SELECT * FROM brand ORDER BY brand";
$pquery=$conn->getall($sql);

//delete brand
if(isset($_GET['delete']) && !empty($_GET['delete']))
{
	$delete_id=(int)$_GET['delete'];
	$delete_id=sanitize($delete_id);
	$sql="delete from brand where id ='$delete_id'";
	$edit_result=$conn->branddelete($sql);
	header('Location:brand.php');

}
//edit brand
if(isset($_GET['edit']) && !empty($_GET['edit']))
{
	$edit=(int)$_GET['edit'];
	$edit_id=sanitize($edit);
	$sql2="select * from brand where id='$edit_id'";
	$edit_result=$conn->getall($sql2);
	$dbrand=mysqli_fetch_assoc($edit_result);

}
//add
if(isset($_POST['add'])){

	if($_POST['addbrand'] == ""){
		$error='you must enter a brand';
	}
	else
	{
	$brand=$_POST['addbrand'];
	$sql="SELECT * FROM brand WHERE brand='$brand'";
	$result=$conn->getall($sql);
	$count=mysqli_num_rows($result);
	if ($count > 0) {
		$error=$brand.' already exists';
	}
	else
	{
	if(isset($_GET['edit'])){
	$upsql="UPDATE brand SET brand ='$brand' WHERE id ='$edit_id'";
	$up=$conn->brandupdate($upsql);
	}
	else{
	$addsql="insert into brand (brand) values ('$brand')";
	$final= $conn->brandinsert($addsql);
	}
	
	}

    }
}

?>
<?php if (isset($error)) {
	echo "<h4 style='color:red'>".$error."</h4>";
} ?>
<center><h2>Add Brand</h2></center>
<hr>
<?php if (isset($_GET['msg'])) {
	echo "<h3  style='color:green' >".$_GET['msg']."</h3>";
} ?>
<div class="container">
	<div class="col-md-3"></div>
	<div class="col-md-6">
		<form class="form-inline" action="brand.php<?=((isset($_GET['edit']))?'?edit='.$edit_id:'');?>" method="post">
   <div class="form-group mx-sm-3" style="margin-left: 70px;">
   	<?php $brand_value='';
   	if (isset($_GET['edit'])){
   		$brand_value=$dbrand['brand'];
   	}else
   	{
   		if (isset($_POST['brand']))
   		{
   			$brand_value=sanitize($_POST['brand']);
   		}
   	}?>
   	<label for="brand"><?=((isset($_GET['edit']))?'Edit':'Add a');?> Brand:</label>
    <input type="text" class="form-control" name="addbrand" id="addbrand" placeholder="Add a brand" value="<?=$brand_value;?>">
    <?php if (isset($_GET['edit'])): ?>
    <a href="brand.php" class="btn btn-default">Cancel</a>
	<?php endif; ?>
  
  <input type="submit"  name="add" value="<?=((isset($_GET['edit']))?'Edit':'Add');?> Brand" class="btn btn-success" >
  </div>
  <br>
  <br>
</form>

<table class="table table-bordered table-striped table-condensed">
	<th>Edit</th><th>Brand</th><th>Delete</th>
	<?php while ($result=mysqli_fetch_assoc($pquery)): ?>
	<tr>
		<td><a href="brand.php?edit=<?= $result['id']; ?>" class="btn btn-xs btn-default"><span class ="glyphicon glyphicon-pencil" ></span></a></td>
		
		<td> <?=$result['brand'] ;?></td>
		<td><a href="brand.php?delete=<?= $result['id']; ?>"  class="btn btn-xs btn-default"><span class="glyphicon glyphicon-remove-sign"></span></a></td>
	</tr>
<?php endwhile ;?>

</table>
</div>
	</div>



