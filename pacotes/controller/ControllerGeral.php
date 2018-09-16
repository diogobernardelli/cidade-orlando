<?php
require_once dirname ( __FILE__ ) . '/../conector/PDOConnectionFactory.php';
/**
 * @author Eduardo
 * @desc Classe que contém as funções genéricas do sistema. 
 */
abstract class ControllerGeral extends PDOConnectionFactory {
	
	protected $conn;
	private $phpmail;
	
	public function __construct() {
		$this->conn = parent::getConnection ();
	}
	
    public function is_valid_cpf($cpf) {
		for($i = 0; $i < 10; $i ++) {
			if ($cpf == str_repeat ( $i, 11 ) or ! preg_match ( "@^[0-9]{11}$@", $cpf ) or $cpf == "12345678909")
				return false;
			if ($i < 9)
				$soma [] = $cpf {$i} * (10 - $i);
			$soma2 [] = $cpf {$i} * (11 - $i);
		}
		if (((array_sum ( $soma ) % 11) < 2 ? 0 : 11 - (array_sum ( $soma ) % 11)) != $cpf {9})
			return false;
			
		return (((array_sum ( $soma2 ) % 11) < 2 ? 0 : 11 - (array_sum ( $soma2 ) % 11)) != $cpf {10}) ? false : true;
		
	}
	
	public function is_valid_cnpj($cnpj){
		for ($t = 12; $t < 14; $t++) {
			for ($d = 0, $p = $t - 7, $c = 0; $c < $t; $c++) {
				$d += $cnpj[$c] * $p;
				$p   = ($p < 3) ? 9 : --$p;
			}
			$d = ((10 * $d) % 11) % 10;
			if ($cnpj[$c] != $d) {
				return false;
			}
		}
		return true;
	}

	/*
	 * função que retira todos os caracteres que nao sao numeros
	 */
	public function soNumero($string) {
		return preg_replace ( "/[^0-9]/", '', $string );
	}
	
	public function geraSenha($length = 6) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, strlen($characters) - 1)];
		}
		return md5($randomString."_".substr($randomString, -3));
	}
	
	/**
	 * @param string $string
	 * @desc Método que previne contra sql injection.
	 */
	function noInjection($string) {
		//$order = array ("/(from|select|or|insert|delete|where|drop table|show tables|#|\*|--|\\\\)/" );
		//str_replace ( $order, '', $string );
		$string = preg_replace(sql_regcase("/(from |select |or |insert |delete |where |drop table|show tables|#|\*|--|\\\\)/"),"",$string);
		$string = trim ( $string ); //limpa espaços vazio
		$string = strip_tags ( $string ); //tira tags html e php
		$string = addslashes ( $string ); //Adiciona barras invertidas a uma string
		return $string;
	}

	private function enviaEmail($maildest, $html, $assunto, $grpid) {
		if (count ( $maildest ) > 0) {
			$i = 0;
			foreach ( $maildest as $user ) {
				if ($user ['frota'] == true) {
					$i ++;
				}
			}
			if ($i > 0) {
				$this->phpmail = new PHPMailer ();
				
				$this->phpmail->isSMTP ();
				
				// Configuração de SMTP
				$this->phpmail->Host = "ssl://smtp.gmail.com";
				$this->phpmail->SMTPAuth = true;
				//$this->phpmail->SMTPDebug = true;
				$this->phpmail->Port = 465;
				$this->phpmail->Username = "EMAIL";
				$this->phpmail->Password = "SENHA";
				
				// Remetente da mensagem
				$this->phpmail->From = $this->phpmail->Username;
				//$this->phpmail->FromName = $this->getRastreadora($grpid);
				$this->phpmail->FromName = $this->phpmail->Username;
				
				// Destinatario do email
				foreach ( $maildest as $user ) {
					if ($user ['frota'] == true) {
						$this->phpmail->AddAddress ( $user ['email'], $user ['nome'] );
					}
				}
				// Iremos enviar o email no formato HTML
				$this->phpmail->IsHTML ( true );
				
				// Assunto e Corpo do email
				$this->phpmail->Subject = $assunto;
				$this->phpmail->Body = $html;
				
				$this->phpmail->Send ();
			
			}
		}
	
	}
	
	public function __destruct() {
		$this->conn = parent::__destruct ();
		unset ( $this->conn, $this->phpmail );
	}
   
}

class ControllerFunctions extends ControllerGeral {

}

?>