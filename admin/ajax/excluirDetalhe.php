<?
ini_set('display_errors','Off');
@session_start();
chdir('../../');
require_once 'pacotes/controller/DetalheController.php';
$detalhecontrol = new DetalheController();

if ($_POST['id'] != '') {

	$detalhecontrol->deleteDetalhe($_POST['id']);
	$response = json_encode(array("ok" => "ok"));
			
} else {
	$response = json_encode(array("erro" => "Erro ao excluir detalhe"));
}

unset($_POST, $detalhecontrol);
exit($response);
?>