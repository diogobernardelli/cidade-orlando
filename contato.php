<?php $PAGE="Fale com a equipe do CIDADE ORLANDO"; ?>
<?php include "cabecalho.php"; ?>
<?php include "topo.php"; ?>

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

<div class="listagem listagem-tamanho-fixo page-contato">
    <div class="left-bar">
        <h1><i class="fa fa-phone"></i> &nbsp;<?=$texto5?></h1>     
        <div class="page-contato">
            <div class="mapa">
                <iframe src="ajax/mapa_contato.php"  frameborder="0" style="border:0"></iframe>
            </div>
            <p><?=$texto41?></p>
            <div class="info-contato">
            	<div class="field">
                	<div class="title">
                    	<img src="images/icon-endereco.png" /> <?=$texto10?>
                    </div>
                    <span id="endereco"><? //$geral->getEndereco();?>8803 Futures Drive 4-102, 32819</span>
                </div>
                <div class="field">
                	<div class="title">
                    	<img src="images/icon-telefone.png" /> <?=$texto66?>
                    </div>
                    <?=$geral->getTelefone1();?><br />
					<? //$geral->getTelefone2();?>
                </div>
                <div class="field">
                	<div class="title">
                    	<img src="images/icon-email-contato.png" /> <?=$texto12?>
                    </div>
                    <?=$geral->getEmail1();?><br />
                    <?=$geral->getEmail2();?>
                </div>
            </div>
            <div class="formulario">
            	<h2><?=$texto15?></h2>
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
    </div><!-- left-bar -->
    
    
    <div class="right-bar mais-recentes lista-lateral">
		<?php include "right-bar.php"; ?>
    </div>
    
</div>

<?php include "rodape.php"; ?>