<?php if ($pagina != "imovel") { ?>
<? ini_set('display_errors','Off'); ?>
<?php include "pacotes/work/work_index.php"; ?>
<?php } ?>

<div class="topo">
	<a href="index.php">
    	<div class="logo-topo">
			<img src="images/logo-topo-nova.png" />
            <p><?=$texto1?></p>
        </div>
    </a>
    <div class="info-contato">
    	<div class="line">
        	<img src="images/icon-email.png"><?=$geral->getEmail1();?>
        </div>
        <div class="line">
            <img src="images/icon-facebook.png">/cidade.orlando
            &nbsp;&nbsp;&nbsp;
            <img src="images/icon-telefone.png"><font class="tel"><?=$geral->getTelefone1();?></font>
        </div>
    </div>
    <div class="linguagens">
    	<?=$texto60?>: <?=$texto61?>
    </div>
    <div class="menu-mobile" id="show-menu">
    	<a href="javascript:;"><img src="images/menu-mobile.png"></a>
    </div>
    <div class="menu-mobile" id="hide-menu">
    	<a href="javascript:;"><img src="images/menu-mobile.png"></a>
    </div>
    <div class="menu" id="menu-principal">
    	<ul>
        	<li><a href="index.php"><?=$texto2?></a></li>
          <?php if ($lang == "pt") { ?>  
            <li><a href="/blog">Blog</a></li>
          <?php } ?>
          <li><a href="imoveis.php?venda=1"><?=$texto3?></a></li>
          <li><a href="http://www.vacationindisney.com" target="_blank"><?=$texto96?></a></li>
          <li><a href="institucional.php"><?=$texto4?></a></li>
          <li><a href="nossos-servicos.php"><?=$texto94?></a></li>
          <li><a href="dicas-duvidas.php"><?=$texto95?></a></li>
          <li><a href="contato.php"><?=$texto5?></a></li>
        </ul>
    </div>
</div>


<div class="topo" id="topo-fixo">
	<a href="index.php">
    	<div class="logo-topo">
			<img src="images/logo-topo-nova.png" />
            <p><?=$texto1?></p>
        </div>
    </a>
    <div class="info-contato">
        <div class="line">
            <img src="images/icon-email.png"><?=$geral->getEmail1();?>
            &nbsp;&nbsp;&nbsp;
            <img src="images/icon-facebook.png">/cidade.orlando
            &nbsp;&nbsp;&nbsp;
            <img src="images/icon-telefone.png"><font class="tel"><?=$geral->getTelefone1();?></font>
        </div>
    </div>
    <div class="linguagens">
    	<?=$texto60?>: <?=$texto61?>
    </div>
    <div class="menu-mobile" id="show-menu">
    	<a href="javascript:;"><img src="images/menu-mobile.png"></a>
    </div>
    <div class="menu-mobile" id="hide-menu">
    	<a href="javascript:;"><img src="images/menu-mobile.png"></a>
    </div>
    <div class="menu" id="menu-principal">
    	<ul>
        	<li><a href="index.php"><?=$texto2?></a></li>
          <?php if ($lang == "pt") { ?>  
            <li><a href="/blog">Blog</a></li>
          <?php } ?>
          <li><a href="imoveis.php?venda=1"><?=$texto3?></a></li>
          <li><a href="http://www.vacationindisney.com" target="_blank"><?=$texto96?></a></li>
          <li><a href="institucional.php"><?=$texto4?></a></li>
          <li><a href="nossos-servicos.php"><?=$texto94?></a></li>
          <li><a href="dicas-duvidas.php"><?=$texto95?></a></li>
          <li><a href="contato.php"><?=$texto5?></a></li>
        </ul>
    </div>
</div>


<div class="conteudo">