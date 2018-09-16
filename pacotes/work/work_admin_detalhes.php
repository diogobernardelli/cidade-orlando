<?php
require_once 'pacotes/controller/DetalheController.php';
$detalhecontrol = new DetalheController();

$detalhes = $detalhecontrol->listDetalhes();

unset($detalhecontrol);
?>