<?php
	require_once $_SERVER['DOCUMENT_ROOT'].'/web/core/init.php';
	unset($_SERVER['SBuser']);
	session_destroy();
	header('Location: login.php');
?>