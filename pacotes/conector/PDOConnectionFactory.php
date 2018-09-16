<?php
/** 
 * @author Eduardo
 * 
 * 
 */
abstract class PDOConnectionFactory {

	  private $con,
			  $dbType,
			  $host,
			  $user,
			  $senha,
			  $db,
			  $persistent;
	  
	function __construct() {
     
	}
	
	private function setParametros(){
		$this->persistent = false;
		$this->con = null;
		$this->dbType = "pgsql";
		// $this->host = "localhost";
		$this->host = "149.56.0.64";
		$this->port = "5432";
		$this->user = "cidadeor_cidadeor";
		$this->senha = "Y0Ssn99f9e";
		$this->db = "cidadeor_cidadeorlando";
	}
      

      public function getConnection(){
       $this->setParametros();
      try{
            // $this->con = new PDO($this->dbType.":host=".$this->host.";dbname=".$this->db, $this->user, $this->senha,
            $this->con = new PDO($this->dbType.":host=".$this->host.";port=".$this->port.";dbname=".$this->db, $this->user, $this->senha,
      			array( PDO::ATTR_PERSISTENT => $this->persistent ) );
      		
      			
      	}catch ( PDOException $ex ){ 
      		$ex = new PDOException('Erro de Conexão com BD!!');
      		echo "Erro: ".$ex->getMessage();
      		exit;
      	}
      	return $this->con;
      }

      public function Close(){
      		if( $this->con != null )
      				$this->con = null;
      }
	
	
	function __destruct() {
		$this->Close();
	    unset($this->con,
	    $this->db,
	    $this->dbType,
		$this->host,
		$this->port,
	    $this->persistent,
	    $this->senha,
	    $this->user);
	}
}
?>
