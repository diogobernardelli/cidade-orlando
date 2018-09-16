<?
ini_set('display_errors','Off');
@session_start();
chdir('../../');
require_once 'pacotes/controller/GeralController.php';
$geralcontrol = new GeralController();

if ($_POST['email1'] != '' && $_POST['email2'] != '' && $_POST['telefone1'] != '' && 
	$_POST['telefone2'] != '' && $_POST['skype'] != '' && $_POST['endereco'] != '') {

	$geralcontrol->updateGeral(array('email1' => $_POST['email1'], 
										'email2' => $_POST['email2'], 
										'telefone1' => $_POST['telefone1'], 
										'telefone2' => $_POST['telefone2'], 
										'skype' => $_POST['skype'], 
										'endereco' => $_POST['endereco']));
	
	$response = json_encode(array("ok" => "ok"));
			
} else {
	$response = json_encode(array("erro" => "Todos os campos são obrigatórios"));
}

unset($_POST, $geralcontrol);
exit($response);
?>