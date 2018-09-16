<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br"/>
	<head>
    	<?php
			/*error_reporting(E_ALL);
			ini_set('display_errors','On'); */
			ini_set('display_errors','Off');
			include "config.php"; 
		?>
        
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
		<link href="css/style.css" rel="stylesheet" type="text/css" />
				
		<? include_once "scripts.php"; ?>
				
	</head>
<body>

<div class="loading">
	<div class="box-loading">
    	<img src="images/loading.GIF" /><br />
    	Carregando ...
    </div>
</div>

<div class="loading-excluir" style="display:none;">
	<div class="box-loading">
    	Gostaria mesmo de excluir esse imóvel?<br /><br />
        <a href="javascript:;" onclick="excluirImovel();" class="button">SIM</a>
        &nbsp;&nbsp;&nbsp;
        <a href="javascript:;" onclick="$('.loading-excluir').hide();setIdGlob();" class="button">NÃO</a>
    </div>
</div>