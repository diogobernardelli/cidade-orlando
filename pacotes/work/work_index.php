<?php
@session_start();
require_once 'pacotes/controller/GeralController.php';
require_once 'pacotes/controller/ImovelController.php';
$geralcontrol = new GeralController();
$imovelcontrol = new ImovelController();

$imoveis_destaque = $imovelcontrol->pesquisaImovel(array('status'=>'true', 'destaque'=>'true'), 'RANDOM()', 3);
$imoveis_outros = $imovelcontrol->pesquisaImovel(array('status'=>'true', 'destaque'=>'false'), 'RANDOM()', 20);
$imoveis_recentes = $imovelcontrol->pesquisaImovel(array('status'=>'true'), 'id DESC', 4);
$cidades = $imovelcontrol->getCidades();

//BARRA DIREITA
$outros_imoveis = $imovelcontrol->pesquisaImovel(array('status'=>'true', 'id_not_in'=>$_GET['id']), 'RANDOM()', 4);

$geral = $geralcontrol->getGeral();

unset($geralcontrol);
?>