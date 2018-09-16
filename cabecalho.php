<?
	if (isset($_COOKIE['cidadeorlando_lang'])) {
		$lang = $_COOKIE['cidadeorlando_lang'];
	} else {
		if (!empty($_SERVER['HTTP_CLIENT_IP']))
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		else
			$ip = $_SERVER['REMOTE_ADDR'];

		$RIP = substr($ip, 0, 3);

		if ($RIP=="200" || $RIP=="201" || $RIP=="177" || $RIP=="189" || $RIP=="187" || $RIP=="191") {
			setcookie('cidadeorlando_lang', 'pt', time()+3600*24*30*12*5, '/');
			$lang = 'pt';
		} else {
			setcookie('cidadeorlando_lang', 'en', time()+3600*24*30*12*5, '/');
			$lang = 'en';
		}
	}
?>
<?php include "languages/".$lang.".php"; ?>
<!DOCTYPE html>
<html>
	<head>
        
        <?php if ($pagina == "imovel") { ?>
            <?php $id_url = $_GET["id"] ?>
            <?
                if (!$imagens) {
                    $display_img = "sem-foto.jpg";
                } else {
                    $display_img = $imagens[0];
                }
            ?>
        
        <meta property="og:url"                content="http://www.cidadeorlando.com/imovel.php?id=<?=$id_url?>" />
        <meta property="og:type"               content="article" />
        <meta property="og:title"              content="<?=$imovel->getLocalizacao();?> - <?=$cidade_imovel['nome'].', FL';?> | U$ <?=number_format($imovel->getValor(), 2, ".", " ");?>" />
        <meta property="og:description"        content="CIDADE ORLANDO - Mais de 10 mil imóveis em 12 cidades da Grande Orlando, com propriedades para venda a partir de $8.500!" />
        <meta property="og:image"              content="http://www.cidadeorlando.com/uploads/<?=$display_img?>" />
        <meta property="fb:app_id" content="1516964138602841" />
        
        <?php } else { ?>
        
        <meta property="og:url"                content="http://cidadeorlando.com.br/" />
        <meta property="og:type"               content="article" />
        <meta property="og:title"              content="CIDADE ORLANDO" />
        <meta property="og:description"        content="Mais de 10 mil imóveis em 12 cidades da Grande Orlando, com propriedades para venda a partir de $8.500!" />
        <meta property="og:image"              content="http://cidadeorlando.com/images/thumb-face4.jpg" />
        <meta property="fb:app_id" content="1516964138602841" />
        
        <?php } ?>
        
		<meta name="Author" CONTENT="Cidade Orlando (www.cidadeorlando.com.br)"/>
		<meta name="Custodian" content="Cidade Orlando (www.cidadeorlando.com.br)" />
		<!--<meta name="DC.Identifier" content=""/> -->
		<meta name="copyright" content="© <?php $ano = date('Y'); echo $ano ?> Cidade Orlando" />
		<meta name="description" content="CIDADE ORLANDO - Mais de 10 mil imóveis em 12 cidades da Grande Orlando, com propriedades para venda a partir de $8.500!" />
		<meta name="keywords" content="cidade orlando, site casas em orlando, apartamentos em orlando, morar em orlando, corretor em orlando, casa na disney, imóveis Orlando, apartamentos em orlando, compras na disney, imóveis em orlando, imoveis a venda em orlando, casas para comprar em orlando, casas para comprar em orlando, comprar casa em orlando, comprar casa na disney" />
		<meta http-equiv="Content-Language" content="pt-br"/>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        
        
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
		<title><?=$PAGE?> | CIDADE ORLANDO</title>
		
		<link rel="icon" href="favicon.ico" type="image/x-icon" />
		<link rel="shortcut icon" href="favicon.ico" />
		
		<link href="css/reset.css" rel="stylesheet" type="text/css" /> 
		<link href="css/style.css?v1.35" rel="stylesheet" type="text/css" />
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />   
        
        <script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
        
        <!-- LIGHTBOX -->
        <script src="js/lightbox/js/lightbox.js"></script>
        <link rel="stylesheet" href="js/lightbox/css/lightbox.min.css">
        
        <? include_once "scripts.php"; ?>  
        
        
				
	</head>
<body class="full-page">