<?php include "cabecalho.php"; ?>
<?php include "topo.php"; ?>

</div>
<div class="mapa-index">
    <div class="busca">
    	<form id="formBusca" name="formBusca" action="imoveis.php" method="REQUEST">
	        <div class="line">
	            <label>Local</label><br />
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
	            <label>Tipo</label><br />
	            <select class="select-off" id="tipo" name="tipo">
	            	<option value="">Selecione</option>
	                <option value="Casa">Casa</option>
	                <option value="Condomínio">Condomínio</option>
	                <option value="Apartamento">Apartamento</option>
	            </select>
	        </div>
	        <div class="line">
	            <div class="field">
	                <label>Quartos</label><br />
	                <select class="select-off" id="quartos" name="quartos">
	                    <option value="">Selecione</option>
	                    <option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="mais">Mais de 5</option>
	                </select>
	            </div>
	            <div class="field">
	                <label>Banheiros</label><br />
	                <select class="select-off" id="banheiros" name="banheiros">
	                    <option value="">Selecione</option>
	                    <option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="mais">Mais de 5</option>
	                </select>
	            </div>
	        </div>        
	        <div class="line">
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
	        </div>
	        <div class="line">
	            <div class="field">
	                <input type="checkbox" id="aluguel" name="aluguel" value="1" /> <label>Aluguel</label>                    
	            </div>
	            <div class="field">
	                <input type="checkbox" id="venda" name="venda" value="1" /> <label>Venda</label>                    
	            </div>
	        </div>
	        <div class="line">
	            <input type="button" value="Pesquisar" onclick="$('#formBusca').submit();" />
	        </div>
        </form>
    </div>
    <?php include "slideshow-index.php"; ?>
    <!--<iframe src="ajax/mapa.php" frameborder="0" style="border:0"></iframe>-->
</div>

<div class="conteudo conteudo-index">
    <div class="motivos-index">
    	<h1><i class="fa fa-building"></i> &nbsp;Porque Comprar/Alugar em Orlando?</h1>
        <div class="h-line"></div>
        <div class="motivo">
        	<div class="img">
            	<img src="images/motivo01.png" alt="Morar em Orlando - Motivo 01" />
            </div>
            <div class="reason">
            	<p><strong>É onde fica a Disney World Resort!</strong><br />Além do Epcot Center, Animal Kingdom, Hollywood Studios, Sea World, Universal Studios e muito mais. Lugar perfeito para grandes memórias de férias em família.</p>
            </div>
        </div>
        
        <div class="motivo motivo-direita">
        	<div class="img">
            	<img src="images/motivo02.png" alt="Morar em Orlando - Motivo 02" />
            </div>
            <div class="reason">
            	<p><strong>Pra quem gosta de um clima subtropical quente e úmido, Orlando é a decisão ideal!</strong><br />Com o céu sempre azul, a cidade é rodeada por várias praias quem ficam a cerca de 1h de distância e lagos fantásticos.</p>
            </div>
        </div>
        
        <div class="motivo">
        	<div class="img">
            	<img src="images/motivo03.png" alt="Morar em Orlando - Motivo 03" />
            </div>
            <div class="reason">
            	<p><strong>A cidade - por mais que seja um dos maiores pontos turísticos do planeta - é extremamente calma e tranquila.</strong><br />Relativamente pequena (290km² / 240 mil habitantes), é muito bem estruturada: os bairros são afastados uns dos outros.</p>
            </div>
        </div>
        
        <div class="motivo motivo-direita">
        	<div class="img">
            	<img src="images/motivo04.png" alt="Morar em Orlando - Motivo 04" />
            </div>
            <div class="reason">
            	<p><strong>Fica a apenas 8 horas de vôo do Brasil!</strong><br />É possível morar em tempo integral em Orlando e visitar o Brasil com frequência, e vice versa. E por ser um famoso ponto turístico, promoções aéreas é o que não falta!</p>
            </div>
        </div>
        
    </div>
    <div class="quem-somos-index">
    	<h1><i class="fa fa-users"></i> &nbsp;Quem Somos</h1>
        <div class="h-line"></div>
        <div class="quem">
        	<img src="images/quem-somos-index.jpg" alt="Cidade Orlando - Quem Somos?" />
        	<p>Com uma vasta experiência em mais de <strong>10 anos</strong> no mercado de construções e vendas de imóveis, <strong>Cidade Orlando</strong> não é apenas mais uma vitrine OnLine de propriedades localizadas em uma das mais famosas cidades turísticas do mundo, mas sim uma incrível ferramenta para facilitar e agilizar sua vinda para cá!<br />&nbsp;<br />Ajudamos você a escolher um entre os <strong>10 mil imóveis</strong> cadastrados em nosso site, abrangindo toda a região da Grande Orlando (Orlando e suas cidades vizinhas), desde pequenos apartamentos para aluguel até incríveis mansões de mais de 500m² e toda a beleza que você só encontra nos EUA.<br />&nbsp;<br /><a href="http://www.cidadeorlando.com.br/institucional.php">Saiba mais sobre a gente</a></p>
            <div class="clear"></div>
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
        <h1>Imóveis em Destaques</h1>
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
	                    </div>
	                </a>       
	            </div>		
  		<?
        	}
        	unset ($imoveis_destaque, $imovel, $imgs, $cidade_imovel);
		?>
    </div>
    
    <div class="ajuda-index">
        <h1><i class="fa fa-truck"></i> Precisa de ajuda? Estamos aqui!</h1>
        <img src="images/ajuda.png" alt="Ajudamos você a morar / alugar na Disney">
        <p>Nós do <strong>Cidade Orlando</strong> iremos lhe ajudar no que for necessário: auxiliamos na abertura de uma conta no exterior, calculamos frete, indicamos empresas para aluguel de carros e o que mais você precisar.</p><p>Queremos tornar o processo de mudança o mais simples possível, fazendo você se focar no que é realmente importante: <strong>a escolha do imóvel ideial</strong>!</p>
        <a href="dicas-duvidas.php">Veja algumas dicas aqui</a>
    </div>
    
    <div class="listagem">
        <h1>Outros Imóveis</h1>
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