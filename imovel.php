<? ini_set('display_errors','Off'); ?>
<?php include "pacotes/work/work_index.php"; ?>
<?php $pagina = "imovel" ?>
<?php include "pacotes/work/work_imovel.php"; ?>
<?php include "cabecalho.php"; ?>
<?php include "topo.php"; ?>

<script type="text/javascript">
	function enviaContatoAnuncio() {
		if ($('#nome').val() != '' && $('#telefone').val() != '' && $('#email').val() != '' && $('#mensagem').val() != '') {
				$('.loading').show();
				
				$.post("ajax/enviaContatoAnuncio.php", { nome:$('#nome').val(), telefone:$('#telefone').val(), 
													email:$('#email').val(), mensagem:$('#mensagem').val(), id:'<?=$_REQUEST['id'];?>',
                                                       valor:$('#valor').val(), recaptcha:grecaptcha.getResponse()}, 
					function(data){
						$('.loading').hide();
						if (data) {
                            if (data.errocaptcha) {
                                alert($texto129);
                            } else {
                                alert('<?=$texto49?>');
                                location.href = 'imovel.php?id=<?=$_REQUEST['id'];?>';
                            }
						} else {
							alert('<?=$texto50?>');
						}
				},'json');
		} else {
			alert('<?=$texto51?>');
		}
	}
	
	function destacaImagem(id) {
		$('#destaqueImg').attr('src', $('#img'+id).attr('src'));
		$('.galeria .img').each(function(){
			$(this).removeClass('selected');	
		});
		$('#divImg'+id).addClass('selected');
	}
</script>



