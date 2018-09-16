<?php 
include 'pacotes/model/geral.php';
require_once 'pacotes/dao/LogDAO.php';

class GeralDAO extends LogDAO{
	
	private $conn;

	function __construct($conn) {
		$this->conn = $conn;
	}
	
	public function getGeral() {
		$sql = "SELECT email1, 
						email2, 
						telefone1, 
						telefone2, 
						skype, 
						endereco 
					FROM geral";
		$stm = $this->conn->prepare($sql);
		if($stm->execute()){
			$row = $stm->fetch();
			$geral = new Geral();

			$geral->setEmail1($row['email1']);
			$geral->setEmail2($row['email2']);
			$geral->setTelefone1($row['telefone1']);
			$geral->setTelefone2($row['telefone2']);
			$geral->setSkype($row['skype']);
			$geral->setEndereco($row['endereco']);
		}
		unset($stm, $row, $sql);
		return $geral;
	}
	    
    public function updateGeral($sql = null){
		if(!empty($sql)){
			$stm = $this->conn->prepare("UPDATE geral SET ".$sql);
			if (!$stm->execute()){
				//print_r($stm->errorInfo());
				unset($stm,$sql);
				return false;
			}
		}
		
		unset($stm,$sql);
		return true;
	}
	
	function __destruct() {
		unset ( $this->conn );
	}
}

?>