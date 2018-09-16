<?php
ini_set('display_errors','Off');
chdir('../../');
require_once 'pacotes/controller/DetalheController.php';
$detalhecontrol = new DetalheController();

$res = $detalhecontrol->getDetalhe($_GET['id']);
$det['nome'] = $res->getNome();

echo json_encode($det);
unset($detalhecontrol, $det);
?>