<!--<h1><?=$imovel->getId_rets();?></h1>-->
<div class="listagem page-imovel listagem-tamanho-fixo ">
    
            	<div class="left-bar">
                    <h1><?=$imovel->getLocalizacao();?></h1>
                    
                    <div class="share-topo">
                        <span class='st_fblike_hcount' displayText='Facebook Like'></span>
                        <span class='st_facebook_hcount' displayText='Facebook'></span>
                        <span class='st_twitter_hcount' displayText='Tweet'></span>
                        <span class='st_linkedin_hcount' displayText='LinkedIn'></span>
                        <span class='st_email_hcount' displayText='Email'></span>  
                    </div>
                    
                    <div class="imovel">
                        <div class="imagem-destaque" name="destaqueImg">
						<?
							if (!$imagens) {
								echo '<img rel="image_src" id="destaqueImg" src="uploads/sem-foto.jpg" />';
							} else {
								echo '<a href="uploads/'.$imagens[0].'" data-lightbox="imoveis" ><img rel="image_src" id="destaqueImg" src="uploads/'.$imagens[0].'" /></a>';
							}
						?>
                        </div>
                        <?php if ($imagens) { ?>
                        <div class="galeria">
                            <?php for ($i = 0; $i < count($imagens); $i++) { ?>
                                <div id="divImg<?=$i;?>" class="img <?php if ($i == 0) { ?>selected <?php } ?>">
<!--                                    <a href="#destaqueImg" onclick="destacaImagem(<?=$i;?>);" ><img id="img<?=$i;?>" rel="image_src" src="uploads/<?=$imagens[$i];?>" /></a>-->
                                    
                                    <a href="uploads/<?=$imagens[$i];?>" data-lightbox="imoveis" >
                                        <div class="zoom-img">
                                            <i class="fa fa-search-plus" aria-hidden="true"></i><br />
                                            <span><?=$texto132?></span>
                                        </div>
                                        <img rel="image_src" src="uploads/<?=$imagens[$i];?>" />
                                    </a>
                                </div>
                                <?php if ($i % 5 == 0 && $i > 0) { ?>
                                	<!--<div class="clear"></div>-->
                                <?php } ?>
                            <?php } ?>
                        </div>
                        <?php } ?>
                        
                        <div class="share"></div>
                        <div class="info-imovel">
                            <!--<div class="descricao">
                                <p><?=$imovel->getInformacoes_adicionais();?></p>
                            </div>-->
                            <?=$texto65?>
                            <fieldset class="overview">
                                <legend><?=$texto87?></legend>
                                <p>
                                    <!--<strong><?=$texto46?>:</strong> U$ <?=number_format($imovel->getValor(), 2, ".", " ");?><br />-->
                                    
                                    <strong><?=$texto53?>:</strong>	
									<?
										$imovel_text = $imovel->getFinalidade();
										if ($imovel_text == "Aluguel") {
											echo $texto32;
										} else {
											echo $texto33;
										}
									?><br />
                                    <strong><?=$texto23?>:</strong>	<?=$imovel->getTipo();?><br />
                                    <strong><?=$texto88?>: </strong><?=$imovel->getAno_construcao();?><br />
                                    
                                    <strong><?=$texto29?>:</strong>	
									<?
										if ($imovel->getBanheiros() == 'mais')
											echo $texto28;
										else
											echo $imovel->getBanheiros();
									?><br />
                                    <strong><?=$texto27?>:</strong>	
									<?
										if ($imovel->getQuartos() == 'mais')
											echo $texto28;
										else
											echo $imovel->getQuartos();
									?><br />
                                    <strong><?=$texto48?>:</strong>	<?=number_format($imovel->getArea(), 2, ".", " ");?>m²
                                </p>
                            </fieldset>
                            
                            <div class="novo-valor">
                                <a href="javascript:;" class="saber-valor"><strong><!--<i class="fa fa-usd"></i>&nbsp;<?=$texto46?>-->U$ <?=number_format($imovel->getValor(), 2, ".", " ");?></strong><br />
                                <!--<?=$texto70?>--></a>
                            </div>
                            
                            <fieldset class="overview geral">
                                <legend><?=$texto55?></legend>
                                <ul>
                               	<?
                               		/*foreach ($detalhes as $detalhe) {
                               			echo '<li>* '.$detalhe.'</li>';
                               		}*/
						   		?>
                                <?=$imovel->getInformacoes_adicionais();?>
                                <br /><br />
                                <?=$imovel->getDescricao();?>
                                </ul>
                            </fieldset>
                            
                            <!-- DETALHES DO IMÓVEL -->
                            <fieldset class="info-var">
                                <legend><?=$texto133?></legend>
                                
                                <?php if ($imovel->getSalas_adicionais() != "") { ?>
                                <div class="field">
                                    <strong><?=$texto134?>: </strong><?=$imovel->getSalas_adicionais();?>
                                </div>
                                <?php } ?>
                                
                                <?php if ($imovel->getEscritorios() != "") { ?>
                                <div class="field">
                                    <strong><?=$texto135?>: </strong><?=$imovel->getEscritorios();?>
                                </div>
                                <?php } ?>
                                
                                <?php if ($imovel->getQuartos_visita() != "") { ?>
                                <div class="field">
                                    <strong><?=$texto136?>: </strong><?=$imovel->getQuartos_visita();?>
                                </div>
                                <?php } ?>
                                
                                 <?php if ($imovel->getPets() != "") { ?>
                                <div class="field">
                                    <strong><?=$texto137?>: </strong><?=$imovel->getPets();?>
                                </div>
                                <?php } ?>
                                
                                <?php if ($imovel->getEstacionamento() != "" && $imovel->getEstacionamento() != "null" ) { ?>
                                <div class="field">
                                    <strong><?=$texto138?>: </strong><?=$imovel->getEstacionamento();?>
                                </div>
                                <?php } ?>
                                
                                <?php if ($imovel->getBaias() != "") { ?>
                                <div class="field">
                                    <strong><?=$texto139?>: </strong><?=$imovel->getBaias();?>
                                </div>
                                <?php } ?>
                                
                                <?php if ($imovel->getDimensao_lote() != "") { ?>
                                <div class="field">
                                    <strong><?=$texto140?>: </strong><?=$imovel->getDimensao_lote();?>
                                </div>
                                <?php } ?>
                                
                                <?php if ($imovel->getNumero_lote() != "") { ?>
                                <div class="field">
                                    <strong><?=$texto141?>: </strong><?=$imovel->getNumero_lote();?>
                                </div>
                                <?php } ?>
                                
                                <?php if ($imovel->getCondicao() != "") { ?>
                                <div class="field field-full">
                                    <strong><?=$texto142?>: </strong><?=$imovel->getCondicao();?>
                                </div>
                                <?php } ?>
                                
                                <?php if ($imovel->getCaracteristicas_cozinha() != "" && $imovel->getCaracteristicas_cozinha() != "null" ) { ?>
                                <div class="field">
                                    <strong><?=$texto143?>: </strong><?=$imovel->getCaracteristicas_cozinha();?>
                                </div>
                                <?php } ?>
                                
                                <?php if ($imovel->getAr_condicionado() != "") { ?>
                                <div class="field">
                                    <strong><?=$texto144?>: </strong><?=$imovel->getAr_condicionado();?>
                                </div>
                                <?php } ?>
                                
                                <?php if ($imovel->getEstilo_arquitetura() != "") { ?>
                                <div class="field">
                                    <strong><?=$texto145?>: </strong><?=$imovel->getEstilo_arquitetura();?>
                                </div>
                                <?php } ?>
                                
                                <?php if ($imovel->getLayout_interior() != "") { ?>
                                <div class="field field-full">
                                    <strong><?=$texto146?>: </strong><?=$imovel->getLayout_interior();?>
                                </div>
                                <?php } ?>
                                
                                <?php if ($imovel->getManutencoes() != "") { ?>
                                <div class="field field-full">
                                    <strong><?=$texto147?>: </strong><?=$imovel->getManutencoes();?>
                                </div>
                                <?php } ?>
                                
                                
                            </fieldset>
                            
                            <!-- COMUNIDADE -->
                            <?php if ($imovel->getCaracteristicas_comunidade() != "") { ?>
                            <fieldset class="info-var">
                                <legend><?=$texto89?></legend>
                                <strong><?=$texto131?>: </strong><?=$imovel->getCaracteristicas_comunidade();?><br />
                                <?php if ($imovel->getFaculdades() != "") { ?>
                                <strong><?=$texto148?>: </strong><?=$imovel->getFaculdades();?>
                                <?php } ?>
                            </fieldset>
                            <?php } ?>
                            
                            <!-- PISCINA -->
                            <?php if ($imovel->getPiscina() != "") { ?>
                            <fieldset class="info-var">
                                <legend><?=$texto130?></legend>
                                <div class="field">
                                    <strong><?=$texto93?> </strong> <?=$imovel->getPiscina();?>
                                </div>
                                <?php if ($imovel->getDimensoes_piscina() != "") { ?>
                                <div class="field">
                                    <strong><?=$texto149?>: </strong> <?=$imovel->getDimensoes_piscina();?>
                                </div>
                                <?php } ?>
                                <?php if ($imovel->getTipo_piscina() != "") { ?>
                                <div class="field field-full">
                                    <strong><?=$texto150?>: </strong> <?=$imovel->getTipo_piscina();?>
                                </div>
                                <?php } ?>
                            </fieldset>
                            <?php } ?>
                            
                            <!-- EDIFÍCIO -->
                            <?php if ($imovel->getNome_edificio() != "") { ?>
                            <fieldset class="info-var">
                                <legend><?=$texto151?></legend>
                                <div class="field field-full">
                                    <strong><?=$texto17?>: </strong> <?=$imovel->getNome_edificio();?>
                                </div>
                                <?php if ($imovel->getNome_edificio() != "") { ?>
                                <div class="field">
                                    <strong><?=$texto152?>: </strong> <?=$imovel->getAndares_edificio();?>
                                </div>
                                <?php } ?>
                                <?php if ($imovel->getAndar() != "") { ?>
                                <div class="field">
                                    <strong><?=$texto153?>: </strong> <?=$imovel->getAndar();?>
                                </div>
                                <?php } ?>
                            </fieldset>
                            <?php } ?>
                            
                            <!-- GARAGEM -->
                            <?php if ($imovel->getGaragem() != "") { ?>
                            <fieldset class="info-var">
                                <legend><?=$texto154?></legend>
                                <div class="field">
                                    <strong><?=$texto155?>: </strong><?=$imovel->getGaragem();?>
                                </div>
                                <?php if ($imovel->getDimensoes_garagem() != "") { ?>
                                <div class="field">
                                    <strong><?=$texto149?>: </strong><?=$imovel->getDimensoes_garagem();?>
                                </div>
                                <?php } ?>
                                
                                <?php if ($imovel->getCaracteristicas_garagem() != "") { ?>
                                <div class="line">
                                    <strong><?=$texto131?>: </strong><?=$imovel->getCaracteristicas_garagem();?>
                                </div>
                                <?php } ?>
                            </fieldset>
                            <?php } ?>
                            
                            <!-- LIST AGENT -->
                            <?php if ($imovel->getList_agent() != "" || $imovel->getList_office() != "") { ?>
                            <fieldset class="info-var">
                                <legend>List Agent</legend>
                                <div class="line">
                                    <?php if ($imovel->getList_agent() != "") { ?>
                                    <strong>Propriedade listada/representada por: </strong><?=stripslashes($imovel->getList_agent());?>
									<br />
                                    <?php } if ($imovel->getList_office() != "") { ?>
									<strong>Imobiliária: </strong><?=stripslashes($imovel->getList_office());?>
                                    <?php } ?>
                                </div>
                            </fieldset>
                            <?php } ?>
                            
                            <!-- LOCALIZAÇÃO -->
                            <fieldset class="info-var info-var-mapa">
                                <legend><?=$texto54?></legend>
                                <strong><?=$texto90?>:</strong> <?=$imovel->getLocalizacao();?> - <?=$cidade_imovel['nome'].', FL';?><br />
                                <?php if ($imovel->getZipcode() != "") { ?>
                                <div class="field">
                                    <strong><?=$texto91?>:</strong> <?=$imovel->getZipcode();?><br />
                                </div>
                                <?php } ?>
                                <?php if ($imovel->getZipcode_plus4() != "") { ?>
                                <div class="field">
                                    <strong><?=$texto92?>:</strong> <?=$imovel->getZipcode_plus4();?><br />
                                </div>
                                <?php } ?>
                            </fieldset>
                            
                            <div class="mapa">
                                <input type="hidden" id="latitude" value="<?=$imovel->getLatitude();?>" />
                                <input type="hidden" id="longitude" value="<?=$imovel->getLongitude();?>" />
                                <iframe src="ajax/mapa_imovel.php"  frameborder="0" style="border:0"></iframe>
                            </div>
                            
                            <?php if ($lang == "en") { ?>
                              <div class="idx">
                                <div class="first-line">
                                  <?=$texto161?><a href="http://mfrmls.com/" target="_blank"><strong>MFRMLS</strong></a>.<br />
                                </div>
                                <div class="second-line">
                                  <?=$texto162?>
                                </div>
                                <div class="third-line">
                                  <?php if (date('G') >= 03 && date('G') <= 14 ) { ?>
                                    <?=$texto163?> <strong><?php echo date('d/m/Y'); ?> at 02:45am</strong><br />
                                  <?php } else if (date('G') >= 15 && date('G') <= 23 ) { ?>
                                    <?=$texto163?> <strong><?php echo date('d/m/Y'); ?> at 02:45pm</strong><br />
                                  <?php } else { ?>
                                    <?=$texto163?> <strong><?php echo date('d/m/Y',strtotime("-1 days")); ?> at 02:45pm</strong><br />
                                  <?php } ?>
                                  <i><?=$texto164?></i>
                                </div>
                              </div>
                            <?php } ?>
                            
                            <div class="clear"></div>
                            
                            <div class="corretor-imovel">
                                <div class="corretor-left">
                                    <img src="images/jamil2.jpg">
                                    <div class="media">
                                        <a href="https://www.facebook.com/jamil.swaid.1?fref=ts" target="_blank">
                                            <i class="fa fa-facebook-square"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="corretor-right">
                                    <h3>Jamil Swaid</h3>
                                    <h5><?=$texto156?></h5><br />
                                    <p><strong><a href="javascript:false;" onclick="imDn('<?=$imovel->getId();?>');" style="text-decoration:none; color:#333;cursor:default;">Jamil</a></strong> <?=$texto157?>.</p>
                                </div>
                            </div>
                            
                            <div class="share-imovel">
                                <h3><i class="fa fa-share-alt"></i> &nbsp;&nbsp;&nbsp;<?=$texto75?></h3>
                                <span class='st_facebook_large' displayText='Facebook'></span>
                                <span class='st_twitter_large' displayText='Tweet'></span>
                                <span class='st_linkedin_large' displayText='LinkedIn'></span>
                                <span class='st_googleplus_large' displayText='Google +'></span>
                                <span class='st_email_large' displayText='Email'></span>
                                <!--<span class='st_fblike_large' displayText='Facebook Like'></span>
                                <span class='st__large' displayText=''></span>-->
                            </div>
                            
                            <div class="comentarios">
                                <h3><i class="fa fa-comment"></i> &nbsp;&nbsp;&nbsp;Comentários</h3>
                                <div id="fb-root"></div>
                                <script>(function(d, s, id) {
                                  var js, fjs = d.getElementsByTagName(s)[0];
                                  if (d.getElementById(id)) return;
                                  js = d.createElement(s); js.id = id;
                                  js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.4&appId=311673308982461";
                                  fjs.parentNode.insertBefore(js, fjs);
                                }(document, 'script', 'facebook-jssdk'));</script>

                                <?php

                                    $protocolo    = (strpos(strtolower($_SERVER['SERVER_PROTOCOL']),'https') === false) ? 'http' : 'https';
                                    $host         = $_SERVER['HTTP_HOST'];
                                    $script       = $_SERVER['SCRIPT_NAME'];
                                    $parametros   = $_SERVER['QUERY_STRING'];
                                    $UrlAtual     = $protocolo . '://' . $host . $script . '?' . $parametros;
                                ?>

                                <div class="fb-comments" data-href="<?=$UrlAtual?>" data-numposts="5" data-width="600"></div>
                            </div>
                        </div>
                    </div>
                </div>
            
            	<div class="right-bar mais-recentes lista-lateral">
					<?php include "right-bar-contato.php"; ?> 
                    <?php include "right-bar.php"; ?> 
                </div>

    
</div>

<?php include "rodape.php"; ?>