<?php $PAGE = "Casas em Orlando para compra, aluguel e venda"; ?>
<?php include "cabecalho.php"; ?>
<?php include "topo.php"; ?>

</div>
<div class="mapa-index">
    <div class="busca">
    	<form id="formBusca" name="formBusca" action="imoveis.php" method="REQUEST">
	        <div class="line">
	            <label><?=$texto21?></label><br />
	            <select class="select" id="local" name="local">
	            	<option selected="selected" value=""><?=$texto22?></option>
	            	<?
	            		foreach ($cidades as $cidade) {
	            			echo '<option '.$sel.' value="'.$cidade['id'].'">'.$cidade['nome'].', FL</option>';
	            		}
					?>
	            </select>
	        </div>
	        <div class="line">
            <label><?=$texto91?></label><br />
            <input type="text" pattern="([0-9]|[0-9]|[0-9])" maxlength="5" value="<?=$request['zipcode']?>" id="zipcode" name="zipcode" style="width: 93%;" />
          </div>
	        <div class="line">
	            <label><?=$texto23?></label><br />
	            <select class="select-off" id="tipo" name="tipo">
	            	<option value=""><?=$texto22?></option>
	                <option value="Casa"><?=$texto24?></option>
	                <option value="Casa geminada"><?=$texto25?></option>
	                <option value="Apartamento"><?=$texto26?></option>
	            </select>
	        </div>
	        <div class="line">
	            <div class="field">
	                <label><?=$texto27?></label><br />
	                <select class="select-off" id="quartos" name="quartos">
	                    <option value=""><?=$texto22?></option>
	                    <option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="mais"><?=$texto28?></option>
	                </select>
	            </div>
	            <div class="field">
	                <label><?=$texto29?></label><br />
	                <select class="select-off" id="banheiros" name="banheiros">
	                    <option value=""><?=$texto22?></option>
	                    <option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="mais"><?=$texto28?></option>
	                </select>
	            </div>
	        </div>        
	        <div class="line">
	            <div class="field">
	                <label><?=$texto30?>:</label><br />
					<input type="text" id="valor_de" name="valor_de" />
	            </div>
	            <div class="field">
	                <label><?=$texto31?>:</label><br />
					<input type="text" id="valor_ate" name="valor_ate" />
	            </div>
	        </div>
	        <div class="line">
	            <input type="button" value="<?=$texto57?>" onclick="$('#formBusca').submit();" />
	        </div>
        </form>
    </div>
    <?php include "slideshow-index.php"; ?>
</div>

