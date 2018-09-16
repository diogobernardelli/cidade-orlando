<?php
@session_start();
require_once 'pacotes/controller/DetalheController.php';
require_once 'pacotes/controller/ImovelController.php';
$detalhecontrol = new DetalheController();
$imovelcontrol = new ImovelController();

$detalhes = $detalhecontrol->listDetalhes();
$cidades = $imovelcontrol->getCidades();

unset($detalhecontrol);
?>