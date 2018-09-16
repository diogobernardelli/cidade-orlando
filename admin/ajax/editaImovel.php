<?
ini_set('display_errors','Off');
chdir('../../');
require_once 'pacotes/controller/ImovelController.php';
$imovelcontrol = new ImovelController();
 
$dados_old = json_decode(str_replace('\'', '"', stripslashes($_POST['dados_old'])));
unset($_POST['dados_old']);

$id = $_POST['id'];
unset($_POST['id']);

if ($dados_old->valor != $_POST['valor']) {
	$dados_new['valor'] = $_POST['valor'];
} 
if ($dados_old->tipo != $_POST['tipo']) {
	$dados_new['tipo'] = $_POST['tipo'];
}
if ($dados_old->finalidade != $_POST['finalidade']) {
	$dados_new['finalidade'] = $_POST['finalidade'];
}
if ($dados_old->banheiros != $_POST['banheiros']) {
	$dados_new['banheiros'] = $_POST['banheiros'];
}
if ($dados_old->quartos != $_POST['quartos']) {
	$dados_new['quartos'] = $_POST['quartos'];
}
if ($dados_old->area != $_POST['area']) {
	$dados_new['area'] = $_POST['area'];
}
if ($dados_old->idade != $_POST['idade']) {
	$dados_new['idade'] = $_POST['idade'];
}
if ($dados_old->localizacao != $_POST['localizacao']) {
	$dados_new['localizacao'] = $_POST['localizacao'];
}
if ($dados_old->latitude != $_POST['latitude']) {
	$dados_new['latitude'] = $_POST['latitude'];
}
if ($dados_old->longitude != $_POST['longitude']) {
	$dados_new['longitude'] = $_POST['longitude'];
}
if ($dados_old->status != $_POST['status']) {
	$dados_new['status'] = $_POST['status'];
}
if ($dados_old->informacoes_adicionais != $_POST['informacoes_adicionais']) {
	$dados_new['informacoes_adicionais'] = $_POST['informacoes_adicionais'];
}
if ($dados_old->id_cidade != $_POST['id_cidade']) {
	$dados_new['id_cidade'] = $_POST['id_cidade'];
}

$dados_new_img = array();
$imagens = $dados_old->imagens;
$imagens_new = $_POST['imagens'];

if (count($dados_old->imagens) == count($_POST['imagens']) || count($dados_old->imagens) > count($_POST['imagens'])) {
	for ($x = 0; $x < count($imagens); $x++) {
		if ($imagens[$x] != $imagens_new[$x]) {
			$img['new'] = $imagens_new[$x];
			$img['old'] = $imagens[$x];
			$dados_new_img[] = $img;
		}
	}
} else {
	for ($x = 0; $x < count($imagens_new); $x++) {
		if ($imagens[$x]) {
			if ($imagens[$x] != $imagens_new[$x]) {
				$img['new'] = $imagens_new[$x];
				$img['old'] = $imagens[$x];
				$dados_new_img[] = $img;
			}
		} else {
			$img['new'] = $imagens_new[$x];
			$img['old'] = '';
			$dados_new_img[] = $img;
		}
	}
}
unset($_POST['imagens'], $imagens, $imagens_new);

$dados_new_det = $_POST['detalhes'];
unset($_POST['detalhes']);

if (count($dados_new) > 0 || count($dados_new_img) > 0 || count($dados_new_det) > 0) {
	if ($imovelcontrol->updateImovel($id, $dados_new, $dados_new_img, $dados_new_det, $dados_old)) {
		$response = json_encode(array("msg" => "Imóvel editado com sucesso!"));
	} else {
		$response = json_encode(array("erro" => "Ocorreu algum erro."));
	}
} else {
	$response = json_encode(array("msg" => "Nenhum dado alterado."));
}

unset($_POST, $produtocontrol, $dados_old, $dados_new, $dados_new_img, $dados_new_det, $id);
exit($response);
?>