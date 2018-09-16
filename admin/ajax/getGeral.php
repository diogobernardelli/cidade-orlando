<?php
ini_set('display_errors','Off');
chdir('../../');
require_once 'pacotes/controller/GeralController.php';
$geralcontrol = new GeralController();

$res = $geralcontrol->getGeral();

$geral['email1'] = $res->getEmail1();
$geral['email2'] = $res->getEmail2();
$geral['telefone1'] = $res->getTelefone1();
$geral['telefone2'] = $res->getTelefone2();
$geral['skype'] = $res->getSkype();
$geral['endereco'] = $res->getEndereco();

echo json_encode($geral);

unset($geralcontrol, $res);
?>