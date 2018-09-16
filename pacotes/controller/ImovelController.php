<?php 
include 'pacotes/dao/ImovelDAO.php';
require_once 'pacotes/controller/ControllerGeral.php';
/**
 * @desc Classe para controlar os Imóveis
 * @author Eduardo
 *
 */

class ImovelController extends ControllerGeral{
	
	private $ImovelDAO;
	
	function __construct() {
		parent::__construct();
	    $this->ImovelDAO = new ImovelDAO($this->conn);
	}
	
	public function getImovel($id) {
		return $this->ImovelDAO->getImovel($id);
	}
	
	public function getCidade($id) {
		return $this->ImovelDAO->getCidade($id);
	}
	
	public function getCidades() {
		return $this->ImovelDAO->getCidades();
	}
	
	public function setImovel($post, $imagens, $detalhes){
		return $this->ImovelDAO->setImovel($post, $imagens, $detalhes);
	}
	
	public function updateImovel($idimovel, $dadosNew, $dadosNewImg, $dadosNewDet, $dadosOld){
		$valores = array();
		foreach($dadosNew as $chave => $val) {
			if ($val != '') {
				$valores[] = $chave." = '".addslashes($val)."'";
			} 
		} 
		$valores = implode(",", $valores);
		
		return $this->ImovelDAO->updateImovel($idimovel, $valores, $dadosOld, $dadosNew, $dadosNewImg, $dadosNewDet);
	}
	
	public function deleteImovel($idimovel){
		return $this->ImovelDAO->deleteImovel($idimovel);
	}
	
	public function pesquisaImovel($busca = null, $ordem = null, $limite = null, $offset = null) {
		return $this->ImovelDAO->pesquisaImovel($this->montaSql($busca), $ordem, $limite, $offset);
	}
	
	public function countPesquisaImovel($busca = null) {
		return $this->ImovelDAO->countPesquisaImovel($this->montaSql($busca));
	}
	
	public function montaSql($busca) {
		$filtro=array();
		$sql=null;

		if(!empty($busca['id'])){
            $filtro[] = "imovel.id = " . $busca ['id'];
        }
		if(!empty($busca['id_in'])){
            $filtro[] = "imovel.id IN (" . $busca ['id_in'] . ")";
        }
        if(!empty($busca['id_not_in'])){
            $filtro[] = "imovel.id NOT IN (" . $busca ['id_not_in'] . ")";
        }
        if(!empty($busca['valor'])){
            $filtro[] = "imovel.valor = " . preg_replace( '/[^0-9]/', '', $busca['valor'] );
        }
        if(!empty($busca['valor_de'])){
            $filtro[] = "imovel.valor >= " . preg_replace( '/[^0-9]/', '', $busca['valor_de'] );
        }
        if(!empty($busca['valor_ate'])){
            $filtro[] = "imovel.valor <= " . preg_replace( '/[^0-9]/', '', $busca['valor_ate'] );
        }
        if(!empty($busca['valor_entre'])){
            $filtro[] = "(imovel.valor BETWEEN " . $busca ['valor_entre'] . ")";
        }
        if(!empty($busca['finalidade'])){
            $filtro[] = "imovel.finalidade = '" . $busca ['finalidade'] . "'";
        }
        if(!empty($busca['aluguel']) && !empty($busca['venda'])){
            $filtro[] = "(imovel.finalidade = '" . $busca ['aluguel'] . "' OR imovel.finalidade = '" . $busca ['venda'] . "')";
        } else if (!empty($busca['aluguel'])) {
        	$filtro[] = "imovel.finalidade = '" . $busca ['aluguel'] . "'";
        } else if (!empty($busca['venda'])) {
        	$filtro[] = "imovel.finalidade = '" . $busca ['venda'] . "'";
        }
        if(!empty($busca['tipo'])){
            $filtro[] = "imovel.tipo = '" . $busca ['tipo'] . "'";
        }
        if(!empty($busca['zipcode'])){
            $filtro[] = "imovel.zipcode = " . $busca ['zipcode'];
        }
		if(!empty($busca['banheiros'])){
			if (is_numeric($busca['banheiros']))
            	$filtro[] = "imovel.banheiros = " . $busca ['banheiros'];
  			else
  				$filtro[] = "imovel.banheiros > 5";
        }
		if(!empty($busca['quartos'])){
			if (is_numeric($busca['quartos']))
           		$filtro[] = "imovel.quartos = " . $busca ['quartos'];
 			else
  				$filtro[] = "imovel.quartos > 5";
        }
        if(!empty($busca['area'])){
            $filtro[] = "imovel.area = " . $busca ['area'];
        }
        if(!empty($busca['status'])){
            $filtro[] = "imovel.status = '" . $busca ['status'] ."'";
        }
        if(!empty($busca['destaque'])){
            $filtro[] = "imovel.destaque = '" . $busca ['destaque'] ."'";
        }
        if(!empty($busca['localizacao'])){
            $filtro[] = "imovel.localizacao ILIKE '%" . $busca ['localizacao'] ."%'";
        }
        if(!empty($busca['id_cidade'])){
            $filtro[] = "imovel.id_cidade = " . $busca ['id_cidade'];
        }
		if(!empty($busca['mapa'])){
			$filtro[] = "imovel.latitude IS NOT NULL";
			$filtro[] = "imovel.longitude IS NOT NULL";
		}
        
		if(count($filtro) > 0){
  			$sql = ' WHERE '.implode(' AND ', $filtro);
        }
        return $sql;
	}
	
	function getNomeCidade($idcidade) {
		return $this->ImovelDAO->getNomeCidade($idcidade);
	}
	
	function __destruct(){
		parent::__destruct();
		unset($this->ImovelDAO);
	}
	
}