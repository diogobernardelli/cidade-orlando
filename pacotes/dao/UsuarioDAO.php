<?php
require_once 'pacotes/model/usuario.php';
require_once 'pacotes/dao/LogDAO.php';
/** 
 * @author Eduardo
 * 
 * 
 */
class UsuarioDAO extends LogDAO{
	
	private $conn;
	
	function __construct($con) {
		$this->conn = $con;
	}
	
	public function consultaLoginSenha($login, $senha) {
		try {
			$stm = $this->conn->prepare ( "SELECT id FROM usuario
											WHERE email = ?
												AND senha = ?
												AND status IS TRUE" );
			$stm->bindParam ( 1, $login );
			$stm->bindParam ( 2, $senha );
			$stm->execute ();
			$result = $stm->fetch ();
			if ($result['id'])
				$result = $result['id'];

		} catch ( PDOException $e ) {
			throw new PDOException ( "Erro ao efetuar o login!" );
			return false;
		}
		unset ( $stm, $login, $senha );
		return $result;
	}

	public function getRetsLastUpdate() {
		$stm = $this->conn->prepare ( "SELECT atualizacao FROM geral" );
		$stm->execute ();
		$result = $stm->fetch ();
		if ($result['atualizacao'])
			$result = $result['atualizacao'];
		else
			$result = false;

		unset ( $stm  );
		return $result;
	}

	public function alteraSenha($senha, $id) {
		$stm = $this->conn->prepare ( "UPDATE usuario SET senha = ? WHERE id = ?" );
		$stm->bindParam ( 1, $senha );
		$stm->bindParam ( 2, $id );
		
		if ($stm->execute ()) {
			unset ( $stm, $id, $senha );
			return true;
		} else {
			unset ( $stm, $id, $senha );
			return false;
		}
	}
	
	function __destruct() {
		unset ( $this->conn );
	}
}
?>