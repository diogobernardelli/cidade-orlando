<?php 
/**
 * @author Eduardo
 *
 */
class Detalhe {
	
	private $id,
			$nome,
			$status;
		
	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
	}

	public function getNome() {
		return $this->nome;
	}
	public function setNome($nome) {
		$this->nome = $nome;
	}
	
	public function getStatus() {
		return $this->status;
	}
	public function setStatus($status) {
		$this->status = $status;
	}
			
	function __destruct(){
		unset($this->id,
			$this->nome,
			$this->status);
	}

}
?>