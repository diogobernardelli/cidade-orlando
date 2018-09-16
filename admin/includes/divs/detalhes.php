<?
	@session_start();
	if (!isset($_SESSION['co']['admin'])) {
		header('Location: login.php');
	}

	chdir(dirname(__FILE__).'/../../../');
	include "pacotes/work/work_admin_detalhes.php";
	chdir('admin/');
?>

<script type="text/javascript">
	$(function(){
		$('.loading').hide();
	});
	
	function getDetalhe(id) {
		$('.loading').show();
		$.get('ajax/getDetalhe.php', { id: id }, function(data){
			$('#id').val(id);
			$('#nome').val(data.nome);
			
			$('#botaoCadastra').hide();
			$('#botaoEdita').show();
			
			$('.loading').hide();
		},'json');
	}
	
	function editaDetalhe() {
		if ($('#id').val() != '' && $('#nome').val() != '') {
				$('.loading').show();
				$.post('ajax/editaDetalhe.php', { id: $('#id').val(), nome: $('#nome').val() }, function(data){
					if (data.ok)
						mostraDivMenu('detalhes');
					else {
						alert(data.erro);
						$('.loading').hide();
					}
				},'json');
		} else
			alert('Nome é obrigatório!');
	}
	
	function cadastraDetalhe() {
		if ($('#nome').val() != '') {
				$('.loading').show();
				$.post('ajax/cadastraDetalhe.php', { nome: $('#nome').val() }, function(data){
					if (data.ok)
						mostraDivMenu('detalhes');
					else {
						alert(data.erro);
						$('.loading').hide();
					}
				},'json');
		} else
			alert('Nome é obrigatório!');
	}
	
	function excluirDetalhe(id) {
		$('.loading').show();
		$.post('ajax/excluirDetalhe.php', { id: id }, function(data){
			if (data.ok)
				mostraDivMenu('detalhes');
			else {
				alert(data.erro);
				$('.loading').hide();
			}
		},'json');
	}
</script>

<h1>Detalhes do Imóvel</h1>
<div class="line">
	<div class="busca">
    	<div class="line">
        	<div class="campo" style="width:20%;">
            	<div class="line">
                <label for="nome">Detalhe</label>
                <br />
                <input name="nome" id="nome" type="text">
                <input name="id" id="id" type="hidden" value="">
                </div>
                <div class="line">
                    <input id="botaoCadastra" type="button" onclick="cadastraDetalhe()" value="Salvar" class="">
                    <input id="botaoEdita" type="button" onclick="editaDetalhe()" value="Salvar" class="" style="display: none;">
                </div>
            </div>
            <div class="campo" style="width:10%;"></div>            
            <div class="campo" style="width:50%;">
            	<table border="0" cellspacing="0" cellpadding="0" class="display tableJquery" id="tableJquery">
                    <thead>
                        <tr class="table_titulo">
                            <th class="center" >Detalhe</th>
                            <th class="center" width="180">Ação</th>                      
                        </tr>
                    </thead>
                    <tbody>
                    <?
						foreach($detalhes as $detalhe) {
							echo '<tr class="lines noticia_show odd" >
			                        <td class="center" onclick="getDetalhe('.$detalhe->getId().');">'.$detalhe->getNome().'</td>
			                        <td class="center"><a href="javascript:;" onclick="excluirDetalhe('.$detalhe->getId().');">Excluir</a></td>
			                    </tr>';
			   			}
			   			unset($detalhes, $detalhe);
			   		?> 
                    </tbody>
                </table>
            </div>
        </div>
    </div><!-- //busca -->
</div>