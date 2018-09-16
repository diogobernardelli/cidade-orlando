<?php
ini_set('display_errors','Off');
chdir('../');
require_once 'pacotes/controller/ImovelController.php';
$imovelcontrol = new ImovelController();
	
$post['status'] = 'true';
$post['mapa'] = 'true';

$busca = $imovelcontrol->pesquisaImovel($post, 'RANDOM()', 10);

$array = array();
foreach ($busca as $imovel) {
	$im['id'] = $imovel->getId();
	$im['latitude'] = $imovel->getLatitude();
	$im['longitude'] = $imovel->getLongitude();
	$im['localizacao'] = $imovel->getLocalizacao();
	$im['area'] = number_format($imovel->getArea(), 2, ".", " ");
	$im['valor'] = number_format($imovel->getValor(), 2, ".", " ");
	$imgs = $imovel->getImagens();
	$im['imagem'] = $imgs[0];
	
	$array[] = $im;
}
echo json_encode($array);
unset($imovelcontrol, $pag, $offset, $post);
?>