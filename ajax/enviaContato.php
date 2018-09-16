<?
ini_set('display_errors','Off');
chdir('../');
require_once 'phpmailer/class.phpmailer.php';

$phpmail = new PHPMailer ();

$phpmail->isSMTP ();

// Configuração de SMTP
$phpmail->Host = "ssl://sis03.sisrnservers.net";
$phpmail->SMTPAuth = true;
//$phpmail->SMTPDebug = true;
$phpmail->Port = 465;
$phpmail->Username = 'contact@alphaleaderfl.com';
//$phpmail->Password = "cidadeorlando2014";
$phpmail->Password = "melissa22";

// Remetente da mensagem
$phpmail->From = $_POST['email'];
$phpmail->FromName = 'Cidade Orlando';
$phpmail->Sender = "contact@alphaleaderfl.com";

// Destinatario do email
//$phpmail->AddAddress ($maildest);

// Iremos enviar o email no formato HTML
$phpmail->IsHTML ( true );

// Destinatario do email
$phpmail->AddReplyTo($_POST['email'], $_POST['nome']);
$phpmail->SetFrom($_POST['email'], $_POST['nome']);
$phpmail->AddAddress($phpmail->Sender, $phpmail->FromName);

// Assunto e Corpo do email
$phpmail->Subject = "[Cidade Orlando] Você tem um novo contato!";

$mensagem = 'Nome: '.$_POST['nome'].'<br>
E-mail: '.$_POST['email'].'<br>
Mensagem: '.$_POST['mensagem'];
$phpmail->Body = $mensagem;

if ($phpmail->Send ()) {
	$phpmail->ClearAllRecipients();
	$ret = true;	
} else {
	$ret = false;
}

//Link do imovel: <a href="http://cidadeorlando.com.br/imovel.php?id='.$_POST['imovel'].'">Clique Aqui</a><br>

unset($phpmail, $mensagem, $_POST);
exit($ret);
?>