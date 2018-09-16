<?
	@session_start();
	if (!isset($_SESSION['co']['admin'])) {
		header('Location: login.php');
	}
?>

<script type="text/javascript">
	$(function(){
		getGeral();
	});
	
	function editaGeral() {
		if ($('#email1').val() != '' && $('#email2').val() != '' && $('#telefone1').val() != '' && 
			$('#telefone2').val() != '' && $('#skype').val() != '' && $('#endereco').val()) {
				$('.loading').show();
				$.post('ajax/editaGeral.php', { email1: $('#email1').val(), email2: $('#email2').val(),
													telefone1: $('#telefone1').val(), telefone2: $('#telefone2').val(), 
													skype: $('#skype').val(), endereco: $('#endereco').val() }, function(data){
					if (data.ok)
						mostraDivMenu('geral');
					else {
						alert(data.erro);
						$('.loading').hide();
					}
				},'json');
		} else
			alert('Valores são obrigatórios!');
	}
	
	function getGeral() {
		$('.loading').show();
		$.get('ajax/getGeral.php', function(data){
			$('#email1').val(data.email1);
			$('#email2').val(data.email2);
			$('#telefone1').val(data.telefone1);
			$('#telefone2').val(data.telefone2);
			$('#skype').val(data.skype);
			$('#endereco').val(data.endereco);
			
			$('.loading').hide();
		},'json');
	}
</script>

<h1>Configurações Gerais</h1>
<div class="line">
	<div class="busca">
    	<div class="line">
        	<div class="campo" style="width:20%;">
                <label for="email1">E-mail para Contato 1</label>
                <br />
                <input name="email1" id="email1" type="text">
            </div>
            <div class="campo" style="width:20%;">
                <label for="email2">E-mail para Contato 2</label>
                <br />
                <input name="email2" id="email2" type="text">
            </div>
            <div class="campo" style="width:15%;">
            	<label for="telefone1">Telefone 1</label>
                <br />
                <input name="telefone1" id="telefone1" type="text">
            </div>
            <div class="campo" style="width:15%;">
            	<label for="telefone2">Telefone 2</label>
                <br />
                <input name="telefone2" id="telefone2" type="text">
            </div>
            <div class="campo" style="width:15%;">
            	<label for="skype">Skype</label>
                <br />
                <input name="skype" id="skype" type="text">
            </div>
        </div>
        <div class="line">
            <div class="campo" style="width:40%;">
            	<label for="endereco">Endereço</label>
                <br />
                <input name="endereco" id="endereco" type="text">
            </div>  
        </div>
        
        <div class="line line-salvar">
        	<input type="button" onclick="editaGeral()" value="Salvar" class="">
        </div>
        
        
    </div><!-- //busca -->
</div>