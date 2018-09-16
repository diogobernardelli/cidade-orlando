<?php
@session_start();
/** 
 * @author Eduardo
 * 
 * 
 */
abstract class LogDAO {
	
	/**
	 * 
	 */
	protected function insertLog($idreg,$acao,$tbl,$dadosNew,$logPai=null,PDO $con){
		if ($_SESSION['ga']['admin']) {
			$campo = 'user_id';
		} else {
			$campo = 'anunciante_id';
		}
		$stm=$con->prepare("INSERT INTO log ($campo,reg_id,ip,acao,dados_new,tabela,user_nome,log_pai_id) VALUES (?,?,?,?,?,?,?,?)");
		$stm->bindParam(1, $_SESSION['ga']['id']);
		$stm->bindParam(2, $idreg);
		$stm->bindParam(3, $_SERVER['REMOTE_ADDR']);
		$stm->bindParam(4, $acao);
		$stm->bindParam(5, $dadosNew);
		$stm->bindParam(6, $tbl);
		$stm->bindParam(7, $_SESSION['ga']['nome']);
		$stm->bindParam(8, $logPai);
		$stm->execute();
		$idlog = $con->lastInsertId('log_id_seq');
		$con=null;
		unset($stm,$con,$idreg,$acao,$tbl,$dadosNew,$logPai);
		return $idlog;
	}
	protected function updateLog($idreg,$acao,$tbl,$dadosNew,$dadosOld,PDO $con,$logPai=null){
		if ($_SESSION['ga']['admin']) {
			$campo = 'user_id';
		} else {
			$campo = 'anunciante_id';
		}
		$stm=$con->prepare("INSERT INTO log ($campo,reg_id,ip,acao,dados_new,tabela,user_nome,dados_old,log_pai_id) VALUES (?,?,?,?,?,?,?,?,?)");
		$stm->bindParam(1, $_SESSION['ga']['id']);
		$stm->bindParam(2, $idreg);
		$stm->bindParam(3, $_SERVER['REMOTE_ADDR']);
		$stm->bindParam(4, $acao);
		$stm->bindParam(5, $dadosNew);
		$stm->bindParam(6, $tbl);
		$stm->bindParam(7, $_SESSION['ga']['nome']);
		$stm->bindParam(8, $dadosOld);
		$stm->bindParam(9, $logPai);
		$stm->execute();
		$idlog = $con->lastInsertId('log_id_seq');
		$con=null;
		unset($stm,$con,$idreg,$acao,$tbl,$dadosNew,$logPai);
		return $idlog;
	}
}

?>