<?php 
include 'pacotes/model/imovel.php';
require_once 'pacotes/dao/LogDAO.php';

class ImovelDAO extends LogDAO{
	
	private $conn;

	function __construct($conn) {
		$this->conn = $conn;
	}
	
	public function getImovel($idimovel) {
		$sql = "SELECT id_rets,
						valor, 
						finalidade, 
						tipo, 
						banheiros, 
						quartos, 
						area, 
						informacoes_adicionais, 
						localizacao,  
						latitude, 
						longitude, 
						data_cad, 
						status, 
						visualizacoes, 
						destaque,
						id_cidade,
						salas_adicionais,
						ar_condicionado,
						estilo_arquitetura,
						nome_edificio,
						andares_edificio,
						andar,
						caracteristicas_comunidade,
						zipcode,
						garagem,
						caracteristicas_garagem,
						dimensoes_garagem,
						faculdades,
						layout_interior,
						caracteristicas_cozinha,
						descricao,
						condicao,
						manutencoes,
						dimensao_lote,
						numero_lote,
						baias,
						escritorios,
						pets,
						quartos_visita,
						estacionamento,
						piscina,
						dimensoes_piscina,
						tipo_piscina,
						zipcode_plus4,
						ano_construcao,
						list_agent,
						list_office 
					FROM imovel WHERE id = $idimovel";
		$stm = $this->conn->prepare($sql);
		if($stm->execute()){
			$row = $stm->fetch();
			$imovel = new Imovel();
			
			$imovel->setId($idimovel);
			$imovel->setId_rets($row['id_rets']);
			$imovel->setValor($row['valor']);
			$imovel->setFinalidade($row['finalidade']);
			$imovel->setTipo($row['tipo']);
			$imovel->setBanheiros($row['banheiros']);
			$imovel->setQuartos($row['quartos']);
			$imovel->setArea($row['area']);
			$imovel->setInformacoes_adicionais($row['informacoes_adicionais']);
			$imovel->setLocalizacao($row['localizacao']);
			$imovel->setLatitude($row['latitude']);
			$imovel->setLongitude($row['longitude']);
			$imovel->setData_cad($row['data_cad']);
			$imovel->setStatus($row['status']);
			$imovel->setVisualizacoes($row['visualizacoes']);
			$imovel->setDestaque($row['destaque']);
			$imovel->setId_cidade($row['id_cidade']);
			$imovel->setImagens($this->getImagens($idimovel));
			$imovel->setDetalhes($this->getDetalhes($idimovel));
			$imovel->setSalas_adicionais($row['salas_adicionais']);
			$imovel->setAr_condicionado($row['ar_condicionado']);
			$imovel->setEstilo_arquitetura($row['estilo_arquitetura']);
			$imovel->setNome_edificio($row['nome_edificio']);
			$imovel->setAndares_edificio($row['andares_edificio']);
			$imovel->setAndar($row['andar']);
			$imovel->setCaracteristicas_comunidade($row['caracteristicas_comunidade']);
			$imovel->setZipcode($row['zipcode']);
			$imovel->setGaragem($row['garagem']);
			$imovel->setCaracteristicas_garagem($row['caracteristicas_garagem']);
			$imovel->setDimensoes_garagem($row['dimensoes_garagem']);
			$imovel->setFaculdades($row['faculdades']);
			$imovel->setLayout_interior($row['layout_interior']);
			$imovel->setCaracteristicas_cozinha($row['caracteristicas_cozinha']);
			$imovel->setDescricao($row['descricao']);
			$imovel->setCondicao($row['condicao']);
			$imovel->setManutencoes($row['manutencoes']);
			$imovel->setDimensao_lote($row['dimensao_lote']);
			$imovel->setNumero_lote($row['numero_lote']);
			$imovel->setBaias($row['baias']);
			$imovel->setEscritorios($row['escritorios']);
			$imovel->setPets($row['pets']);
			$imovel->setQuartos_visita($row['quartos_visita']);
			$imovel->setEstacionamento($row['estacionamento']);
			$imovel->setPiscina($row['piscina']);
			$imovel->setDimensoes_piscina($row['dimensoes_piscina']);
			$imovel->setTipo_piscina($row['tipo_piscina']);
			$imovel->setZipcode_plus4($row['zipcode_plus4']);
			$imovel->setAno_construcao($row['ano_construcao']);
			$imovel->setList_agent($row['list_agent']);
			$imovel->setList_office($row['list_office']);
		}
		unset($idimovel, $stm, $row, $sql);
		return $imovel;
	}
	
