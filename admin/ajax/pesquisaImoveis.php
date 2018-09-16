<?php
ini_set('display_errors','Off');
chdir('../../');
require_once 'pacotes/controller/ImovelController.php';
$imovelcontrol = new ImovelController();

$busca['local'] = ($_GET['local']!='')?$_GET['local']:'';
$busca['tipo'] = ($_GET['tipo']!='')?$_GET['tipo']:'';
$busca['finalidade'] = ($_GET['finalidade']!='')?$_GET['finalidade']:'';
$busca['status'] = ($_GET['status']!='')?$_GET['status']:'';

$busca = $imovelcontrol->pesquisaImovel($busca, 'id DESC');

$html = '<table border="0" cellspacing="0" cellpadding="0" class="display tableJquery" id="tableJquery">
                <thead>
                    <tr class="table_titulo">
                        <th>Local</th>
                        <th class="center" width="180">Tipo</th>
                        <th class="center" width="200">Finalidade</th>
                        <th class="center" width="120">Status</th>
						<th class="center" width="120">Ações</th>     
                    </tr>
                </thead>
                <tbody>';
                      
foreach ($busca as $imovel) {
	if ($imovel->getStatus())
		$status = 'Ativo';
	else
		$status = 'Inativo';
		
	$html .= '<tr class="lines noticia_show odd" id="aaa" >
                    <td onclick="getImovel('.$imovel->getId().');" class="center">'.$imovel->getLocalizacao().'</td>
                    <td onclick="getImovel('.$imovel->getId().');" class="center">'.$imovel->getTipo().'</td>
                    <td onclick="getImovel('.$imovel->getId().');" class="center">'.$imovel->getFinalidade().'</td>
                    <td onclick="getImovel('.$imovel->getId().');" class="center">'.$status.'</td>
					<td class="center"><a href="javascript:;" onclick="showExcluirImovel('.$imovel->getId().');">Excluir</a></td>
                </tr>';
}

$html .= '</tbody>
            </table>
			
			<script type="text/javascript">
				$("#tableJquery").dataTable( {
					"sPaginationType": "full_numbers",
					"oLanguage": {
						"sLengthMenu": "Exibir _MENU_ resultados",
						"sZeroRecords": "Nenhum resultado encontrado",
						"sInfo": "Exibindo <strong>_START_</strong> até <strong>_END_</strong> de <strong>_TOTAL_</strong> resultados",
						"sInfoEmpty": "Exibindo <strong>0</strong> até <strong>0</strong> de <strong>0</strong> resultados",
						"sInfoFiltered": "(filtrado de um total de <strong>_MAX_</strong> resultados)"
					}
				});
			</script>';

echo json_encode(array("html"=>$html));

unset($imovelcontrol, $_GET, $busca, $imovel, $status);
?>