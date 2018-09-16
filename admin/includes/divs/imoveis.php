<?
	@session_start();
	if (!isset($_SESSION['co']['admin'])) {
		header('Location: login.php');
	}
	
	chdir(dirname(__FILE__).'/../../../');
	include "pacotes/work/work_admin_imoveis.php";
	chdir('admin/');
?>

<script type="text/javascript">	
	var images_count = 0;
	
	function apagaForm() {
		id_glob = '';
		$('#btnCadastrar').show();
		$('#btnEditar').hide();
		$('#btnExcluir').hide();
		$('#id').val('');
		$('#dados_old').val('');
		$('#destaque').removeAttr("checked");
		$('#valor').val('');
		$('#tipo').val('');
		$('#finalidade').val('');
		$('#banheiros').val('1');
		$('#quartos').val('1');
		$('#area').val('');
		$('#status').val('true');
		$('#id_cidade').val('');
		$('input[type=checkbox]').each(function () {
			$(this).removeAttr("checked");
		});
		$('#localizacao').val('');
		$('#latitude').val('');
		$('#longitude').val('');
		$('#informacoes_adicionais').val('');
		$('#iframeMapa').attr('src', 'includes/mapa.php');
		/*
		var html = '<div class="imagem">';
  				html += '<div class="img">';
	    			html += '<img id="imgprin1" />';
	       		html += '</div>';
	         	html += '<ul id="img1ex"></ul>';
				html += '<input class="imagemHidden" type="hidden" name="img1" id="img1"/>';
	            html += '<iframe id="uploadImg1" name="uploadImg1" src="ajax/uploadpc.php?tp=1" frameborder="0" scrolling="no"></iframe>';
    		html += '</div>';
  		*/
		$('#uploads').html('&nbsp');
	}
	
	function pesquisaImoveis() {
		$("#resultadoBusca").html("");
		apagaForm();
		$.get('ajax/pesquisaImoveis.php', { local: $('#buscaLocal').val(), tipo: $('#buscaTipo').val(), finalidade: $('#buscaFinalidade').val(),
											status: $('#buscaStatus').val() }, 
			function(data){				
				$("#resultadoBusca").html(data.html);
		}, 'json');
	}
	
	function cadastraImovel() {
		var detalhes = Array();
		$('input[name="detalhe"]:checked').each(function () {
			detalhes.push($(this).val());
		});
		
		var destaque = 'false';
		if ($('#destaque').prop('checked'))
			destaque = 'true';
			
		var imagens = Array();
		$('.imagemHidden').each(function(){
			if ($(this).val() != '') {
				imagens.push($(this).val());
			}
		});
		
		if ($('#valor').val() != '' && $('#tipo').val() != '' && $('#finalidade').val() != '' && 
			$('#banheiros').val() != '' && $('#quartos').val() != '' &&  $('#area').val() != '' && $('#id_cidade').val() != '' && 
		 	$('#localizacao').val() != '' && $('#latitude').val() != '' && $('#longitude').val() != '' && $('#informacoes_adicionais').val() != '' && 
		 	detalhes.length > 0 && imagens.length > 0) {
	 	  		
	 	  		$('.loading').show();
	 	  		
				$.post("ajax/cadastraImovel.php", { valor: $('#valor').val(), tipo: $('#tipo').val(), finalidade: $('#finalidade').val(), 
													banheiros: $('#banheiros').val(), quartos: $('#quartos').val(), area: $('#area').val(), 
													localizacao: $('#localizacao').val(), latitude: $('#latitude').val(), longitude: $('#longitude').val(), 
													status: $('#status').val(), id_cidade: $('#id_cidade').val(), informacoes_adicionais: $('#informacoes_adicionais').val(),
													detalhes: detalhes, imagens: imagens, destaque: destaque }, 
					function(data){
						$('.loading').hide();
						if (data.msg) {
							alert(data.msg);
							mostraDivMenu('imoveis');
						} else {
							alert(data.erro);
						}
				},'json');
		} else {
			alert('Todos os campos são obrigatórios!');
		}
	}
	
	function getImovel(id) {
		$('.loading').show();
		apagaForm();
		
		$.get('ajax/getImovel.php', { id: id }, function(data){
			if (data) {
				$('#btnCadastrar').hide();
				$('#btnEditar').show();
				$('#btnExcluir').show();
				var dados_old = JSON.stringify(data);
				dados_old = dados_old.replace(/"/g, '\'');
				$("#dados_old").val(dados_old);
				$('#id').val(id);
				$('#valor').val(data.valor);
				$('#finalidade').val(data.finalidade);
				$('#tipo').val(data.tipo);
				$('#banheiros').val(data.banheiros);
				$('#quartos').val(data.quartos);
				$('#area').val(data.area);
				$('#id_cidade').val(data.id_cidade);
				$('#localizacao').val(data.localizacao);
				$('#latitude').val(data.latitude);
				$('#longitude').val(data.longitude);
				$('#informacoes_adicionais').val(data.informacoes_adicionais);
				
				if (data.destaque == 't')
					$('#destaque').prop('checked', true);
				
				if (data.status == 'f')
					$('#status').val('false');								
								
				var detalhes = data.detalhes;
				for (var i in detalhes) {
					$('#detalhe'+detalhes[i]).prop('checked', true);
				}
				
				var imagens = data.imagens;
				images_count = 0;
				for (i = 0; i < imagens.length; i++) {
					images_count++;
		            var html = '<div class="imagem" id="img'+images_count+'ex">';
		            	html += '<div class="img">';
							html += '<img id="imgprin'+images_count+'" src="../images/imovel/'+imagens[i]+'" />';
						html += '</div>';
			         	html += '<a href="javascript:;" onclick="removeAnexo('+images_count+');">REMOVER</a>';
			         	html += '<input class="imagemHidden" type="hidden" name="img'+images_count+'" id="img'+images_count+'" value="'+imagens[i]+'"/>';
					html += '</div>';
					
					$('#uploads').append(html);
				}
				
				$('#iframeMapa').attr('src', 'includes/mapa.php');
			}
			$('.loading').hide();
		},'json');
	}
	
	function editaImovel() {
		var detalhes = Array();
		$('input[name="detalhe"]:checked').each(function () {
			detalhes.push($(this).val());
		});
		
		var destaque = 'false';
		if ($('#destaque').prop('checked'))
			destaque = 'true';
			
		var imagens = Array();
		$('.imagemHidden').each(function(){
			imagens.push($(this).val());
		});
		
		if ($('#valor').val() != '' && $('#tipo').val() != '' && $('#finalidade').val() != '' && 
			$('#banheiros').val() != '' && $('#quartos').val() != '' &&  $('#area').val() != '' && $('#id_cidade').val() != '' && 
		 	$('#localizacao').val() != '' && $('#latitude').val() != '' && $('#longitude').val() != '' && $('#informacoes_adicionais').val() != '' && 
		 	detalhes.length > 0 && imagens.length > 0) {
				
				$('.loading').show();
				
				$.post("ajax/editaImovel.php", { id:$('#id').val(), valor:$('#valor').val(), tipo:$('#tipo').val(), 
													finalidade:$('#finalidade').val(), banheiros: $('#banheiros').val(), 
													quartos: $('#quartos').val(), area: $('#area').val(), id_cidade: $('#id_cidade').val(), 
													localizacao: $('#localizacao').val(), latitude: $('#latitude').val(), 
													longitude:$('#longitude').val(), informacoes_adicionais:$('#informacoes_adicionais').val(), 
													status: $('#status').val(), detalhes: detalhes, 
													imagens: imagens, dados_old: $('#dados_old').val() }, 
					function(data){
						$('.loading').hide();
						if (data.msg) {
							alert(data.msg);
							mostraDivMenu('imoveis');
						} else {
							alert(data.erro);
						}
				},'json');
		} else {
			alert('Todos os campos são obrigatórios!');
		}
	}
	
	function removeAnexo(tp) {
		if (tp) {
    		$('#img'+tp+'ex').hide();
            $("#img"+tp, top.document).val('');
            $("#imgprin"+tp, top.document).attr('src','');
        }
	}
	
	function removeAnexoTmp(tp) {
    	var arquivo = $('#img'+tp).val();
    	$.post("ajax/removeAnexoFlag.php", {arquivo: arquivo}, function(data){
    		if (tp) {
	    		$('#img'+tp+'ex').remove();
            }
    	});
	}
		
	var id_glob = '';
	function excluirImovel() {
		$('.loading').show();
		if ($('#id').val() || id_glob != '') {
			if ($('#id').val())
				id_glob = $('#id').val();
				
			$('.loading-excluir').hide();
			
			$.post("ajax/excluirImovel.php", { id:id_glob }, 
				function(data){
					$('.loading').hide();
					id_glob = '';
					if (data.msg) {
						alert(data.msg);
						mostraDivMenu('imoveis');
					} else {
						alert(data.erro);
					}
			},'json');
		}
	}
	
	function showExcluirImovel(id) {
		id_glob = id;
		$('.loading-excluir').show();
	}
	
	function setIdGlob() {
		id_glob = '';
	}
	
	$(function(){
		pesquisaImoveis();
		$('#valor').maskMoney();
		$('#area').maskMoney();
	});	
</script>

<h1>Imóveis</h1>
<div class="line">
	<div class="busca">
    	<div class="line">
        	<div class="campo" style="width:25%;">
                <label for="buscaLocal">Local</label>
                <br />
                <input name="buscaLocal" id="buscaLocal" type="text">
            </div>
            <div class="campo" style="width:12%;">
                <label for="buscaTipo">Tipo</label>
                <br />
                <select id="buscaTipo" name="buscaTipo">
                  <option value="">Todos</option>
				  <option value="Casa">Casa</option>
                  <option value="Condomínio">Condomínio</option>
                  <option value="Apartamento">Apartamento</option>
                </select>
            </div>
            <div class="campo" style="width:12%;">
            	<label for="buscaFinalidade">Finalidade</label>
                <br />
                <select id="buscaFinalidade" name="buscaFinalidade">
         	      <option value="">Todos</option>
                  <option value="Aluguel">Aluguel</option>
                  <option value="Compra">Compra</option>
                </select>
            </div>
            <div class="campo" style="width:12%;">
            	<label for="buscaStatus">Status</label>
                <br />
                <select id="buscaStatus" name="buscaStatus">
               	  <option value="">Todos</option>
                  <option value="true" selected="selected">Ativo</option>
                  <option value="false">Inativo</option>
                </select>
            </div>
            <div class="campo">
            	<label for="email">&nbsp;</label>
                <br />
            	<input type="button" value="Pesquisar" class="" onclick="pesquisaImoveis();">
            </div>
            <div class="campo ultimo-campo">
            	<label for="email">&nbsp;</label>
                <br />
            	<input type="button" value="Novo Imóvel" class="" onclick="apagaForm();">
            </div>
            
        </div>
        
        
        <div id="resultadoBusca">
			&nbsp;			
        </div>
        
    </div><!-- //busca -->
    
    <div>
    	<h1>Gerenciar Imóvel</h1>
        
		<input type="hidden" id="id" name="id" value="" />
        <input type="hidden" id="dados_old" name="dados_old" value="" />
        
		<!--<div class="line editar-imagens">
            <div id="uploads">
	            <div class="imagem">
	            	<div class="img">
	            		<img id="imgprin1" />
	           		</div>
	             	<ul id="img1ex"></ul>
					<input class="imagemHidden" type="hidden" name="img1" id="img1"/>
		            <iframe id="uploadImg1" name="uploadImg1" src="ajax/uploadpc.php?tp=1" frameborder="0" scrolling="no"></iframe>
	            </div>
     		</div>
            <div class="imagem">
            	<div class="img">
                </div>
                <a href="javascript:;" onclick="adicionarUpload();">ADICIONAR IMAGEM</a>
            </div>
        </div>-->
        
		<script src="js/uploadify/jquery.uploadify.min.js" type="text/javascript"></script>
        <link rel="stylesheet" type="text/css" href="js/uploadify/uploadify.css">
        <div class="line editar-imagens">
        	<form>
                <div id="queue"></div>
                <input id="file_upload" name="file_upload" type="file" multiple>
            </form>
        
            <script type="text/javascript">
                <?php $timestamp = time();?>
                $(function() {
                    $('#file_upload').uploadify({
                        'formData'     : {
                            'timestamp' : '<?php echo $timestamp;?>',
                            'token'     : '<?php echo md5('unique_salt' . $timestamp);?>'
                        },
                        'swf'      : 'js/uploadify/uploadify.swf',
                        'uploader' : 'js/uploadify/uploadify.php',
                        'onUploadSuccess' : function(file, data, response) {
				            images_count++;
				            var html = '<div class="imagem" id="img'+images_count+'ex">';
				            	html += '<div class="img">';
	    							html += '<img id