	public function getCidade($id) {
		$sql = "SELECT id,
						nome  
					FROM cidade WHERE id = $id";
		$stm = $this->conn->prepare($sql);
		if($stm->execute()){
			$row = $stm->fetch();
			
			$cidade['id'] = $row['id'];
			$cidade['nome'] = $row['nome'];
		}
		unset($id, $stm, $row, $sql);
		return $cidade;
	}
	
	public function getCidades() {
		$sql = "SELECT id,
						nome  
					FROM cidade ORDER BY nome";
		$array = array();
		foreach ($this->conn->query($sql) as $row) {
			$cidade['id'] = $row['id'];
			$cidade['nome'] = $row['nome'];
			
			$array[] = $cidade; 
		}
		unset($cidade, $stm, $row, $sql);
		return $array;
	}
	
	public function setImovel($post, $imagens, $detalhes) {
        $this->conn->beginTransaction();
        
        $sql = "INSERT INTO imovel (valor, finalidade, tipo, banheiros, quartos, area, informacoes_adicionais, localizacao, latitude, longitude, status, destaque, id_cidade)
        								VALUES
        							(?,?,?,?,?,?,?,?,?,?,?,?,?)";
		$stm = $this->conn->prepare($sql);
		$stm->bindValue(1, $post['valor']);
		$stm->bindValue(2, $post['finalidade']);
		$stm->bindValue(3, $post['tipo']);
		$stm->bindValue(4, $post['banheiros']);
		$stm->bindValue(5, $post['quartos']);
		$stm->bindValue(6, $post['area']);
		$stm->bindValue(7, $post['informacoes_adicionais']);
		$stm->bindValue(8, $post['localizacao']);
		$stm->bindValue(9, $post['latitude']);
		$stm->bindValue(10, $post['longitude']);
		$stm->bindValue(11, $post['status']);
		$stm->bindValue(12, $post['destaque']);
		$stm->bindValue(13, $post['id_cidade']);
		
        if (!$stm->execute()) {
			//print_r($stm->errorInfo());
			$this->conn->rollBack();
			unset($post, $sql, $stm);
			return false;
		}
        
		$id_imovel = $this->conn->lastInsertId('imovel_id_seq');
        
        $this->conn->commit();
        
        $this->setImagensImovel($id_imovel, $imagens);
        $this->setDetalhesImovel($id_imovel, $detalhes);
        
		$this->insertLog($id_imovel, 'I', 'imovel', json_encode($post), null, $this->conn);
        
        unset($post, $sql, $id_imovel, $stm, $imagens, $detalhes);
        return true;
    }
    
