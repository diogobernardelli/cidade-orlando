<?php
if ($_GET['id']) {
	require_once 'pacotes/controller/ImovelController.php';
	require_once 'pacotes/controller/DetalheController.php';
	$imovelcontrol = new ImovelController();
	$detalhecontrol = new DetalheController();
	
	$imovel = $imovelcontrol->getImovel($_GET['id']);
	$cidade_imovel = $imovelcontrol->getCidade($imovel->getId_cidade());
	$imagens = $imovel->getImagens();
	$detalhes = $imovel->getDetalhes();
	$arr = array();
	foreach ($detalhes as $detalhe) {
		$detalhe = $detalhecontrol->getDetalhe($detalhe);
		$arr[] = $detalhe->getNome();
	}
	$detalhes = $arr;
	
	if (!$imovel->getStatus())
		die("<script>location.href='imoveis.php?msg=erro';</script>");
	
	unset($detalhecontrol, $arr);
} else {
	die("<script>location.href='imoveis.php?msg=erro';</script>");
}
?>