<div class="conteudo conteudo-index">
    
    <div class="listagem listagem-destaque">
        <h1><?=$texto99?></h1>
        <?
        	foreach ($imoveis_destaque as $imovel) {
				$cidade_imovel = $imovelcontrol->getCidade($imovel->getId_cidade());
        		$imgs = $imovel->getImagens();
				if (!$imgs) {
					$imgs[0] = 'sem-foto.jpg';
				}
  		?>
				<div class="item">
	            	<a href="imovel.php?id=<?=$imovel->getId();?>">
	                    <div class="imagem">
	                        <!--<div class="valor">
	                            <?=number_format($imovel->getValor(), 2, '.', ' ');?> U$
	                        </div>-->
	                        <img src="uploads/<?=$imgs[0];?>" />
	                    </div>
	                    <div class="info">
	                        <span class="local"><?=$imovel->getLocalizacao();?></span>
	                        <span class="cidade-uf">
								<?=$cidade_imovel['nome'].', FL';?>
                            </span>
                            <span class="finalidade">
								<?php 
									$imovel_text = $imovel->getFinalidade();
									if ($imovel_text == "Aluguel") {
										echo $texto32;
									} else {
										echo $texto33;
									}
								?>
                            </span>
                            <br />
	                        <div class="line">
	                            <div class="area">
	                                <strong><?=$texto48?>:</strong> <?=number_format($imovel->getArea(), 2, ".", " ");?> m²
	                            </div>
	                            <div class="comodos">
	                                <div class="comodo">
	                                    <img src="images/icon-banheiro.png" />
										<?
											if ($imovel->getBanheiros() == 'mais')
												echo $texto28;
											else
												echo $imovel->getBanheiros();
										?>
	                                </div>
	                                <div class="comodo comodo-quarto">
	                                    <img src="images/icon-quarto.png" />
	                                    <?
											if ($imovel->getQuartos() == 'mais')
												echo $texto28;
											else
												echo $imovel->getQuartos();
										?>
	                                </div>
	                            </div>
	                        </div>
                            <div class="line more-info">
                                <div class="area">
                                    <strong><?=$texto100?>:</strong> <?=$imovel->getZipcode();?>
                                </div>
                                <div class="area area-right">
                                    <strong><?=$texto101?>:</strong> <?=$imovel->getGaragem();?>
                                </div>
                                <div class="line line-descricao">
                                    <p><?php if ($imovel->getDescricao() != "") { ?><strong><?=$texto102?>: </strong><?php } ?><?=$imovel->getDescricao();?></p>
                                </div>
                                <div class="botao-ver">
                                    <?=$texto103?>
                                </div>
                            </div>
	                    </div>
	                </a>       
	            </div>		
  		<?
        	}
        	unset ($imoveis_destaque, $imovel, $imgs, $cidade_imovel);
		?>
    </div>
    
    <?php if ($lang == "pt") { ?>  
    <div class="line">
        <div class="ultimas-blog">
            <h1><i class="fa fa-rss"></i> &nbsp;Últimas do Blog</h1>
			<?
				$rss = 'http://cidadeorlando.com.br/blog/feed/';

				$geraXml = simplexml_load_file($rss, 'SimpleXMLElement', LIBXML_NOCDATA );

				$x = 1;
				foreach ($geraXml->children()->channel->item as $rs){
					$tmp = explode('attachment-high', $rs->description);
					$desc = explode('/>', $tmp[1]);
					$desc = $desc[1];
					$img = explode('src=', $tmp[0]);
					$img = substr($img[1], 1, -9);
					?>
					<div class="artigo">
						<div class="imagem">
							<img src="<?=$img;?>">
						</div>
						<div class="info-artigo">
							<h2><?=$rs->title;?></h2>
							<p><?=strip_tags($desc);?></p>
							<a href="<?=$rs->link;?>" class="artigo-leia-mais">Leia Mais</a>
						</div>
					</div>
			<?
					if (($x % 2) == 0)
						echo '<div class="clear"></div>';
						
					$x++;
				}
			?>
        </div>
        
        <div class="facebook-topo">
        	<h1><i class="fa fa-facebook-square"></i> &nbsp;Cidade Orlando no Facebook</h1>
            <div id="fb-root"></div>
            <script>(function(d, s, id) {
              var js, fjs = d.getElementsByTagName(s)[0];
              if (d.getElementById(id)) return;
              js = d.createElement(s); js.id = id;
              js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.3&appId=311673308982461";
              fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>

            <div class="fb-page" data-href="https://www.facebook.com/cidade.orlando" data-width="460" data-height="800" data-hide-cover="false" data-show-facepile="true" data-show-posts="false"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/cidade.orlando"><a href="https://www.facebook.com/cidade.orlando">Cidade Orlando</a></blockquote></div></div>
        </div>
        
         <div class="depoimentos-index">
    		<h1><i class="fa fa-microphone"></i> &nbsp;Depoimento do mês</h1>
			<?
				$rss = 'http://cidadeorlando.com.br/blog/category/depoimento/feed/';

				$geraXml = simplexml_load_file($rss, 'SimpleXMLElement', LIBXML_NOCDATA );
				$rs = $geraXml->children()->channel->item[0];

				$tmp = explode('attachment-high', $rs->description);
				$desc = explode('/>', $tmp[1]);
				$desc = $desc[1];
				$img = explode('src=', $tmp[0]);
				$img = substr($img[1], 1, -9);
				?>

				<div class="img-depoimento">
					<img src="<?=$img;?>">
				</div>
				<div class="texto-depoimento">
					<h2><?=$rs->title;?></h2>
					<p><?=strip_tags($desc);?></p>
					<a href="<?=$rs->link;?>">Ler depoimento completo</a>
				</div>
        
        </div>
        
    </div>
    <?php } ?>
</div>
    

<div class="conteudo conteudo-index">
    
    <div class="listagem">
        <h1><?=$texto104?></h1>
        <?
        	$cont = 0;
			foreach ($imoveis_outros as $imovel) {
				$cidade_imovel = $imovelcontrol->getCidade($imovel->getId_cidade());
				$imgs = $imovel->getImagens();
				if (!$imgs) {
					$imgs[0] = 'sem-foto.jpg';
				}
				$cont++;
		?>
	            <div class="item">
	            	<a href="imovel.php?id=<?=$imovel->getId();?>">
	                    <div class="imagem">
	                       <!-- <div class="valor">
	                            <?=number_format($imovel->getValor(), 2, '.', ' ');?> U$
	                        </div>-->
	                        <img src="uploads/<?=$imgs[0];?>" />
	                    </div>
	                    <div class="info">
	                        <span class="local"><?=$imovel->getLocalizacao();?></span>
	                        <span class="cidade-uf">
								<?=$cidade_imovel['nome'].', FL';?>
                            </span>
                            <span class="finalidade">
								<?php 
									$imovel_text = $imovel->getFinalidade();
									if ($imovel_text == "Aluguel") {
										echo $texto32;
									} else {
										echo $texto33;
									}
								?>
                            </span><br />
	                        <div class="line">
	                            <div class="area">
	                                <strong><?=$texto48?>:</strong> <?=number_format($imovel->getArea(), 2, ".", " ");?> m²
	                            </div>
	                            <div class="comodos">
	                                <div class="comodo">
	                                    <img src="images/icon-banheiro.png" />
	                                    <?
											if ($imovel->getBanheiros() == 'mais')
												echo $texto28;
											else
												echo $imovel->getBanheiros();
										?>
	                                </div>
	                                <div class="comodo comodo-quarto">
	                                    <img src="images/icon-quarto.png" />
	                                    <?
											if ($imovel->getQuartos() == 'mais')
												echo $texto28;
											else
												echo $imovel->getQuartos();
										?>
	                                </div>
	                            </div>
	                        </div>
                            <div class="botao-ver" style="margin-bottom:10px;">
                                <?=$texto103?>
                            </div>
	                    </div>
	                </a>       
	            </div>
            <?php if ($cont % 4 == 0) { ?>
            <div class="clear"></div>
            <?php } ?>				
        <?php } unset ($imoveis_outros, $imovel, $imgs); ?>
        <a href="imoveis.php" class="ver-mais"><?=$texto38?> <img src="images/arrow-right-white.png" /></a>
    </div>
    
    <div class="line">
        <div class="motivos-index">
    	<h1><i class="fa fa-building"></i> &nbsp;<?=$texto105?></h1>
        <div class="h-line"></div>
        <div class="motivo">
        	<div class="img">
            	<img src="images/motivo01.png" alt="Morar em Orlando - Motivo 01" />
            </div>
            <div class="reason">
            	<p><?=$texto106?></p>
            </div>
        </div>
        
        
        
        <div class="motivo motivo-direita">
        	<div class="img">
            	<img src="images/motivo02.png" alt="Morar em Orlando - Motivo 02" />
            </div>
            <div class="reason">
            	<p><?=$texto107?></p>
            </div>
        </div>
        
        <div class="motivo">
        	<div class="img">
            	<img src="images/motivo03.png" alt="Morar em Orlando - Motivo 03" />
            </div>
            <div class="reason">
            	<p><?=$texto108?></p>
            </div>
        </div>
        
        <div class="motivo motivo-direita">
        	<div class="img">
            	<img src="images/motivo04.png" alt="Morar em Orlando - Motivo 04" />
            </div>
            <div class="reason">
            	<p><?=$texto109?></p>
            </div>
        </div>
        
    </div>
    <div class="quem-somos-index">
    	<h1><i class="fa fa-users"></i> &nbsp;<?=$texto4?></h1>
        <div class="h-line"></div>
        <div class="quem">
        	<img src="images/quem-somos-index.jpg" alt="Cidade Orlando - Quem Somos?" />
        	<p><?=$texto110?></p>
            <div class="clear"></div>
        </div>
    </div>
    </div>
    
    <div class="ajuda-index">
        <h1><i class="fa fa-truck"></i> <?=$texto111?></h1>
        <img src="images/ajuda.png" alt="Ajudamos você a morar na Disney">
        <p><?=$texto112?></p>
        <a href="dicas-duvidas.php"><?=$texto113?></a>
    </div>
<!-- Google Code for Formul&aacute;rio de Contato Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 963211064;
var google_conversion_language = "en";
var google_conversion_format = "3";
var google_conversion_color = "ffffff";
var google_conversion_label = "XsOGCMzMu1oQuN6lywM";
var google_remarketing_only = false;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/963211064/?label=XsOGCMzMu1oQuN6lywM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>

<?php include "rodape.php"; ?>