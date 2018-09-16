<?
ini_set('display_errors','Off');
@session_start();
chdir('../../');
require_once 'pacotes/controller/ImovelController.php';
$imovelcontrol = new ImovelController();

$detalhes = $_POST['detalhes'];
$imagens = $_POST['imagens'];
unset($_POST['detalhes'], $_POST['imagens']);

if ($imovelcontrol->setImovel($_POST, $imagens, $detalhes)) {
	$response = json_encode(array("msg" => "Imóvel cadastrado com sucesso!"));
} else {
	$response = json_encode(array("erro" => "Ocorreu algum erro."));
}

unset($_POST, $imovelcontrol, $imgs);
exit($response);
?>