<?php 
ob_start();
require_once '../core/init.php';
if(!is_logged_in()){
	login_error_redirect();
}
include 'includes/header.php';

//error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
//ini_set('display_errors', 1);
	$dbpath = '';
//deleting the product
if (isset($_GET['delete']) && !empty($_GET['delete']) && is_numeric($_GET['delete'])) {
	$delete_id = $_GET['delete'];
	$db->query("UPDATE products SET deleted = 1 WHERE id = '$delete_id'");
	header('Location: products.php');
}


if ((isset($_GET['add']) && !empty($_GET['add']) || (isset($_GET['edit']) && !empty($_GET['edit'])))) {
	//grabing brands from database
	$brandQuery = $db->query("SELECT * FROM brand ORDER BY brand");
	$parentCategory = $db->query("SELECT * FROM navigation ORDER BY navitem");
		$title = ((isset($_POST['title']) && $_POST['title'] != '')?sanitize($_POST['title']):'');
		$brand = ((isset($_POST['brand']) && $_POST['brand'] != '')?sanitize($_POST['brand']):'');
		$brandd = $db->query("SELECT id FROM brand WHERE brand = '$brand'");
		$brand_id = mysqli_fetch_assoc($brandd);
		$brandis = $brand_id['id'];
		$parent = ((isset($_POST['parent']) && $_POST['parent'] != '')?sanitize($_POST['parent']):'');
		$category = ((isset($_POST['child']) && $_POST['child'] != '')?sanitize($_POST['child']):'');
		$price = ((isset($_POST['price']) && $_POST['price'] != '')?sanitize($_POST['price']):'');
		$description = ((isset($_POST['description']) && $_POST['description'] != '')?sanitize($_POST['description']):'');
		$sizes = rtrim(((isset($_POST['sizes']) && $_POST['sizes'] != '')?sanitize($_POST['sizes']):''),',');
			$ha = $category;
			$saved_image = '';
		if(isset($_GET['edit'])){
			$edit_id = (int)$_GET['edit'];
			$editproducts = $db->query("SELECT * FROM products WHERE id = '$edit_id'");
			$editResults = mysqli_fetch_assoc($editproducts);
			if(isset($_GET['image_delete'])){
				$image_url = $_SERVER['DOCUMENT_ROOT'].$editResults['image'];
				unlink($image_url);
				$db->query("UPDATE products SET image = '' WHERE id = '$edit_id'");
				header('Location: products.php?edit='.$edit_id);
			}
			$title = ((isset($_POST['title']) && $_POST['title'] != '')?sanitize($_POST['title']):$editResults['title']);
			$brand = ((isset($_POST['brand']) && $_POST['brand'] != '')?sanitize($_POST['brand']):$editResults['brand']);
			$category = ((isset($_POST['child']) && $_POST['child'] != '')?sanitize($_POST['child']):$editResults['categories']);
			$price = ((isset($_POST['price']) && $_POST['price'] != '')?sanitize($_POST['price']):$editResults['price']);
			$description = ((isset($_POST['description']) && $_POST['description'] != '')?sanitize($_POST['description']):$editResults['description']);
			$sizes = ((isset($_POST['sizes']) && $_POST['sizes'] != '')?sanitize($_POST['sizes']):$editResults['sizes']);
			$ha = $category;
			$sizes = rtrim($sizes,',');
			$parentQ = $db->query("SELECT * FROM categories WHERE id = '$category'");
			$parentResults = mysqli_fetch_assoc($parentQ);
			$parent = ((isset($_POST['parent']) && $_POST['parent'] != '')?sanitize($_POST['parent']):$parentResults['parent']);
			$saved_image = (($editResults['image'] != '')?$editResults['image']:'');
			$dbpath = $saved_image;
		}
		$brandd = $db->query("SELECT id FROM brand WHERE brand = '$brand'");
		$brand_id = mysqli_fetch_assoc($brandd);
		$brandis = $brand_id['id'];
	
	 //form processing
	if ($_POST) {
		$errors = array();
	if (!empty($_POST['sizes'])) {
		$sizeString = sanitize($_POST['sizes']);
		$sizeString = rtrim($sizeString,',');
		$sizesArray = explode(',', $sizeString);
		$sArray = array();
		$qArray = array();
		foreach ($sizesArray as $ss) {
			$s = explode(':', $ss);
			$sArray[] = $s[0];
			$qArray[] = $s[1];
			# code...
		}
		# code...
	}else{$sizesArray = array();}
	$required = array('title', 'brand', 'child', 'price', 'sizes');
	foreach($required as $field){
		if($_POST[$field] == ''){
			$errors[] = 'All Fields with Astrisk are required';
			break;
		}
	}
	if(!empty($_FILES)){
		$photo = $_FILES['image'];
		$name = $photo['name'];
		$phtype = $photo['type'];
		if(!empty($photo) && !empty($phtype)){
//			var_dump($_FILES);
			$nameArray = explode('.', $name);
			$filename = $nameArray[0];
			$fileExt = $nameArray[1];
			$mime = explode('/', $photo['type']);
			$mimeType = $mime[0];
			$mineExt = $mime[1];
			$tempLoc = $photo['tmp_name'];
			$fileSize = $photo['size'];
			$allowed = array('png','jpg','jpeg','gif');
			$uploadName = md5(microtime()).'.'.$fileExt;
			$uploadPath = ADDRESS.'images/products/'.$uploadName;
			$dbpath = '/web/images/products/'.$uploadName;
			if (empty($errors) && $mimeType != 'image') {
				$errors[] = "The file must be an image.";
			}
			if(empty($errors) && !in_array($fileExt, $allowed)){
				$errors[] = "The file Extension must be a png, jpg, jpeg or gif.";
			}
			if(empty($errors) && $fileSize > 25000000){
				$errors[] = "The files size must be under 25MB.";
			}
		}
	}

	//display errors
	if(!empty($errors)){
		echo display_errors($errors);
	}else{
		//upload file and insert into database
		move_uploaded_file($tempLoc, $uploadPath);
		$insertSql = "INSERT INTO products (`title`, `price`,`brand`,`categories`,`image`,`description`,`sizes`) 
		VALUES ('$title','$price','$brandis','$category','$dbpath','$description','$sizes')";
		if(isset($_GET['edit'])){
			$insertSql = "UPDATE products SET title = '$title', price = '$price', brand = '$brandis', categories = '$category',
			image = '$dbpath', description = '$description', sizes = '$sizes' WHERE id = '$edit_id'";
		}
		$db->query($insertSql);
		header('Location: products.php');
	}

}
	?>
	<h2 class="text-center"><?=((isset($_GET['edit']) && !empty($_GET['edit']))?'Edit':'Add A New')?> Product</h2><hr>
	<form action="products.php?<?=((isset($_GET['edit']) && !empty($_GET['edit']))?'edit='.$edit_id:'add=1')?>" method="POST" enctype="multipart/form-data">
		<div class="form-group col-md-3">
			<lable for="title">Title* :</lable>
			<input type="text" class="form-control" name="title" id="title" value="<?=$title;?>">
		</div>
		<div class="form-group col-md-3">
			<lable for="brand">Brand* :</lable>
			<select class="form-control" id="brand" name="brand">
				<option value="<?=(($brand == '')?' selected':'')?>"></option>
				<?php while($b = mysqli_fetch_assoc($brandQuery)):?>
					<option vlaue="<?=$b['brand'];?>"<?=(($brand == $b['id'])?' selected':'')?>><?=$b['brand'];?></option>
				<?php endwhile;?>
			</select>
		</div>
		<div class="form-group col-md-3">
			<lable for="parent">Parent Category* :</lable>
			<select class="form-control" id="parent" name="parent">
				<option vlaue="<?=(($parent == '')?' selected':'')?>"></option>
				<?php while($p = mysqli_fetch_assoc($parentCategory)):?>
					<option value="<?=$p['id'];?>"<?=(($parent == $p['id'])?' selected':'')?>><?=$p['navitem'];?></option>
				<?php endwhile;?>
			</select>
		</div>
		<div class="form-group col-md-3">
			<lable for="child">Child Category* :</lable>
			<select class="form-control" id="child" name="child">
			</select>
		</div>
		<div class="form-group col-md-3">
			<label for="price">Price* :</label>
			<input type="text" class="form-control" name="price" id="price" value="<?=$price?>">
		</div>
		<div class="form-group col-md-3">
			<label>Quantity & Sizes* :</label>
			<!-- Button trigger modal -->
			<button class="btn btn-default form-control" onclick="jQuery('#sizesModal').modal('toggle');return false;"><?=((isset($_GET['edit']))?'Need to write again Quantity & Sizes':'Quantity & Sizes')?></button>
		</div>
		<div class="form-group col-md-6">
			<label for="sizes">Sizes & Quantity Preview* :</label>
			<input type="text" name="sizes" id="sizes" class="form-control" value="<?=$sizes;?>" readonly>
		</div>
		<div class="form-group col-md-6">
			<lable for="image">Product Photo :</lable>
				<?php if($saved_image != ''){?>
					<div class="saved_image"><img style="border:2px solid silver" height="25%" width="25%" src="<?=$saved_image;?>" alt="saved_image"/></div>
					<a class="text-danger" href="products.php?image_delete=1&edit=<?=$edit_id;?>">Delete Image</a>
				<?php }else{?>
			<input type="file" name="image" id="image" class="form-control">
			<?php }?>
		</div>
		<div class="form-group col-md-6">
			<lable for="description">Description :</lable>
			<textarea class="form-control" row="10" name="description" id="description"><?=$description?></textarea>
		</div>
		<div style="margin-right:12px" class="form-group pull-right">
			<a href="products.php" class="btn btn-default">Cancel</a>
			<input type="submit" value="<?=((isset($_GET['edit']) && !empty($_GET['edit']))?'Edit':'Add')?> Product" class="btn btn-success">
		</div>	
	</form>
<!-- Modal -->
<div class="modal fade " id="sizesModal" tabindex="-1" role="dialog" aria-labelledby="sizesModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="sizesModalLabel">Size & Quantity</h4>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
	        <?php for($i = 1;$i <= 12;$i++):?>
	        	<div class="form-group col-md-4">
	        		<lable for="size<?=$i;?>">Sizes :</lable>
	        		<input type="text" name="size<?=$i;?>" id="size<?=$i;?>" value="<?=((!empty($sA[$i-1]))?$sArray[$i-1]:'')?>" class="form-control">
	        	</div>
	        	<div class="form-group col-md-2">
	        		<lable for="qty<?=$i;?>">Quantity :</lable>
	        		<input type="number" name="qty<?=$i;?>" id="qty<?=$i;?>" value="<?=((!empty($qA[$i-1]))?$qArray[$i-1]:'')?>" min="0" class="form-control">
	        	</div>
	        <?php endfor;?>
        </div>	
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="updateSizes();jQuery('#sizesModal').modal('toggle');return false;">Save changes</button>
      </div>
    </div>
  </div>
</div>



<?php
echo '</div>';}else{
$productsql = "SELECT * FROM products WHERE deleted = 0";
$results = $db->query($productsql);
if (isset($_GET['featured'])) {
	$id = $_GET['id'];
	$featured = $_GET['featured'];
	$featuredsql = "UPDATE products SET featured = '$featured' WHERE id = '$id'";
	$db->query($featuredsql);
	header('Location: products.php');
}
?>
<style type="text/css">
	#colorof{
		color: brown;
	}
