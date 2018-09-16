<?php $PAGE="Página não encontrada :("; ?>
<?php include "cabecalho.php"; ?>
<?php include "topo.php"; ?>
<?php include "pacotes/work/work_busca.php"; ?>

<?
	$qs = http_build_query($request);
	//$qs = substr($qs, 0, strpos($qs, 'PHPSESSID'));
	//$qs = substr($qs, 0, -1);

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
        <h1><i class="fa fa-meh-o"></i> &nbsp;<strong>ERRO 404</strong> - Página não encontrada</h1> 
        <p style="margin-bottom:20px;text-align:center;">
            Não desista - o imóvel que você estava procurando provavelmente já foi vendido.<br />Use a busca abaixo para encontrar outro imóvel.<br />
        </p>
        <div class="order-by">
        	<div class="total">
            	Total de<br />
                <strong><?=number_format($count_busca, 0, ',', '.');?> imóveis</strong><br />
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
	                        <span class="local"><?=$imovel->getLocalizacao();?></span><br />
                            <div class="area">
                                <strong><?=$texto48?>:</strong> <?=number_format($imovel->getArea(), 2, ".", " ");?> m²
                            </div>
	                        <span class="finalidade"><?=$imovel->getFinalidade();?></span><br />
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
						/*echo '<li class="arrow"><a href="imoveis.php?local='.$_REQUEST['local'].'&tipo='.$_REQUEST['tipo'].'
								&quartos='.$_REQUEST['quartos'].'&banheiros='.$_REQUEST['banheiros'].'
								&valor_de='.$_REQUEST['valor_de'].'&valor_ate='.$_REQUEST['valor_ate'].'&p='.($sel-1).$qs_ord.'">
								<img src="images/previous.png" /></a></li>';*/
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
								/*echo ' <li><a href="imoveis.php?local='.$_REQUEST['local'].'&tipo='.$_REQUEST['tipo'].'
								&quartos='.$_REQUEST['quartos'].'&banheiros='.$_REQUEST['banheiros'].'
								&valor_de='.$_REQUEST['valor_de'].'&valor_ate='.$_REQUEST['valor_ate'].'&p='.$i.$qs_ord.'">' . $i . '</a></li> ';*/
								echo ' <li><a href="imoveis.php?'.$qs.'&p='.$i.$qs_ord.'">' . $i . '</a></li> ';
							}
						}
					}
	
					if ($sel < ($quant_pg)) {
						/*echo '<li class="arrow"><a href="imoveis.php?local='.$_REQUEST['local'].'&tipo='.$_REQUEST['tipo'].'
								&quartos='.$_REQUEST['quartos'].'&banheiros='.$_REQUEST['banheiros'].'
								&valor_de='.$_REQUEST['valor_de'].'&valor_ate='.$_REQUEST['valor_ate'].'&p='.($sel+1).$qs_ord.'">
								<img src="images/next.png" /></a></li>';*/
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