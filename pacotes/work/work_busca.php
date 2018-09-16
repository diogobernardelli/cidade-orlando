<?php
@session_start();
require_once 'pacotes/controller/ImovelController.php';
$imovelcontrol = new ImovelController();

$post['status'] = 'true';
$post['id_cidade'] = ($_REQUEST['local']!='')?$_REQUEST['local']:'';
$post['tipo'] = ($_REQUEST['tipo']!='')?$_REQUEST['tipo']:'';
$post['zipcode'] = ($_REQUEST['zipcode']!='')?$_REQUEST['zipcode']:'';
$post['quartos'] = ($_REQUEST['quartos']!='')?$_REQUEST['quartos']:'';
$post['banheiros'] = ($_REQUEST['banheiros']!='')?$_REQUEST['banheiros']:'';
$post['valor_de'] = ($_REQUEST['valor_de']!='')?$_REQUEST['valor_de']:'';
$post['valor_ate'] = ($_REQUEST['valor_ate']!='')?$_REQUEST['valor_ate']:'';
$post['aluguel'] = ($_REQUEST['aluguel']!='')?'Aluguel':'';
$post['venda'] = ($_REQUEST['venda']!='')?'Compra':'';

//Incluído a pedido Jamil - 06/06/2016
if ($post['valor_de'] == '' || $post['valor_de'] < 70000){
	$post['valor_de'] = '70000';
}

$campo = ($_REQUEST['campo']!='')?$_REQUEST['campo']:'valor';
$ordem = ($_REQUEST['ordem']!='')?$_REQUEST['ordem']:'DESC';

$pag = ($_REQUEST['p']!='')?$_REQUEST['p']:'';

$offset = '';
if ($pag) {
	if ($pag > 1) {
		$offset = 12 * ($pag - 1);
	}
}

$arrBusca = array();
if (array_key_exists("local", $_REQUEST)) {
	$arrBusca['local'] = $_REQUEST['local'];
}
if (array_key_exists("tipo", $_REQUEST)) {
	$arrBusca['tipo'] = $_REQUEST['tipo'];
}
if (array_key_exists("zipcode", $_REQUEST)) {
	$arrBusca['zipcode'] = $_REQUEST['zipcode'];
}
if (array_key_exists("quartos", $_REQUEST)) {
	$arrBusca['quartos'] = $_REQUEST['quartos'];
}
if (array_key_exists("banheiros", $_REQUEST)) {
	$arrBusca['banheiros'] = $_REQUEST['banheiros'];
}
if (array_key_exists("valor_de", $_REQUEST)) {
	$arrBusca['valor_de'] = preg_replace( '/[^0-9]/', '', $_REQUEST['valor_de'] );
}
if (array_key_exists("valor_ate", $_REQUEST)) {
	$arrBusca['valor_ate'] = preg_replace( '/[^0-9]/', '', $_REQUEST['valor_ate'] );
}
if (array_key_exists("aluguel", $_REQUEST)) {
	$arrBusca['aluguel'] = $_REQUEST['aluguel'];
}
if (array_key_exists("venda", $_REQUEST)) {
	$arrBusca['venda'] = $_REQUEST['venda'];
}
if (array_key_exists("p", $_REQUEST)) {
	$arrBusca['p'] = $_REQUEST['p'];
}
if (array_key_exists("ordem", $_REQUEST)) {
	$arrBusca['ordem'] = $_REQUEST['ordem'];
}
if (array_key_exists("campo", $_REQUEST)) {
	$arrBusca['campo'] = $_REQUEST['campo'];
}

//unset($_REQUEST['_ga'], $_REQUEST['_gat'], $_REQUEST['PHPSESSID']);
//$request = $_REQUEST;
$request = $arrBusca;

$busca = $imovelcontrol->pesquisaImovel($post, $campo.' '.$ordem, 12, $offset);
$count_busca = $imovelcontrol->countPesquisaImovel($post);

$count_geral = $imovelcontrol->countPesquisaImovel();
if ($post['id_cidade'] != '')
	$cidade_busca = $imovelcontrol->getNomeCidade($post['id_cidade']);

unset($pag, $offset, $post);
?>