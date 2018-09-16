<?php $PAGE = "Lista de Imóveis para Compra, Aluguel e Venda em Orlando"; ?>
<?php include "cabecalho.php"; ?>
<?php include "topo.php"; ?>
<?php include "pacotes/work/work_busca.php"; ?>

<?
	$qs = http_build_query($request);

	$qs_ord = '';

	if (strpos($qs, '&ordem')) {
		$qs_ord = substr($qs, strpos($qs, '&ordem'));
		$qs = substr($qs, 0, strpos($qs, '&ordem'));
	}
?>

<script type="text/javascript">
	function ordenaBusca() {
		location.href='imoveis.php?<?=$qs;?>&ordem='+$('#ordem').val()+'&campo='+$('#campo').val();
	}
</script>

<div class="listagem listagem-tamanho-fixo listagem-destaque">
    <div class="left-bar">
        <?php $erro = $_GET["msg"];
        if($erro == "") { ?>
        <h1><i class="fa fa-home"></i> &nbsp;<?=$texto3?></h1>
        <?php } else { ?>
        <h1><i class="fa fa-meh-o"></i> &nbsp;<strong><?=$texto126?></strong> - <?=$texto127?></h1> 
        <p style="margin-bottom:20px;text-align:center;">
            <?=$texto128?>
        </p>
        <?php } ?>
        <div class="order-by">
        	<div class="total">
            	<?=$texto124?><br />
                <strong><?=number_format($count_busca, 0, ',', '.');?> <?=$texto125?></strong><br />
				<?
					if ($cidade_busca) {
						echo "em ".$cidade_busca.", FL";
					}
				?>
            </div>
            <div class="field">
                <label><?=$texto42?></label>
                <select id="ordem" name="ordem" onchange="ordenaBusca();" class="select-off">
                  <option <?=($request['ordem']=='DESC')?'selected="selected"':'';?> value="DESC"><?=$texto43?></option>
                  <option <?=($request['ordem']=='ASC')?'selected="selected"':'';?> value="ASC"><?=$texto44?></option>
                </select>
            </div>
            <div class="field">
                <label><?=$texto45?></label>
                <select id="campo" name="campo" onchange="ordenaBusca();" class="select-off">
                  <option <?=($request['campo']=='valor')?'selected="selected"':'';?> value="valor"><?=$texto46?></option>
                  <option <?=($request['campo']=='data_cad')?'selected="selected"':'';?> value="data_cad"><?=$texto47?></option>
                </select>
            </div>
        </div>
        <?
			foreach ($busca as $imovel) {
                $cidade_imovel = $imovelcontrol->getCidade($imovel->getId_cidade());
				$imgs = $imovel->getImagens();
				if (!$imgs) {
					$imgs[0] = 'sem-foto.jpg';
				}
		?>
	            <div class="item">
	            	<a href="imovel.php?id=<?=$imovel->getId();?>">
	                    <div class="imagem">
	                        <div class="valor">
	                            <?=number_format($imovel->getValor(), 2, '.', ' ');?> U$
	                        </div>
	                        <img src="uploads/<?=$imgs[0];?>" />
	                    </div>
	                    <div class="info">
	                        <span class="local"><?=$imovel->getLocalizacao();?></span>
                            
                            <div class="area">
                                <!--<strong><?=$texto48?>:</strong> --><?=number_format($imovel->getArea(), 2, ".", " ");?> m²
                            </div>
                            
                            <span class="finalidade"><?=$cidade_imovel['nome'];?></span><br />
	                        <!--<span class="finalidade"><?=$imovel->getFinalidade();?></span><br />-->
	                        <div class="line">
	                            
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
		?>  
		<div class="paginacao">
			<ul>
			<?
				if ($busca) {
					$quant_pg = ceil($count_busca/12);
					
					$max_links = 4;// número máximo de links da paginação: na verdade o total será cinco 4+1=5
					
					if (!isset($_REQUEST['p']) || $_REQUEST['p'] == '')
						$sel = 1;
					else
						$sel = $_REQUEST['p'];
					
					if ($sel > 1) {
						if (strpos($qs,'&p='))
							$qs = substr($qs, 0, strpos($qs,'&p='));
						echo '<li class="arrow"><a href="imoveis.php?'.$qs.'&p='.($sel-1).$qs_ord.'">
								<img src="images/previous.png" /></a></li>';
					}
		
					$links_laterais = ceil($max_links / 2);
					
					$inicio = $sel - $links_laterais;
					$limite = $sel + $links_laterais;
	
					for ($i = $inicio; $i <= $limite; $i++) {
						if ($i == $sel) {
							echo ' <li class="selected"><a href="javascript:;">' . $i . '</a></li> ';
						} else {
							if ($i >= 1 && $i <= $quant_pg) {
								echo ' <li><a href="imoveis.php?'.$qs.'&p='.$i.$qs_ord.'">' . $i . '</a></li> ';
							}
						}
					}
	
					if ($sel < ($quant_pg)) {
						echo '<li class="arrow"><a href="imoveis.php?'.$qs.'&p='.($sel+1).$qs_ord.'">
								<img src="images/next.png" /></a></li>';
					}
				}
				
				unset($_REQUEST, $busca, $count_busca);
			?>
			</ul>
		</div> 
    </div><!-- left-bar -->
    
    
    <div class="right-bar mais-recentes lista-lateral">
		<?php include "right-bar-busca.php"; ?>
    </div>
    
</div>

<?php include "rodape.php"; ?>