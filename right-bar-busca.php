<script type="text/javascript"> 
$(function(){
	<? if ($request['valor_de']) { ?>
		$("#valor_de").maskMoney('mask', <?=$request['valor_de'];?>);
	<? } ?>
	
	<? if ($request['valor_ate']) { ?>
		$("#valor_ate").maskMoney('mask', <?=$request['valor_ate'];?>);
	<? } ?>
});
</script> 
<h1><i class="fa fa-search"></i> &nbsp;<?=$texto20?></h1>
<div class="busca">
    <form id="formBusca" name="formBusca" action="imoveis.php" method="REQUEST">
        <div class="line">
            <label><?=$texto21?></label><br />
            <select class="select" id="local" name="local">
            	<option <?=($request['local']=='')?'selected="selected"':'';?> value=""><?=$texto22?></option>
                <?
            		foreach ($cidades as $cidade) {
            			$selected = '';
            			if ($request['local'] == $cidade['id']) {
            				$selected = 'selected="selected"';
            			}
            			echo '<option value="'.$cidade['id'].'" '.$selected.'>'.$cidade['nome'].', FL</option>';
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
            	<option <?=($request['tipo']=='')?'selected="selected"':'';?> value=""><?=$texto22?></option>
                <option <?=($request['tipo']=='Casa')?'selected="selected"':'';?> value="Casa"><?=$texto24?></option>
                <option <?=($request['tipo']=='Casa geminada')?'selected="selected"':'';?> value="Casa geminada"><?=$texto25?></option>
                <option <?=($request['tipo']=='Apartamento')?'selected="selected"':'';?> value="Apartamento"><?=$texto26?></option>
            </select>
        </div>
        <div class="line">
            <div class="field">
                <label><?=$texto27?></label><br />
                <select class="select-off" id="quartos" name="quartos">
                    <option <?=($request['quartos']=='')?'selected="selected"':'';?> value=""><?=$texto22?></option>
                    <option <?=($request['quartos']=='1')?'selected="selected"':'';?> value="1">1</option>
					<option <?=($request['quartos']=='2')?'selected="selected"':'';?> value="2">2</option>
					<option <?=($request['quartos']=='3')?'selected="selected"':'';?> value="3">3</option>
					<option <?=($request['quartos']=='4')?'selected="selected"':'';?> value="4">4</option>
					<option <?=($request['quartos']=='5')?'selected="selected"':'';?> value="5">5</option>
					<option <?=($request['quartos']=='mais')?'selected="selected"':'';?> value="mais"><?=$texto28?></option>
                </select>
            </div>
            <div class="field">
                <label><?=$texto29?></label><br />
                <select class="select-off" id="banheiros" name="banheiros">
                    <option <?=($request['banheiros']=='')?'selected="selected"':'';?> value=""><?=$texto22?></option>
                    <option <?=($request['banheiros']=='1')?'selected="selected"':'';?> value="1">1</option>
					<option <?=($request['banheiros']=='2')?'selected="selected"':'';?> value="2">2</option>
					<option <?=($request['banheiros']=='3')?'selected="selected"':'';?> value="3">3</option>
					<option <?=($request['banheiros']=='4')?'selected="selected"':'';?> value="4">4</option>
					<option <?=($request['banheiros']=='5')?'selected="selected"':'';?> value="5">5</option>
					<option <?=($request['banheiros']=='mais')?'selected="selected"':'';?> value="mais"><?=$texto28?></option>
                </select>
            </div>
        </div>        
        <div class="line">
            <div class="field">
                <label><?=$texto30?></label><br />
				<input type="text" id="valor_de" name="valor_de" />
            </div>
            <div class="field">
                <label><?=$texto31?></label><br />
			<input type="text" id="valor_ate" name="valor_ate" />
            </div>
        </div>
        <div class="line">
            <input type="button" value="<?=$texto20?>" onclick="$('#formBusca').submit();" />
        </div>
    </form>
    
    <div class="info-contato-busca">
        <div class="line">
            <img src="images/icon-telefone-footer.png">
            <?=$geral->getTelefone1();?>
        </div>
        <div class="line">
            <img src="images/icon-email-footer.png">
            <?=$geral->getEmail1();?>
        </div>
       <div class="line">
            <img src="images/icon-facebook-footer.png">
            <?=$texto63?>
        </div>
        <div class="line">
            <img src="images/icon-skype-footer.png">
            <?=$geral->getSkype();?>
        </div>
    </div>
</div>