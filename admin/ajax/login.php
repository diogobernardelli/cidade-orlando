<?
ini_set('display_errors','Off');
@session_start();
chdir('../../');
require_once 'pacotes/controller/UsuarioController.php';
$usuariocontrol = new UsuarioController();

if ($_POST['email'] != '' && $_POST['senha'] != '') {
	$post['login'] = $usuariocontrol->noInjection($_POST['email']);
	$post['senha'] = $usuariocontrol->noInjection($_POST['senha']);
	
	$login = $usuariocontrol->login($post);

	//SE ENCONTROU O ADMIN, CONTINUA
	if ($login) {
		$_SESSION['co']['admin'] = $login;
		$_SESSION['co']['rets_last_upd'] = $usuariocontrol->getRetsLastUpdate();
        
		/*if ($login['obriga_senha'] == 1) {
			unset($response);
			$response = json_encode(array("location" => "/painel_geral/altera_senha.php"));
		}*/
		
		$response = json_encode(array("location" => "index.php"));
	} else {
		$response = json_encode(array("erro" => "Usuário e/ou senha inválidos!"));
	}
} else {
	$response = json_encode(array("erro" => "Sem dados"));
}

unset($_POST, $post, $login, $usuariocontrol);
exit($response);
?>