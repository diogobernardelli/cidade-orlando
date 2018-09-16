<?php 
include 'pacotes/dao/UsuarioDAO.php';
require_once 'pacotes/controller/ControllerGeral.php';
/**
 * @desc Classe para controlar os Usuarios
 * @author Eduardo
 *
 */

class UsuarioController extends ControllerGeral{
	
	private $UsuarioDAO;
	
	function __construct() {
		parent::__construct();
	    $this->UsuarioDAO = new UsuarioDAO($this->conn);
	}
	
	function login($post) {
		if (isset ( $post ['login'] ) and isset ( $post ['senha'] )) {
			$login = $post['login'];
			$senha = md5 ( $post['senha'] . "_" . substr ( $post['senha'], -3 ) );
			
			$usuario = $this->UsuarioDAO->consultaLoginSenha ( $login, $senha );
			
			if ($usuario == false) {
				return false;
			} else {
				return $usuario;
			}
		
		} else {
			return false;
		}
	}

	public function getRetsLastUpdate() {
		return $this->UsuarioDAO->getRetsLastUpdate();
	}

	public function alteraSenha($senha, $id) {
		$senha = md5 ( $senha . "_" . substr ( $senha, -3 ) );
		return $this->UsuarioDAO->alteraSenha($senha, $id);
	}
		
	function __destruct(){
		parent::__destruct();
		unset ( $this->UsuarioDAO );
	}
	
}