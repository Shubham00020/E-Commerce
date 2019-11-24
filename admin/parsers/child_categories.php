<?php
	require_once $_SERVER['DOCUMENT_ROOT'].'/web/core/init.php';
	$parentID = (int)$_POST['parentID'];
	$selected = sanitize($_POST['selected']);
	$childquery = $db->query("SELECT * FROM categories WHERE parent = '$parentID' ORDER BY name"); 
	ob_start();
?>
<option value=""></option>
<?php while($child = mysqli_fetch_assoc($childquery)):?>
	<option value="<?=$child['id'];?>"<?=(($selected == $child['id'])?' selected':'')?>><?=$child['name'];?></option>
<?php endwhile;?>
<?php echo ob_get_clean();?>