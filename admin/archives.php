<?php
ob_start();
require_once '../core/init.php';
if(!is_logged_in()){
	login_error_redirect();
}
include 'includes/header.php';
$productsql = "SELECT * FROM products WHERE deleted = 1";
$results = $db->query($productsql);

//restore the product
if (isset($_GET['restore']) && !empty($_GET['restore']) && is_numeric($_GET['restore'])) {
	$restore_id = $_GET['restore'];
	$db->query("UPDATE products SET deleted = 0 WHERE id = '$restore_id'");
	header('Location: archives.php');
}
?>
<h2 class="text-center">Archived Products</h2>
<hr>
<table class="table-striped table-bordered table-condensed">
	<thead>
		<th></th>
		<th>Title</th>
		<th>Price</th>
		<th>Category (Brand)</th>
		<th>Sold</th>
	</thead>
	<?php 
		while($product = mysqli_fetch_assoc($results)):
			$Category = $product['categories'];
			$brand = $product['brand'];
			$childsql = "SELECT * FROM categories WHERE id = $Category";
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
			<a href="archives.php?restore=<?=$product['id']?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-refresh"></span></a>
		</td>
		<td class="col-sm-4" id="colorof"><?=$product['title'];?></td>
		<td class="col-sm-1"  id="colorof"><?=money($product['price']);?></td>
		<td class="col-sm-3"  id="colorof"><?=$Categoryname;?></td>
		<td id="colorof">0</td>
	</tr>
	<?php endwhile;?>
</table>
</div>
<?php 
require 'includes/footer.php';
?>