    public function updateImovel($idimovel, $sql = null, $dadosOld, $dadosNew, $dadosNewImg = null, $dadosNewDet = null){
    	$this->conn->beginTransaction();
    	
		if(!empty($sql)){
			$stm = $this->conn->prepare("UPDATE imovel SET ".$sql." WHERE id = $idimovel");
			if (!$stm->execute()){
				//print_r($stm->errorInfo());
				$this->conn->rollBack();
				unset($stm,$idimovel,$sql);
				return false;
			}
		}
		
		if (count($dadosNewImg) > 0) {
			for ($x = 0; $x < count($dadosNewImg); $x++) {
				$img = $dadosNewImg[$x];
				@unlink(dirname(__FILE__)."/../../images/imovel/".$img['old']);
				
				if ($img['new'] == '') {
					$sql = "DELETE FROM imagem_imovel WHERE id_imovel = $idimovel AND arquivo = '".$img['old']."'";
					$stm = $this->conn->prepare($sql);
					if (!$stm->execute()) {
						//print_r($stm->errorInfo());
						$this->conn->rollBack();
						return false;
					}
				} else {
					if ($img['new'] != '') {
						@copy($_SERVER['DOCUMENT_ROOT']."/tmp/".$img['new'], dirname(__FILE__)."/../../images/imovel/".$img['new']);
						@unlink($_SERVER['DOCUMENT_ROOT']."/tmp/".$img['new']);
	
						if ($img['old']) {	
							$sql = "UPDATE imagem_imovel SET arquivo = '".$img['new']."' WHERE id_imovel = $idimovel AND arquivo = '".$img['old']."'";
						} else {
							$sql = "INSERT INTO imagem_imovel (id_imovel, arquivo, ordem) VALUES ($idimovel, '".$img['new']."', ".($x+1).")";
						}
						$stm = $this->conn->prepare($sql);
						if (!$stm->execute()) {
							//print_r($stm->errorInfo());
							$this->conn->rollBack();
							return false;
						}
					}
				}
			}
		}
		
		
		$sql = "DELETE FROM detalhe_imovel WHERE id_imovel = $idimovel";
		$stm = $this->conn->prepare($sql);
		if (!$stm->execute()) {
			//print_r($stm->errorInfo());
			$this->conn->rollBack();
			return false;
		}
		
		if (count($dadosNewDet) > 0) {
			foreach ($dadosNewDet as $det) {
				$sql = "INSERT INTO detalhe_imovel (id_imovel, id_detalhe) VALUES ($idimovel, $det)";
				$stm = $this->conn->prepare($sql);
				if (!$stm->execute()) {
					//print_r($stm->errorInfo());
					$this->conn->rollBack();
					return false;
				}
			}
		}
		
		$this->conn->commit();
		
		$this->updateLog($idimovel, 'U', 'imovel', json_encode($dadosNew), json_encode($dadosOld), $this->conn);
		unset($stm,$idimovel,$sql,$dadosNew,$dadosOld,$dadosNewImg,$dadosNewDet);
		return true;
	}

	public function deleteImovel($id_imovel) {
		$this->conn->beginTransaction();
    	
		$sql = "DELETE FROM detalhe_imovel WHERE id_imovel = $id_imovel";
		$stm = $this->conn->prepare($sql);
		if (!$stm->execute()) {
			//print_r($stm->errorInfo());
			$this->conn->rollBack();
			return false;
		}
		
		$sql = "SELECT arquivo FROM imagem_imovel WHERE id_imovel = $id_imovel";
		$stm = $this->conn->prepare($sql);
		$stm->execute();
		foreach ($stm->fetchAll() as $row){
			@unlink(dirname(__FILE__)."/../../images/imovel/".$row['arquivo']);
			unset($row);
		}
		
		$sql = "DELETE FROM imagem_imovel WHERE id_imovel = $id_imovel";
		$stm = $this->conn->prepare($sql);
		if (!$stm->execute()) {
			//print_r($stm->errorInfo());
			$this->conn->rollBack();
			unset($stm,$id_imovel,$sql);
			return false;
		}
		
		$sql = "DELETE FROM imovel WHERE id = $id_imovel";
		$stm = $this->conn->prepare($sql);
		if (!$stm->execute()){
			//print_r($stm->errorInfo());
			$this->conn->rollBack();
			unset($stm,$id_imovel,$sql);
			return false;
		}
		
		$this->conn->commit();
		unset($stm,$id_imovel,$sql,$row);
		return true;
	}

