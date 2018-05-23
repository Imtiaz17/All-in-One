<?php
session_start();
if (!isset($_SESSION['id'])){
	header("Location: admin.php");
}
require_once'../core/init.php';
include 'includes/head.php';
include 'includes/navbar.php';
$conn=new Database();
$bsql="SELECT * FROM brand ORDER BY brand";
$csql="SELECT * FROM categories ORDER BY category";
$bquery=$conn->getall($bsql);
$cquery=$conn->getall($csql);


 if ( isset($_POST['submit'])) {
	$name=mysqli_real_escape_string($conn->db,$_POST['title']);
	$price=mysqli_real_escape_string($conn->db,$_POST['price']);
	$list_price=mysqli_real_escape_string($conn->db,$_POST['list_price']);
	$brand=mysqli_real_escape_string($conn->db,$_POST['brand']);
	
	
	$cat=mysqli_real_escape_string($conn->db,$_POST['cat']);
	$description=mysqli_real_escape_string($conn->db,$_POST['description']);
	
	$pro_image=$_FILES['image']['name'];
	$pro_temp=$_FILES['image']['tmp_name'];
	move_uploaded_file($pro_temp, "../images/$pro_image");
	if ($name==''|| $price==''|| $list_price==''|| $brand==''|| $cat==''|| $description=='') {
		$error=" Field  must not be empty";
	}
	else
	{
   	$dbinsert="INSERT INTO product (title,price,list_price,brand,cat,image,description) VALUES ('$name','$price','$list_price','$brand','$cat','$pro_image','$description') ";
   	$create=$conn->insert($dbinsert);
    header('Location:product.php');
		}


    	}?>
    	
<?php if (isset($error)) {
	echo "<h4 style='color:red'>".$error."</h4>";
} ?>
<h2 class="text-center">Add a new product</h2>
<a href="addproduct.php" class="btn btn-default pull-right id="product" style="margin-top: -30px;" >Cancel</a>
<hr>

<form action="addproduct.php" method="post" enctype="multipart/form-data">
	<div class="form-group">
		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-6">
				<div class="row">
					<div class="col-md-2">
				<h4><b>Title</b></h4>
				</div>
				<div class="col-md-6">
				<input type="text" name="title" class="form-control">
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
						<option value=""<?=((isset($_POST['brand'])&& $_POST['brand']=='')?'selected':'');?> ></option>
						<?php while ($brandresult=mysqli_fetch_assoc($bquery)) :?>
							 <option value="<?=$brandresult['brand'];?>"<?=((isset($_POST['brand'])&& $_POST['brand'] == $brandresult['id'])?'selected':'');?>><?=$brandresult['brand'];?></option>	
							<?php endwhile ;	?>

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
						<option value=""<?=((isset($_POST['cat'])&& $_POST['cat']=='')?'selected':'');?> ></option>
						<?php while ($catresult=mysqli_fetch_assoc($cquery)) :?>
							 <option value="<?=$catresult['category'];?>"<?=((isset($_POST['category'])&& $_POST['category'] == $catresult['id'])?'selected':'');?>><?=$catresult['category'];?></option>	
							<?php endwhile ;	?>

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
					<input type="text" name="price" class="form-control" >
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
					<input type="text" name="list_price" class="form-control" >
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
					<input type="file" name="image" id="image" class="form-control">
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
					<textarea rows="5" name="description" class="form-control"></textarea>
				</div>
				</div>
			</div>
		</div>

		<br>
		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-6">
				<input type="submit" name="submit" value="Add product" class="form-control  btn btn-success pull-right">
			</div>
		</div>

		
	</div>
</form>
