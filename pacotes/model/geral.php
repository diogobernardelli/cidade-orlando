<?php 

/** 
 * @author Eduardo
 * 
 * 
 */
class Geral {
	
	private $email1,
			$email2,
			$telefone1,
			$telefone2,
			$skype,
			$endereco;

	public function getEmail1(){
		return $this->email1;
	}

	public function setEmail1($email1){
		$this->email1 = $email1;
	}
	
	public function getEmail2(){
		return $this->email2;
	}

	public function setEmail2($email2){
		$this->email2 = $email2;
	}

	public function getTelefone1(){
		return $this->telefone1;
	}

	public function setTelefone1($telefone1){
		$this->telefone1 = $telefone1;
	}
	
	public function getTelefone2(){
		return $this->telefone2;
	}

	public function setTelefone2($telefone2){
		$this->telefone2 = $telefone2;
	}

	public function getSkype(){
		return $this->skype;
	}

	public function setSkype($skype){
		$this->skype = $skype;
	}

	public function getEndereco(){
		return $this->endereco;
	}

	public function setEndereco($endereco){
		$this->endereco = $endereco;
	}
	
	function __destruct() {
	 unset($this->email1,
			$this->email2,
			$this->telefone1,
			$this->telefone2,
			$this->skype,
			$this->endereco);
	}
}

?>