	public function setImagensImovel($id_imovel, $imagens, $edit = false) {
		$ordem = 1;
		$this->conn->beginTransaction();
		
		foreach ($imagens as $img) {
			@copy($_SERVER['DOCUMENT_ROOT']."/tmp/".$img, dirname(__FILE__)."/../../images/imovel/".$img);
			@unlink($_SERVER['DOCUMENT_ROOT']."/tmp/".$img);
			
			$sql = "INSERT INTO imagem_imovel (arquivo, id_imovel, ordem) VALUES (?,?,?)";
			$stm = $this->conn->prepare($sql);
			$stm->bindParam(1, $img);
			$stm->bindParam(2, $id_imovel);
			$stm->bindParam(3, $ordem);
			
		    if (!$stm->execute()) {
				//print_r($stm->errorInfo());
				$this->conn->rollBack();
				unset($post, $sql, $stm);
				return false;
			}
			
			$ordem++;
		}
		
		unset($id_imovel, $imagens, $img, $ordem, $sql, $stm);
		$this->conn->commit();
		return true;
	}
	
	public function setDetalhesImovel($id_imovel, $detalhes) {
		$this->conn->beginTransaction();
		
		foreach ($detalhes as $det) {
			$sql = "INSERT INTO detalhe_imovel (id_detalhe, id_imovel) VALUES (?,?)";
			$stm = $this->conn->prepare($sql);
			$stm->bindParam(1, $det);
			$stm->bindParam(2, $id_imovel);
			
		    if (!$stm->execute()) {
				//print_r($stm->errorInfo());
				$this->conn->rollBack();
				unset($post, $sql, $stm);
				return false;
			}
		}
		
		unset($id_imovel, $detalhes, $det, $sql, $stm);
		$this->conn->commit();
		return true;
	}

	public function pesquisaImovel($busca, $ordem, $limite, $offset) {
		$arrayList = array();
		
		if ($ordem)
			$ordem = "ORDER BY $ordem";
			
		if ($limite)
			$limite = "LIMIT $limite";
		
		if ($offset)
			$offset = "OFFSET $offset";
		
		$sql = "SELECT imovel.id FROM imovel $busca $ordem $limite $offset";
		
		$stm = $this->conn->prepare($sql);
		$stm->execute();
		
		foreach ($stm->fetchAll() as $row){
			$arrayList[] = $this->getImovel($row['id']);
			unset($row);
		}
		unset($busca,$limite,$sql,$stm,$row);
		return $arrayList;
	}
	
	public function countPesquisaImovel($busca) {
		$ret = false;
		
		$sql = "SELECT count(id) AS cont FROM imovel $busca";
		$stm = $this->conn->prepare($sql);
		if($stm->execute()){
			$row = $stm->fetch();

			$ret = $row['cont'];
		}
		
		unset($busca,$sql,$stm,$row);
		return $ret;
	}

	public function getImagens($idimovel){
		$arrayList = array();
		
		$sql = "SELECT arquivo FROM imagem_imovel WHERE id_imovel = $idimovel ORDER BY ordem ASC";
		foreach ($this->conn->query($sql) as $row) {
			$arrayList[] = $row['arquivo'];
			unset($row);
		}
		unset($idimovel, $stm, $row, $sql);
		
		if(count($arrayList) == 0)
			$arrayList = '';
			
		return $arrayList;
	}

	public function getDetalhes($idimovel){
		$arrayList = array();
		
		$sql = "SELECT id_detalhe FROM detalhe_imovel WHERE id_imovel = $idimovel ORDER BY id_detalhe ASC";
		foreach ($this->conn->query($sql) as $row) {
			$arrayList[] = $row['id_detalhe'];
			unset($row);
		}
		unset($idimovel, $stm, $row, $sql);
		
		if(count($arrayList) == 0)
			$arrayList = '';
			
		return $arrayList;
	}

	public function getNomeCidade($idcidade) {
		$ret = false;
		
		$sql = "SELECT nome FROM cidade WHERE id = $idcidade";
		$stm = $this->conn->prepare($sql);
		if($stm->execute()){
			$row = $stm->fetch();

			$ret = $row['nome'];
		}
		
		unset($idcidade,$sql,$stm,$row);
		return $ret;
	}
	
	function __destruct() {
		unset ( $this->conn );
	}
}

?>