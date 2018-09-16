<?
	@session_start();
	if (!isset($_SESSION['co']['admin'])) {
		header('Location: login.php');
	}
?>
<?php include "cabecalho.php"; ?>
<?php include "menu-lateral.php"; ?>
<div id="conteudo">
	<?php include "includes/divs/sync.php"; ?>
</div>
<?php //include "footer.php"; ?>