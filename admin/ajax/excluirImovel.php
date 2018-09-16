<?
ini_set('display_errors','Off');
@session_start();
chdir('../../');
require_once 'pacotes/controller/ImovelController.php';
$imovelcontrol = new ImovelController();

if ($_POST['id'] != '') {

	$imovelcontrol->deleteImovel($_POST['id']);
	$response = json_encode(array("msg" => "Imóvel excluído com sucesso!"));
			
} else {
	$response = json_encode(array("erro" => "Erro ao excluir imóvel"));
}

unset($_POST, $imovelcontrol);
exit($response);
?>