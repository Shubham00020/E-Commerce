<?php
require_once '../core/init.php';
if(!is_logged_in()){
	login_error_redirect();
}
if(!has_permission('admin')){
	permission_error_redirect('index.php');
}
include 'includes/header.php';

?>

</div>
<?php
include 'includes/footer.php';
?>
