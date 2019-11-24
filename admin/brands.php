<?php
ob_start();
require_once '../core/init.php';
if(!is_logged_in()){
	login_error_redirect();
}
include 'includes/header.php';
//get brands from database
$sql = "SELECT * FROM brand";
$all_brands = $db->query($sql);
$errors = array();

//Edit Brand
if (isset($_GET['edit']) && !empty($_GET['edit']) && is_numeric($_GET['edit'])) {
	$edit_id = (int)$_GET['edit'];
	$edit_id = sanitize($edit_id);
	$sql5 = "SELECT * FROM brand WHERE id = '$edit_id'";
	$edit_result = $db->query($sql5);
	$ebrand = mysqli_fetch_assoc($edit_result);
}

//delete brand
if (isset($_GET['delete']) && !empty($_GET['delete']) && is_numeric($_GET['delete'])) {
	$delete_id = (int)$_GET['delete'];
	$delete_id = sanitize($delete_id);
	$sql4 = "DELETE FROM brand WHERE id = '$delete_id'";
	$db->query($sql4);
	header('Location: brands.php'); 
}

//if add form is submitted
if (isset($_POST['add_submit'])) {
	$brand = sanitize($_POST['brand']);
	//check if brand is submitted
	if ($_POST['brand'] == '') {
		$errors[] .= 'You must enter a brand!';
	}
	//check if brand exist in database
	$sql2 = "SELECT * FROM brand WHERE brand ='$brand'";
	if (isset($_GET['edit'])) {
		$sql2 = "SELECT * FROM brand WHERE brand = '$brand' AND id != '$edit_id'";
	}
	$result = $db->query($sql2);
	$count = mysqli_num_rows($result);
	if ($count > 0) {
		$errors[] .= $brand.' brand already exist. Please Choose another name...';
	}
	//display errors
	if (!empty($errors)) {
		echo display_errors($errors);
	}else{
		//add brand to the database
		$sql3 = "INSERT INTO brand (brand) VALUES ('$brand')";
		if (isset($_GET['edit'])) {
			$sql3 = "UPDATE brand SET brand = '$brand' WHERE id = '$edit_id'"; 
		}
		$db->query($sql3);
		header('Location: brands.php');
		}
}
?>
<!--h2 class="text-center">Brands</h2>
<hr-->
<div class="text-center">  
	<form class="form-inline" action="brands.php<?=((isset($_GET['edit']))?'?edit='.$edit_id:'')?>" method="post">
		<div class="form-group">
			<?php
			$brand_value = '';
			if (isset($_GET['edit'])) {
				$brand_value = $ebrand['brand'];
			}else{
				if (isset($_POST['brand'])) {
					$brand_value = sanitize($_POST['brand']);
				}
			}
			?>
			<label for="brand"><?=((isset($_GET['edit']))?'Edit':'Add A')?> Brand :</label>
			<input type="text" name="brand" class="form-control" id="brand" value="<?=$brand_value;?>">
			<?php if(isset($_GET['edit'])):?>
				<a href="brands.php" class="btn btn-default">Cancel</a>
			<?php endif;?>
			<input type="submit" name="add_submit" value="<?=((isset($_GET['edit']))?'Edit':'Add')?> Brand" class="btn btn-sm btn-success">
		</div>
	</form>
</div>
</br>
<div style="width:50%;margin:0px auto" class="panel panel-success">
	<div class= "panel-heading text-center"><h2>Brands</h2></div>
	<!--Table Contents-->
	<table class="table table-bordered table-striped text-center">
		<?php while($brands = mysqli_fetch_assoc($all_brands)):?>
		<tr>
		<td><a href="brands.php?edit=<?=$brands['id']?>" class="btn btn-sm btn-default" data-toggle="popover" title="Edit Brand"><span class="glyphicon glyphicon-pencil"></span></a></td>
		<td><?=$brands['brand']?></td>
		<td><a href="brands.php?delete=<?=$brands['id']?>" class="btn btn-sm btn-default" data-toggle="popover" title="Delete Brand"><span class="glyphicon glyphicon-trash"></span></a></td>
		</tr>
	<?php endwhile;?>
	</table>
</div>
</br>
</div>
<?php
include 'includes/footer.php';
?>