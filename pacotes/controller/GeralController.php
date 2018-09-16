<?php
require_once 'pacotes/dao/GeralDAO.php';
require_once 'pacotes/controller/ControllerGeral.php';

/**
 * @author Eduardo
 * @desc Classe Geral
 */
 
class GeralController extends ControllerGeral {
	private $GeralDAO;
	
	public function __construct() {
		parent::__construct ();
		$this->GeralDAO = new GeralDAO ( $this->conn );
	}
	
	public function getGeral() {
		return $this->GeralDAO->getGeral();
	}
   
	public function updateGeral($dadosNew){
        $valores = array();
		foreach($dadosNew as $chave => $val) {
			if ($val != '') {
				$valores[] = $chave." = '".addslashes($val)."'";
			} else {
				$valores[] = $chave." = null";
			}
		} 
		$valores = implode(",", $valores);
		
		return $this->GeralDAO->updateGeral($valores);
	}
	
    function __destruct() {
		parent::__destruct ();
		unset ( $this->NewsletterDAO );
	}

}
?>