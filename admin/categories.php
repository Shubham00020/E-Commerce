<?php
ob_start();
require_once '../core/init.php';
if(!is_logged_in()){
	login_error_redirect();
}
include 'includes/header.php';
$sql = "SELECT * FROM navigation";
$result_p = $db->query($sql);
$errors = array();
$display = '';
$edit_value = '';
$idd = '';
$parent_value = '';

//Edit category
if (isset($_GET['edit']) && !empty($_GET['edit']))  {
		$edit_id = $_GET['edit'];
		$edit_id = sanitize($edit_id);
		$idd = $edit_id;
		$sql_edit = "SELECT * FROM categories WHERE id = '$edit_id'";
		$edit_result = $db->query($sql_edit);
		$results = mysqli_fetch_assoc($edit_result);
			$editp = $results['parent'];
			$sql2 = "SELECT * FROM navigation WHERE id = '$editp'";
			$editnav = $db->query($sql2);
			$edititem = mysqli_fetch_assoc($editnav);
			$parent_value = $edititem['id'];
}

//delete category
if (isset($_GET['delete']) && !empty($_GET['delete'])) {
	//echo $delete_id;
	$delete_id = (int)$_GET['delete'];
	$delete_id = sanitize($delete_id);
	$deletesql = "DELETE FROM categories WHERE id = '$delete_id'";
	$db->query($deletesql);
	header('Location: categories.php');
}

//delete parent category
if (isset($_GET['deletep']) && !empty($_GET['deletep'])) {
	$deletep_id = (int)$_GET['deletep'];
	$deletep_id = sanitize($deletep_id);
	$deletepsql = "DELETE FROM navigation WHERE id = '$deletep_id'";
	$dfrmcatsql = "DELETE FROM categories WHERE parent = '$deletep_id'";
	$db->query($dfrmcatsql);
	$db->query($deletepsql);
	header('Location: categories.php');	
}

//checking for form data
if (isset($_POST) && !empty($_POST)) {
		$parent = sanitize($_POST['parent']);
		$category = sanitize($_POST['category']);

		$sqlform = "SELECT * FROM categories WHERE name = '$category' AND parent = $parent";
		if(isset($_GET['edit'])){
			$sqlform = "SELECT * FROM categories WHERE name = '$category' AND parent = $parent AND id != '$idd'";
		} 
		$result = $db->query($sqlform);

		//check for parent category
		if($parent == 0){
			$sqlforparent = "SELECT * FROM navigation WHERE navitem = '$category'";
			$result = $db->query($sqlforparent);
		}

		$count = mysqli_num_rows($result);

		//if category is blank
		if ($category == '') {
			$errors[] .="The category cannot be blank";
		}

		//if categry exist in database
		if ($count > 0) {
			$errors[] .= $category." already exist.Please choose the another one...";
		}

		//display errors
		if (!empty($errors)) {
			$display =  display_errors($errors);
		}else{

			//upadate in database
			if ($parent == 0) {
				$sqlinsert = "INSERT INTO navigation (navitem) VALUES ('$category')";
			}else{
				$sqlinsert = "INSERT INTO categories (name,parent) VALUES ('$category','$parent')";
			}
			if (isset($_GET['edit'])) {
				$sqlinsert = "UPDATE categories SET name = '$category', parent = '$parent_value' WHERE id = '$idd'"; 
			}
			$db->query($sqlinsert);
			header('Location: categories.php');
		}
}
?>
<h2 class="text-center">Categories</h2>
<hr>
<div class="row">
	<div class="col-md-6">
		<form class="form" action="categories.php<?=((isset($_GET['edit']) && !empty($_GET['edit']))?'?edit='.$idd:'')?>" method="post">
			<legend><?=((isset($_GET['edit']) && !empty($_GET['edit']))?'Edit':'Add A')?> Category</legend>
			<?php if($display){
				echo $display;
			}?>
			<div class="form-group">
				<label for="inputParent">Parent :</label>
					<select class="form-control" name="parent" id="inputParent">
						<option value="0">Parent</option>
						<?php while($parent_i = mysqli_fetch_assoc($result_p)):?>
							<option value="<?=$parent_i['id'];?>"<?=(($parent_value == $parent_i['id'])?'selected="selected"':'')?>><?=$parent_i['navitem'];?></option>
						<?php endwhile;?>
					</select>
			</div>
			<?php if (isset($_GET['edit']) && !empty($_GET['edit'])) {
				$edit_value = $results['name'];
			}else{
				if (isset($_POST['category'])) {
					$edit_value = $category;
				}
			}
			?>
			<div class="form-group">
				<label for="category">Category :</label>
				<input type="text" class="form-control" name="category" value="<?=$edit_value?>" id="category">
			</div>
			<div class="form-group">
				<?php if(isset($_GET['edit']) && !empty($_GET['edit'])):?>
					<a href="categories.php" class="btn btn-warning">Cancel</a>
				<?php endif;?>			
				<input type="submit" value="<?=((isset($_GET['edit']) && !empty($_GET['edit']))?'Edit':'Add')?> Category" class="btn btn-success">
			</div>
		</form>
	</div>
	
<div class="col-lg-6">
	<div class="panel panel-info">
		<?php
			$result_p = $db->query($sql);
			while($parent_item = mysqli_fetch_assoc($result_p)):
				$navitem_id = $parent_item['id'];
		?>
		<div class="panel-heading">(<?=$parent_item['navitem'];?>)
			<p class="pull-left">Category -- Parent</p>
			<a href="categories.php?deletep=<?=$parent_item['id'];?>" class="btn btn-xs btn default pull-right" data-toggle="popover" title="Delete Parent"><span class="glyphicon glyphicon-remove"></span></a>
			<!--a href="categories.php?editp=" class="btn btn-xs btn default pull-right"><span class="glyphicon glyphicon-pencil"></span></a-->
		</div>
		<table class="table table-bordered table-striped">
			<?php
				$sql1 = "SELECT * FROM categories WHERE parent = $navitem_id";
				$result_c = $db->query($sql1);
				while($child_item = mysqli_fetch_assoc($result_c)):
			?>
			<tr>
				<td><?=$child_item['name'];?></td>
				<td class="col-sm-4"><?=$parent_item['navitem'];?></td>
				<td class="col-sm-4">
					<a href="categories.php?edit=<?=$child_item['id'];?>" class="btn btn-xs btn-info" data-toggle="popover" title="Edit Category"><span class="glyphicon glyphicon-pencil"></span></a>
					<a href="categories.php?delete=<?=$child_item['id'];?>" class="btn btn-xs btn-danger" data-toggle="popover" title="Delete Category"><span class="glyphicon glyphicon-remove"></span></a>
				</td>
			</tr>
			<?php endwhile;?>
		</table>
		<?php endwhile;?>
	</div>
</div>	
</div>
</div>
<?php
include 'includes/footer.php';
?>