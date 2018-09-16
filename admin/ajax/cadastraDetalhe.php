<?
ini_set('display_errors','Off');
@session_start();
chdir('../../');
require_once 'pacotes/controller/DetalheController.php';
$detalhecontrol = new DetalheController();

if ($detalhecontrol->setDetalhe($_POST)) {
	$response = json_encode(array('ok'=>'ok'));
} else {
	$response = json_encode(array('erro'=>'Ocorreu algum erro.'));
}

unset($_POST, $detalhecontrol);
exit($response);
?>