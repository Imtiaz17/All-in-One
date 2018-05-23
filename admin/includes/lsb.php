
 
 <div class="container-fluid" >
 
  <div class="col-md-3"> 
     <div id="leftbar">
      <br>
<h3 >Categories</h3>
<br>
<ul>
 <?php 
 $sql="select * from categories";
 $pquery=$conn->query($sql);
  while ($rowcount=mysqli_fetch_assoc($pquery)) 
  {
    $cat_id=$rowcount['id'];
    $cat_name=$rowcount['category'];
    echo "<li><a href='index.php?cat=$cat_id'>$cat_name</a></li>";
  }
 ?>
     
</ul>
<br>
<h3 >Brand</h3>
<br>
<ul>
 <?php 
 $sql="select * from brand";
 $pquery=$conn->query($sql);
  while ($rowcount=mysqli_fetch_assoc($pquery)) 
  {
    $brand_id=$rowcount['id'];
    $brans_name=$rowcount['brand'];
    echo "<li><a href='index.php?cat=$brand_id'>$brans_name</a></li>";
  }
 ?>
 </ul>
   </div>
   </div>
