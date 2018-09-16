<? ini_set('display_errors','Off'); ?>
<?php include "pacotes/work/work_index.php"; ?>
<div class="topo">
	<a href="index.php">
    	<div class="logo-topo">
			<img src="images/logo-topo.png" />
            <p><?=$texto1?></p>
        </div>
    </a>
    <div class="info-contato">
    	<div class="line">
        	<img src="images/icon-email.png"><?=$geral->getEmail1();?>
        </div>
        <div class="line">
        	<img src="images/icon-telefone.png"><?=$geral->getTelefone1();?>
            &nbsp;&nbsp;&nbsp;
            <img src="images/icon-facebook.png"><?=$texto63?>
        </div>
    </div>
    <!--<div class="linguagens">
    	<?=$texto60?>: <?=$texto61?>
    </div>-->
    <div class="menu-mobile" id="show-menu">
    	<a href="javascript:;"><img src="images/menu-mobile.png"></a>
    </div>
    <div class="menu-mobile" id="hide-menu">
    	<a href="javascript:;"><img src="images/menu-mobile.png"></a>
    </div>
    <div class="menu" id="menu-principal">
    	<ul>
        	<li><a href="index.php"><?=$texto2?></a></li>
            <li><a href="imoveis.php?venda=1"><?=$texto71?></a></li>
            <li><a href="imoveis.php?aluguel=1"><?=$texto72?></a></li>
            <li><a href="institucional.php"><?=$texto4?></a></li>
            <?=$texto73?>
            <li><a href="contato.php"><?=$texto5?></a></li>
        </ul>
    </div>
</div>
<div class="conteudo">