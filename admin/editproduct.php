<?php
session_start();
if (!isset($_SESSION['id'])){
	header("Location: admin.php");
}
require_once'../core/init.php';
include 'includes/head.php';
include 'includes/navbar.php';

$bsql="SELECT * FROM brand ORDER BY brand";
$csql="SELECT * FROM categories ORDER BY category";
$bquery=$conn->query($bsql);
$cquery=$conn->query($csql);

$id=isset($_GET['edit'])? $_GET['edit']:'';
$query="select * from product where id='$id'";
$result= mysqli_query($conn,$query);
$row=mysqli_fetch_array($result);


$proname=$row['title'];
$proprice=$row['price'];
	$prolistprice=$row['list_price'];
	$probrand=$row['brand'];
	$procat=$row['cat'];
	$proimage=$row['image'];
	$prodescription=$row['description'];

if ( isset($_POST['submit'])) {
	$pro_name=mysqli_real_escape_string($conn,$_POST['title']);
	$pro_price=mysqli_real_escape_string($conn,$_POST['price']);
	$pro_list_price=mysqli_real_escape_string($conn,$_POST['list_price']);
	$pro_brand=mysqli_real_escape_string($conn,$_POST['brand']);
	
	$pro_cat=mysqli_real_escape_string($conn,$_POST['cat']);
	$pro_description=mysqli_real_escape_string($conn,$_POST['description']);
	
	$pro_image=$_FILES['image']['name'];
	$pro_temp=$_FILES['image']['tmp_name'];

		move_uploaded_file($pro_temp, "../images/$pro_image");
$dbinsert="update product set title='$pro_name',price='$pro_price',list_price='$pro_list_price',brand='$pro_brand',cat='$pro_cat',image='$pro_image',description='$pro_description' where id ='$id'";

$final=mysqli_query($conn,$dbinsert);
    	 if ($final == true) {echo "pro inserted";}
    	 else {echo mysqli_error($conn);} 
}

?>

 

<h2 class="text-center"> Update Product</h2>
<a href="product.php" class="btn btn-default pull-right id="product" style="margin-top: -30px;">Cancel</a>
<hr>
<form action="editproduct.php" method="GET" enctype="multipart/form-data">
	<div class="form-group">
		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-6">
				<div class="row">
					<div class="col-md-2">
				<h4><b>Title</b></h4>
				</div>
				<div class="col-md-6">
				<input type="text" name="title" class="form-control" value="<?=$proname;?>">
				</div>
			</div>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-6">
				<div class="row">
					<div class="col-md-2">
				<h4><b>Brand</b></h4>
				</div>
				<div class="col-md-6">
					<select class="form-control"  name="brand">
						<option value="<?=$probrand;?>"><?=$probrand;?></option>
						<?php

						
						while ($row=mysqli_fetch_assoc($bquery)) {
							?>
							 <option value="<?php echo $row['brand'];?>"><?php echo $row['brand']?></option>";	
							<?php }	?>

					</select>
				</div>
			</div>
			</div>  
			</div>                  
		
		<br>
			<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-6">
				<div class="row">
					<div class="col-md-2">
				<h4><b>Category</b></h4>
				</div>
				<div class="col-md-6">
					<select class="form-control"  name="cat">
						<option value="<?=$procat;?>"><?=$procat;?></option>
						<?php
					
						while ($row=mysqli_fetch_assoc($cquery)) {
							?>
							 <option value="<?php echo $row['category'];?>"><?php echo $row['category']?></option>"	
							<?php }	?>

					</select>
				</div>
			</div>
			</div>                   
		</div>
		<br>
		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-6">
				<div class="row">
					<div class="col-md-2">
				<h4><b>Price</b></h4>
				</div>
				<div class="col-md-6">
					<input type="text" name="price" class="form-control" value="<?=$proprice?>">
				</div>
				</div>
			</div>
		</div>
		<br>
			<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-6">
				<div class="row">
					<div class="col-md-2">
				<h4><b>List Price</b></h4>
				</div>
				<div class="col-md-6">
					<input type="text" name="list_price" class="form-control" value="<?=$proprice?>">
				</div>
				</div>
			</div>
		</div>
		<br>
		
				
		<br>
			<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-6">
				<div class="row">
					<div class="col-md-2">
				<h4><b>Image</b></h4>
				</div>
				<div class="col-md-6">
					<input type="file" name="image" id="image" class="form-control" value="<?=$proimage;?>">
					<img src="../images/<?=$proimage;?>" style="width: 100px; height: 100px;"> 
				</div>
				</div>
			</div>
		</div>
		<br>
			<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-6">
				<div class="row">
					<div class="col-md-2">
				<h4><b>Description</b></h4>
				</div>
				<div class="col-md-6">
					<textarea rows="5" name="description" class="form-control"><?=$prodescription;?></textarea>
				</div>
				</div>
			</div>
		</div>

		<br>
		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-6">
				<input type="submit" name="submit" value="update Product " class="form-control  btn btn-success pull-right">
			</div>
		</div>



	</div>
</form>