</style>
<h2 class="text-center">Products</h2><div class="clearfix"></div>
<a href="products.php?add=1" style="margin-top:-35px" class="btn btn-success pull-right">Add Product</a>
<hr>
<table class="table-striped table-bordered table-condensed">
	<thead>
		<th></th>
		<th>Title</th>
		<th>Price</th>
		<th>Category (Brand)</th>
		<th>Featured</th>
		<th>Sold</th>
	</thead>
	<?php 
		while($product = mysqli_fetch_assoc($results)):
			$Categoryy = $product['categories'];
			$brand = $product['brand'];
			$childsql = "SELECT * FROM categories WHERE id = $Categoryy";
			$childresult = $db->query($childsql);
			$child = mysqli_fetch_assoc($childresult);
			$parentid = $child['parent'];
			$childname = $child['name'];
			$parentsql = "SELECT * FROM navigation WHERE id = $parentid";
			$parentresult = $db->query($parentsql);
			$parent = mysqli_fetch_assoc($parentresult);
			$parentname = $parent['navitem'];
			$brandsql = "SELECT * FROM brand WHERE id = '$brand'";
			$brandresult = $db->query($brandsql);
			$brandid = mysqli_fetch_assoc($brandresult);
			$brandname = $brandid['brand'];
			$Categoryname = $parentname.'--'.$childname.'('.$brandname.')';
	?>
	<tr>
		<td>
			<a href="products.php?edit=<?=$product['id'];?>" class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-pencil"></span></a>
			<a href="products.php?delete=<?=$product['id'];?>" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
		</td>
		<td class="col-sm-4" id="colorof"><?=$product['title'];?></td>
		<td class="col-sm-1"  id="colorof"><?=money($product['price']);?></td>
		<td class="col-sm-3"  id="colorof"><?=$Categoryname;?></td>
		<td class="col-sm-2"  id="colorof">
			<a href="products.php?featured=<?=(($product['featured'] == 1)?'0':'1');?>&id=<?=$product['id'];?>" class="btn btn-xs btn-default" data-toggle="popover" title="Add to Featured">
				<span class="glyphicon glyphicon-<?=(($product['featured'] == 1)?'plus':'minus')?>"></span></a>
				&nbsp<?=(($product['featured'] == 1)?'':'Featured Product')?>
		</td>
		<td id="colorof">0</td>
	</tr>
	<?php endwhile;?>
</table>
</div>
<?php
} 
require 'includes/footer.php';?>
<?php if(isset($_GET['edit']) && $_GET['edit'] != ''):?><script>
jQuery('document').ready(function(){
	get_child_options('<?=$category;?>');
	//updateSizes();
});
</script>
<?php endif;?>