<?php 
include 'pacotes/model/detalhe.php';
require_once 'pacotes/dao/LogDAO.php';

class DetalheDAO extends LogDAO{
	
	private $conn;

	function __construct($conn) {
		$this->conn = $conn;
	}
	
	public function getDetalhe($iddetalhe){
		$sql = "SELECT nome, status FROM detalhe WHERE id = $iddetalhe";
		$stm = $this->conn->prepare($sql);
		if($stm->execute()){
			$row = $stm->fetch();
			$detalhe = new Detalhe();
			
			$detalhe->setId($iddetalhe);
			$detalhe->setNome($row['nome']);
			$detalhe->setStatus($row['status']);
		}
		unset($iddetalhe, $stm, $row, $sql);
		return $detalhe;
	}
		
	public function setDetalhe($post){
		$stm = $this->conn->prepare("INSERT INTO detalhe (nome, status) VALUES (?,?)");
		$stm->bindParam(1, $post['nome']);
		$stm->bindParam(2, $post['status']);

		if (!$stm->execute()) {
			//print_r($stm->errorInfo());
			unset($post,$stm);
			return false;
		}
		
		$iddetalhe = $this->conn->lastInsertId('detalhe_id_seq');
		$this->insertLog($iddetalhe, 'I', 'detalhe', json_encode($post), null, $this->conn);
		
		unset($post,$stm);
		
		return true;
	}
	
	public function updateDetalhe($iddetalhe, $sql, $dadosNew){
		if(!empty($sql)){
			$stm = $this->conn->prepare("UPDATE detalhe SET ".$sql." WHERE id = $iddetalhe");
			if (!$stm->execute()){
				//print_r($stm->errorInfo());
				unset($stm,$iddetalhe,$sql);
				return false;
			}
		}
		
		//$this->updateLog($iddetalhe, 'U', 'detalhe', json_encode($dadosNew), json_encode($dadosOld), $this->conn);
		unset($stm,$iddetalhe,$sql,$dadosNew);
		return true;
	}
	
	public function deleteDetalhe($iddetalhe){
		$stm = $this->conn->prepare("DELETE FROM detalhe WHERE id = $iddetalhe");
		if (!$stm->execute()){
			//print_r($stm->errorInfo());
			unset($stm,$iddetalhe);
			return false;
		}

		$stm = $this->conn->prepare("DELETE FROM imovel_detalhe WHERE id_detalhe = $iddetalhe");
		if (!$stm->execute()){
			//print_r($stm->errorInfo());
			unset($stm,$iddetalhe);
			return false;
		}
		
		$this->insertLog($iddetalhe, 'D', 'detalhe', null, null, $this->conn);
		unset($stm,$iddetalhe);
		return true;
	}
	
	public function listDetalhes() {
		$arrayList = array();

		$sql = "SELECT id FROM detalhe ORDER BY id";
		$stm = $this->conn->prepare($sql);
		$stm->execute();
		
		foreach ($stm->fetchAll() as $row){
			$arrayList[] = $this->getDetalhe($row['id']);
			unset($row);
		}
		unset($sql,$stm,$row);
		return $arrayList;
	}
	
	function __destruct() {
		unset ( $this->conn );
	}
}

?>