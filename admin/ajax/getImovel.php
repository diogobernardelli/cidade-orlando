<?php
ini_set('display_errors','Off');
chdir('../../');
require_once 'pacotes/controller/ImovelController.php';
$imovelcontrol = new ImovelController();

$imovel = $imovelcontrol->getImovel($_GET['id']);

$ret['destaque'] = ($imovel->getDestaque())?'t':'f';
$ret['valor'] = $imovel->getValor();
$ret['finalidade'] = $imovel->getFinalidade();
$ret['tipo'] = $imovel->getTipo();
$ret['banheiros'] = $imovel->getBanheiros();
$ret['quartos'] = $imovel->getQuartos();
$ret['area'] = $imovel->getArea();
$ret['status'] = ($imovel->getStatus())?'t':'f';
$ret['id_cidade'] = $imovel->getId_cidade();
$ret['localizacao'] = $imovel->getLocalizacao();
$ret['latitude'] = $imovel->getLatitude();
$ret['longitude'] = $imovel->getLongitude();
$ret['informacoes_adicionais'] = $imovel->getInformacoes_adicionais();

$dets = $imovel->getDetalhes($_GET['id']);
$ret['detalhes'] = array();
foreach ($dets as $det) {
	$ret['detalhes'][] = $det;
}

$imgs = $imovel->getImagens($_GET['id']);
$ret['imagens'] = array();
foreach ($imgs as $img) {
	$ret['imagens'][] = $img;
}

echo json_encode($ret);

unset($imovelcontrol, $_GET, $imgs, $img, $dets, $det);
?>