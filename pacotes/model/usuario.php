<?php 
/**
 * @author Eduardo
 *
 */
class Usuario {
	
	private $id,
			$nome,
			$email,
			$senha,
			$status;
	
	public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getNome(){
		return $this->nome;
	}

	public function setNome($nome){
		$this->nome = $nome;
	}

	public function getEmail(){
		return $this->email;
	}

	public function setEmail($email){
		$this->email = $email;
	}

	public function getSenha(){
		return $this->senha;
	}

	public function setSenha($senha){
		$this->senha = $senha;
	}
	
	public function getStatus(){
		return $this->status;
	}

	public function setStatus($status){
		$this->status = $status;
	}

	function __destruct(){
		unset($this->id,
			$this->nome,
			$this->email,
			$this->senha,
			$this->status);
	}
}
?>