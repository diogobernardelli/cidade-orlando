<?php
ini_set('display_errors','Off');
chdir('../');
require_once 'pacotes/controller/ImovelController.php';
$imovelcontrol = new ImovelController();

$imovel = $imovelcontrol->getImovel($_REQUEST['i']);

$zip = new ZipArchive;
$download = dirname(__FILE__).'/../tmp/arch'.date('YmdHisu').'.zip';

$zip->open($download, ZipArchive::CREATE);
foreach ($imovel->getImagens() as $imagem) {
	$zip->addFile(dirname(__FILE__).'/../uploads/'.$imagem, end(explode("/", $imagem)));
}
$zip->close();

header('Content-Type: application/zip');
header('Content-disposition: attachment; filename=imagens'.$_REQUEST['i'].'.zip');
header('Content-Length: ' . filesize($download));
readfile($download);
unlink($download);

unset($imovelcontrol, $imovel, $zip, $download);
?>