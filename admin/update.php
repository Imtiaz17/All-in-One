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

	if (isset($_GET['edit'])) {
		$id = $_GET['edit'];
	
		$record = mysqli_query($conn, "SELECT * FROM product WHERE id=$id");
		$record->setFetchMode(PDO:: FETCH_ASSOC);
		$record->execute();

	
			$produc = mysqli_fetch_array($record);
			$proname=$produc['title'];
			$proprice=$produc['price'];
			$prolistprice=$produc['list_price'];
			$probrand=$produc['brand'];
			$procat=$produc['cat'];
			$proimage=$produc['image'];
			$prodescription=$produc['description'];
		}



	if (isset($_POST['submit'])) {
	$title = $_POST['title'];
	$brand=$_POST['brand'];
	$category=$_POST['cat'];
	$price = $_POST['price'];
	$list_price = $_POST['list_price'];

	$result=mysqli_query($conn, "UPDATE product SET title='$title', price='$price',list_price='$list_price',brand='$brand' ,cat='$category' WHERE id='$id'");
	 if ($result == true) {echo "pro inserted";}
    	 else {echo mysqli_error($conn);} 
	}
	
?>
<h2 class="text-center"> Update Product</h2>
<a href="product.php" class="btn btn-default pull-right id="product" style="margin-top: -30px;">Cancel</a>
<hr>
<form action="update.php" method="POST" enctype="multipart/form-data">
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

						
						while ($row=mysqli_fetch_array($bquery)) {
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
					
						while ($row=mysqli_fetch_array($cquery)) {
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
					<input type="text" name="list_price" class="form-control" value="<?=$prolistprice?>">
				</div>
				</div>
			</div>
		</div>
		<br>
		
				
		<br>
			
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
