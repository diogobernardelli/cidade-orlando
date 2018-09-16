<?
ini_set('display_errors','Off');
@session_start();
chdir('../../');
require_once 'pacotes/controller/DetalheController.php';
$detalhecontrol = new DetalheController();

if ($_POST['nome'] != '') {

	$detalhecontrol->updateDetalhe($_POST['id'], array('nome' => $_POST['nome']));
	$response = json_encode(array("ok" => "ok"));
			
} else {
	$response = json_encode(array("erro" => "Nome é obrigatório!"));
}

unset($_POST, $detalhecontrol);
exit($response);
?>