<?php
	/*@session_start();
	if (!isset($_SESSION['ga']['admin'])) {
		header('Location: login.php');
	}*/

	header("Content-Type: text/html;charset=UTF-8");
	
	ini_set('display_errors','Off');
	
	if ($_GET['param'] != '') {
		@session_start();
		$_SESSION['painel']['param'] = $_GET['param'];
	}
    include '../includes/divs/'.$_GET['div'].'.php';
	unset($_GET);
?>