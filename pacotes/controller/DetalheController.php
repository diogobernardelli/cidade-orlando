<?php 
require_once ('pacotes/controller/ControllerGeral.php');
require_once ('pacotes/dao/DetalheDAO.php');

/** 
 * @author Eduardo
 * 
 * 
 */
class DetalheController extends ControllerGeral {
	private $DetalheDAO;
	
	function __construct() {
		parent::__construct ();
		$this->DetalheDAO = new DetalheDAO ( $this->conn );
	}
	
	public function getDetalhe($id) {
		return $this->DetalheDAO->getDetalhe($id);
	}

    public function setDetalhe($post) {
		return $this->DetalheDAO->setDetalhe($post);
	}
   
	public function updateDetalhe($iddetalhe, $dadosNew){
        $valores = array();
		foreach($dadosNew as $chave => $val) {
			if ($val != '') {
				$valores[] = $chave." = '".addslashes($val)."'";
			} 
		} 
		$valores = implode(",", $valores);
		
		return $this->DetalheDAO->updateDetalhe($iddetalhe, $valores, $dadosNew);
	}
	
	public function deleteDetalhe($iddetalhe) {
		return $this->DetalheDAO->deleteDetalhe($iddetalhe);
	}
	
	public function listDetalhes() {
		return $this->DetalheDAO->listDetalhes();
	}
	
	function __destruct() {
		parent::__destruct ();
		unset ( $this->DetalheDAO );
	}
}

?>