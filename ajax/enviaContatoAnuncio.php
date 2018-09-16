<?
ini_set('display_errors','Off');

// busca a biblioteca recaptcha
require_once "recaptchalib.php";

chdir('../');
//recaptcha
$secret = "6LeRUCATAAAAAAAmBHIKAT3fmeXp5cM8qH-9hRrb";
$response = null;
$reCaptcha = new ReCaptcha($secret);

if ($_POST["recaptcha"]) {
$response = $reCaptcha->verifyResponse(
        $_SERVER["REMOTE_ADDR"],
        $_POST["recaptcha"]
    );
}

if ($response != null && $response->success) {


    require_once 'phpmailer/class.phpmailer.php';

    $phpmail = new PHPMailer ();

    $phpmail->isSMTP ();

    // Configuração de SMTP
    $phpmail->Host = "ssl://sis03.sisrnservers.net";
    $phpmail->SMTPAuth = true;
    //$phpmail->SMTPDebug = true;
    $phpmail->Port = 465;
    $phpmail->Username = 'contact@alphaleaderfl.com';
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
    $phpmail->Subject = '[Cidade Orlando] Contato de anúncio de imóvel';

    $mensagem = 'Temos um interessado em um imóvel!<br /><br />
    Nome: '.$_POST['nome'].'<br>
    E-mail: '.$_POST['email'].'<br>
    Telefone: '.$_POST['telefone'].'<br><br>
    Link do imóvel: <a href="http://www.cidadeorlando.com.br/imovel.php?id='.$_POST['id'].'">http://www.cidadeorlando.com.br/imovel.php?id='.$_POST['id'].'</a><br />
    Valor do imóvel: US$ '.number_format($_POST['valor'],  2, ".", " ").'<br /><br />
    Mensagem: '.$_POST['mensagem'];
    $phpmail->Body = $mensagem;

    if ($phpmail->Send ()) {
        $phpmail->ClearAllRecipients();
        $ret = true;	
    } else {
        $ret = false;
    }

    unset($phpmail, $mensagem, $_POST);
    exit($ret);

} else {
//    $ret = false;
    unset($phpmail, $mensagem, $_POST);
    exit(json_encode(array("errocaptcha"=>1)));
}

?>