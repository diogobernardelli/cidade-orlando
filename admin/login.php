<?
	/*@session_start();
	if (isset($_SESSION['ga']['admin'])) {
		header('Location: index.php');
	}*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br"/>
	<head>
    	<?php include "config.php"; ?>
        
		<meta name="Author" CONTENT="<?=$NOME?> (<?=$SITE?>)"/>
		<meta name="Custodian" content="<?=$NOME?> (<?=$SITE?>)" />
		<meta name="DC.Identifier" content=""/> 
		<meta name="copyright" content="© <?php $ano = date('Y'); echo $ano ?> <?=$NOME?>" />
		<meta name="description" content="<?=$RESUMO_DA_PAGINA?>" />
		<meta name="keywords" content="<?=$PALAVRAS_CHAVES?>" />
		<meta http-equiv="Content-Language" content="pt-br"/>
		<meta http-equiv="cache-control"   content="no-cache" />
		<meta http-equiv="pragma" content="no-cache" />
		<meta name="revisit-after" content="5 days" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        
        <meta name="viewport" content="width=device-width; initial-scale=1.0">
		
		<title>Painel de Controle [<?=$NOME?>] - Powered by Diogo Bernardelli</title>
		
		<link rel="icon" href="favicon.ico" type="image/x-icon" />
		<link rel="shortcut icon" href="favicon.ico" />
		
		<link href="css/reset.css" rel="stylesheet" type="text/css" /> 
		<link href="css/style-login.css" rel="stylesheet" type="text/css" />
				
		<? include_once "scripts.php"; ?>
		
	</head>
<body>
<div class="content">
	<div class="title">
    	<img src="images/logo-sistema.png" />
    </div>
    <div class="form">
    	<div class="line">
            <input name="email" id="email" type="text" value="Usuário / E-mail" onfocus="clearIt(this)" onblur="setIt(this)">
        </div>
        <div class="line">
            <input name="senha" id="senha" type="password" value="Senha" onfocus="clearIt(this)" onblur="setIt(this)">
        </div>
        <div class="line">
        	<input name="" onclick="login($('#email').val(),$('#senha').val());" type="button" value="Acessar" />
        </div>
        <div class="line">
        	<a href="javascript:;">Recuperar senha</a>
        </div>
    </div>
    <div class="aviso">
        Dados incorretos
    </div>
</div>
<div class="signature">
	Powered by <a href="http://diogobernardelli.com.br" target="_blank"><img src="images/logo-diogobernardelli.png" /></a>
</div>
</body>
</html>