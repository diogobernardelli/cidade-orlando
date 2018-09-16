<h1><?=$texto74?></h1>
<?
	foreach ($outros_imoveis as $imovel) {
		$imgs = $imovel->getImagens();
		if (!$imgs) {
			$imgs[0] = 'sem-foto.jpg';
		}
?><!-- DUAS COLUNAS -->
    	<a href="imovel.php?id=<?=$imovel->getId();?>">
        	<div class="item">                	
                <div class="imagem">
                    <img src="uploads/<?=$imgs[0];?>">
                </div>
                <div class="info">
                    <span class="local"><?=$imovel->getLocalizacao();?></span><br />
                    <span class="finalidade">
					<?
						$imovel_text = $imovel->getFinalidade();
						if ($imovel_text == "Aluguel") {
							echo $texto32;
						} else {
							echo $texto33;
						}
					?></span><br />
                    <!--<span class="valor">U$ <?=number_format($imovel->getValor(), 2, '.', ' ');?></span>-->
                </div>                    
        	</div>
        </a>
<?
	}
?>
<!--<a href="imoveis.php" class="ver-mais" style="margin-bottom:20px;">Ver mais <img src="images/arrow-right-white.png"/></a>
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
 Cidade Orlando - Retângulo Médio 
<ins class="adsbygoogle"
     style="display:inline-block;width:300px;height:250px"
     data-ad-client="ca-pub-3977217054646922"
     data-ad-slot="2314558693"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>-->