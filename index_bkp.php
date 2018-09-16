<?php include "cabecalho.php"; ?>
<?php include "topo.php"; ?>

</div>
<div class="mapa-index">
    <div class="busca">
    	<form id="formBusca" name="formBusca" action="imoveis.php" method="REQUEST">
	        <div class="line">
	            <label><?=$texto56?></label><br />
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
	            <label><?=$texto23?></label><br />
	            <select class="select-off" id="tipo" name="tipo">
	            	<option value=""><?=$texto22?></option>
	                <option value="Casa"><?=$texto24?></option>
	                <option value="Condomínio"><?=$texto25?></option>
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
	        <!--<div class="line">
	            <div class="field">
	                <label><?=$texto30?>:</label><br />
	                <select class="select-off" id="valor_de" name="valor_de">
	                    <option value=""><?=$texto22?></option>
	                    <option value="100000">100 000 U$</option>
	                    <option value="200000">200 000 U$</option>
	                    <option value="300000">300 000 U$</option>
	                    <option value="400000">400 000 U$</option>
	                    <option value="500000">500 000 U$</option>
	                </select>
	            </div>
	            <div class="field">
	                <label><?=$texto31?>:</label><br />
	                <select class="select-off" id="valor_ate" name="valor_ate">
	                	<option value=""><?=$texto22?></option>
	                    <option value="100000">100 000 U$</option>
	                    <option value="200000">200 000 U$</option>
	                    <option value="300000">300 000 U$</option>
	                    <option value="400000">400 000 U$</option>
	                    <option value="500000">500 000 U$</option>
	                </select>
	            </div>
	        </div>-->
	        <div class="line">
	            <div class="field">
	                <input type="checkbox" id="aluguel" name="aluguel" value="1" /> <label><?=$texto32?></label>                    
	            </div>
	            <div class="field">
	                <input type="checkbox" id="venda" name="venda" value="1" /> <label><?=$texto33?></label>                    
	            </div>
	        </div>
	        <div class="line">
	            <input type="button" value="<?=$texto57?>" onclick="$('#formBusca').submit();" />
	        </div>
        </form>
    </div>
    <?php include "slideshow-index.php"; ?>
    <!--<iframe src="ajax/mapa.php" frameborder="0" style="border:0"></iframe>-->
</div>

<div class="conteudo conteudo-index">
    <div class="motivos-index">
    	<h1><i class="fa fa-building"></i> &nbsp;<?=$texto77?></h1>
        <div class="h-line"></div>
        <div class="motivo">
        	<div class="img">
            	<img src="images/motivo01.png" />
            </div>
            <div class="reason">
            	<p><?=$texto78?></p>
            </div>
        </div>
        
        <div class="motivo motivo-direita">
        	<div class="img">
            	<img src="images/motivo02.png" />
            </div>
            <div class="reason">
            	<p><?=$texto79?></p>
            </div>
        </div>
        
        <div class="motivo">
        	<div class="img">
            	<img src="images/motivo03.png" />
            </div>
            <div class="reason">
            	<p><?=$texto80?></p>
            </div>
        </div>
        
        <div class="motivo motivo-direita">
        	<div class="img">
            	<img src="images/motivo04.png" />
            </div>
            <div class="reason">
            	<p><?=$texto81?></p>
            </div>
        </div>
        
    </div>
    <div class="quem-somos-index">
    	<h1><i class="fa fa-users"></i> &nbsp;<?=$texto4?></h1>
        <div class="h-line"></div>
        <div class="quem">
        	<img src="images/quem-somos-index.jpg" />
        	<p><?=$texto76?></p>
        </div>
    </div>
</div>
    

<div class="conteudo conteudo-index">
    <!--<div class="motivos-index">
    	<h1>Porque Comprar/Alugar?</h1>
        <?php for ($i = 1; $i <= 4; $i++) { ?>
        <div class="motivo">
        	<div class="img">
            	<img src="images/motivo01.png" />
            </div>
            <div class="reason">
            	<p>Realia is ready to put your website on higher ranks. Every line of code was developed with SEO principles in mind.</p>
            </div>
        </div>
        <?php } ?>
    </div>
    <div class="quem-somos-index">
    	<h1>Quem Somos</h1>
        <div class="quem">
        	<img src="images/quem-somos-index.jpg" />
        	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce quis tincidunt elit. Donec ut ligula vel ante eleifend dapibus nec at libero. Aliquam a diam eu risus porttitor placerat. Praesent volutpat sem sed nibh dapibus adipiscing. Aenean congue porta mauris eget interdum. Nunc pharetra tempor ante vel fringilla. In aliquet fringilla dolor, eget auctor ipsum pellentesque sed. Morbi elit erat, laoreet at tincidunt quis, feugiat a libero. Nam vitae lacus eget augue ultrices placerat vel eget neque. Phasellus volutpat tincidunt dapibus. Integer adipiscing lectus vel mi porta eget pharetra elit iaculis. Vestibulum a augue quis nulla pharetra lacinia ut vel ante. Mauris tristique tellus id nibh tincidunt lobortis.</p>
        </div>
    </div>-->
    <div class="listagem listagem-destaque">
        <h1><?=$texto58?></h1>
        <?
        	foreach ($imoveis_destaque as $imovel) {
				$cidade_imovel = $imovelcontrol->getCidade($imovel->getId_cidade());
        		$imgs = $imovel->getImagens();
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
	                    </div>
	                </a>       
	            </div>		
  		<?
        	}
        	unset ($imoveis_destaque, $imovel, $imgs, $cidade_imovel);
		?>
    </div>
    
    <div class="ajuda-index">
        <h1><i class="fa fa-truck"></i> <?=$texto82?></h1>
        <img src="images/ajuda.png">
        <?=$texto83?>
    </div>
    
    <div class="listagem">
        <h1><?=$texto59?></h1>
        <?
        	$cont = 0;
			foreach ($imoveis_outros as $imovel) {
				$cidade_imovel = $imovelcontrol->getCidade($imovel->getId_cidade());
				$imgs = $imovel->getImagens();
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
	                    </div>
	                </a>       
	            </div>
            <?php if ($cont % 4 == 0) { ?>
            <div class="clear"></div>
            <?php } ?>				
        <?php } unset ($imoveis_outros, $imovel, $imgs); ?>
        <a href="imoveis.php" class="ver-mais"><?=$texto38?> <img src="images/arrow-right-white.png" /></a>
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