</div><!-- //conteudo -->
<div class="footer">
	<div class="conteudo-footer">
        <div class="mais-recentes">
        	<h3><?=$texto8?></h3>
            <?
				foreach ($imoveis_recentes as $imovel) {
                    $cidade_imovel = $imovelcontrol->getCidade($imovel->getId_cidade());
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
                                    <?=$cidade_imovel['nome'].', FL';?>
                                </span>
                                <br />
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
        </div>
        
        <div class="info-contato">
        	<h3><?=$texto9?></h3>
            <div class="line">
            	<div class="title">
                	<img src="images/icon-endereco-footer.png">
                    <?=$texto10?>
                </div>
                <? //$geral->getEndereco(); ?>
                8803 Futures Drive 4-102, 32819
            </div>
            <div class="line">
            	<div class="title">
                    <img src="images/icon-telefone-footer.png">
                    Whatsapp
                </div>
                <?=$geral->getTelefone1();?>
            </div>
            <div class="line">
            	<div class="title">
                    <img src="images/icon-email-footer.png">
                    <?=$texto12?>
                </div>
                <?=$geral->getEmail1();?>
            </div>
           <div class="line">
            	<div class="title">
                    <img src="images/icon-facebook-footer.png">
                    <?=$texto64?>
                </div>
                <?=$texto63?>
            </div>
            <div class="line">
            	<div class="title">
                    <img src="images/icon-skype-footer.png">
                    <?=$texto13?>
                </div>
                <?=$geral->getSkype();?>
            </div>
            
            <div class="contato-rodape">
            	<h3><?=$texto5?></h3>
                <div class="line">
                	<div class="field">
                    	<label for="nome"><?=$texto17?></label><br />
                        <input id="nome" name="nome" type="text" />
                    </div>
                    <div class="field">
                    	<label for="email"><?=$texto12?></label><br />
                        <input id="email" name="email" type="text" />
                    </div>
                </div>
                <div class="line">
                	<label for="mensagem"><?=$texto18?></label><br />
                    <textarea id="mensagem" name="mensagem"></textarea>
                </div>
                <div class="line">
                	<input type="button" onclick="enviaContato();" value="<?=$texto19?>" />
                </div>
            </div>
        </div>
        
        <div class="coluna-facebook">
        	<h3><?=$texto64?></h3>
            <div class="fb-page" data-href="https://www.facebook.com/cidade.orlando" data-width="300" data-height="520" data-hide-cover="false" data-show-facepile="false" data-show-posts="true"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/cidade.orlando"><a href="https://www.facebook.com/cidade.orlando">Cidade Orlando</a></blockquote></div></div>
        </div>
                
    </div>
    
    <div class="barra-footer">
        <span>© <!--<strong>Cidade Orlando</strong>--><img src="images/logo-cidadeorlando-rodape.png" class="logo-rodape"> <?php echo date("Y"); ?> - <?=$texto7?></span>
        <a href="http://www.diogobernardelli.com.br" target="_blank">
            <img src="images/logo-diogo.png" class="diogobernardelli" title="<?=$texto62?> Diogo Bernardelli">
        </a>
    </div>
</div>
</body>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-58600314-1', 'auto');
  ga('send', 'pageview');

</script>


<script type="text/javascript">
	function enviaContato() {
		if ($('#nome').val() != '' && $('#email').val() != '' && $('#mensagem').val() != '') {
				
				$('.loading').show();
				
				$.post("ajax/enviaContato.php", { nome:$('#nome').val(), email:$('#email').val(), mensagem:$('#mensagem').val() }, 
					function(data){
						$('.loading').hide();
						if (data) {
							location.href = 'index.php';
						} else {
							alert('<?=$texto39?>');
						}
				},'json');
		} else {
			alert('<?=$texto40?>');
		}
	}
</script>

<!-- REMARKETING GOOGLE ADWORDS -->
<!--------------------------------------------------
As tags de remarketing não podem ser associadas a informações pessoais de identificação nem inseridas em páginas relacionadas a categorias de confidencialidade. Veja mais informações e instruções sobre como configurar a tag em: http://google.com/ads/remarketingsetup

<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 963211064;
var google_custom_params = window.google_tag_params;
var google_remarketing_only = true;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/963211064/?value=0&amp;guid=ON&amp;script=0"/>
</div>
</noscript>
--------------------------------------------------->
</html>