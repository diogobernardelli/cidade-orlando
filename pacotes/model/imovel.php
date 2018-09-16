<?php 
/**
 * @author Eduardo
 *
 */
class Imovel {
	
	private $id,
			$id_rets,
			$valor,
			$finalidade,
			$tipo,
			$banheiros,
			$quartos,
			$area,
			$informacoes_adicionais,
			$localizacao, 
			$latitude,
			$longitude,
			$data_cad,
			$status,
			$visualizacoes,
			$destaque,
			$id_cidade,
			$imagens,
			$detalhes,
			$salas_adicionais,
			$ar_condicionado,
			$estilo_arquitetura,
			$nome_edificio,
			$andares_edificio,
			$andar,
			$caracteristicas_comunidade,
			$zipcode,
			$garagem,
			$caracteristicas_garagem,
			$dimensoes_garagem,
			$faculdades,
			$layout_interior,
			$caracteristicas_cozinha,
			$descricao,
			$condicao,
			$manutencoes,
			$dimensao_lote,
			$numero_lote,
			$baias,
			$escritorios,
			$pets,
			$quartos_visita,
			$estacionamento,
			$piscina,
			$dimensoes_piscina,
			$tipo_piscina,
			$zipcode_plus4,
			$ano_construcao,
			$list_agent,
			$list_office;

	public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getId_rets(){
		return $this->id_rets;
	}

	public function setId_rets($id_rets){
		$this->id_rets = $id_rets;
	}
	
	public function getValor(){
		return $this->valor;
	}

	public function setValor($valor){
		$this->valor = $valor;
	}

	public function getFinalidade(){
		return $this->finalidade;
	}
	
	public function setFinalidade($finalidade) {
		$this->finalidade = $finalidade;
	}

	public function getTipo(){
		return $this->tipo;
	}

	public function setTipo($tipo){
		$this->tipo = $tipo;
	}

	public function getBanheiros(){
		return $this->banheiros;
	}

	public function setBanheiros($banheiros){
		$this->banheiros = $banheiros;
	}
	
	public function getQuartos(){
		return $this->quartos;
	}

	public function setQuartos($quartos){
		$this->quartos = $quartos;
	}
	
	public function getArea(){
		return $this->area;
	}

	public function setArea($area){
		$this->area = $area;
	}

	public function getInformacoes_adicionais(){
		return $this->informacoes_adicionais;
	}

	public function setInformacoes_adicionais($informacoes_adicionais){
		$this->informacoes_adicionais = $informacoes_adicionais;
	}

	public function getLocalizacao(){
		return $this->localizacao;
	}

	public function setLocalizacao($localizacao){
		$this->localizacao = $localizacao;
	}

	public function getLatitude(){
		return $this->latitude;
	}

	public function setLatitude($latitude){
		$this->latitude = $latitude;
	}

	public function getLongitude(){
		return $this->longitude;
	}

	public function setLongitude($longitude){
		$this->longitude = $longitude;
	}

	public function getData_cad(){
		return $this->data_cad;
	}

	public function setData_cad($data_cad){
		$this->data_cad = $data_cad;
	}

	public function getStatus(){
		return $this->status;
	}

	public function setStatus($status){
		$this->status = $status;
	}
	
	public function getVisualizacoes(){
		return $this->visualizacoes;
	}

	public function setVisualizacoes($visualizacoes){
		$this->visualizacoes = $visualizacoes;
	}
	
	public function getId_cidade(){
		return $this->id_cidade;
	}

	public function setId_cidade($id_cidade){
		$this->id_cidade = $id_cidade;
	}
	
	public function getDestaque(){
		return $this->destaque;
	}

	public function setDestaque($destaque){
		$this->destaque = $destaque;
	}
	
	public function getImagens(){
		return $this->imagens;
	}

	public function setImagens($imagens){
		$this->imagens = $imagens;
	}
	
	public function getDetalhes(){
		return $this->detalhes;
	}

	public function setDetalhes($detalhes){
		$this->detalhes = $detalhes;
	}
	
	public function getSalas_adicionais(){
		return $this->salas_adicionais;
	}

	public function setSalas_adicionais($salas_adicionais){
		$this->salas_adicionais = $salas_adicionais;
	}

	public function getAr_condicionado(){
		return $this->ar_condicionado;
	}

	public function setAr_condicionado($ar_condicionado){
		$this->ar_condicionado = $ar_condicionado;
	}

	public function getEstilo_arquitetura(){
		return $this->estilo_arquitetura;
	}

	public function setEstilo_arquitetura($estilo_arquitetura){
		$this->estilo_arquitetura = $estilo_arquitetura;
	}

	public function getNome_edificio(){
		return $this->nome_edificio;
	}

	public function setNome_edificio($nome_edificio){
		$this->nome_edificio = $nome_edificio;
	}

	public function getAndares_edificio(){
		return $this->andares_edificio;
	}

	public function setAndares_edificio($andares_edificio){
		$this->andares_edificio = $andares_edificio;
	}

	public function getAndar(){
		return $this->andar;
	}

	public function setAndar($andar){
		$this->andar = $andar;
	}

	public function getCaracteristicas_comunidade(){
		return $this->caracteristicas_comunidade;
	}

	public function setCaracteristicas_comunidade($caracteristicas_comunidade){
		$this->caracteristicas_comunidade = $caracteristicas_comunidade;
	}

	public function getZipcode(){
		return $this->zipcode;
	}

	public function setZipcode($zipcode){
		$this->zipcode = $zipcode;
	}

	public function getGaragem(){
		return $this->garagem;
	}

	public function setGaragem($garagem){
		$this->garagem = $garagem;
	}

	public function getCaracteristicas_garagem(){
		return $this->caracteristicas_garagem;
	}

	public function setCaracteristicas_garagem($caracteristicas_garagem){
		$this->caracteristicas_garagem = $caracteristicas_garagem;
	}

	public function getDimensoes_garagem(){
		return $this->dimensoes_garagem;
	}

	public function setDimensoes_garagem($dimensoes_garagem){
		$this->dimensoes_garagem = $dimensoes_garagem;
	}

	public function getFaculdades(){
		return $this->faculdades;
	}

	public function setFaculdades($faculdades){
		$this->faculdades = $faculdades;
	}

	public function getLayout_interior(){
		return $this->layout_interior;
	}

	public function setLayout_interior($layout_interior){
		$this->layout_interior = $layout_interior;
	}

	public function getCaracteristicas_cozinha(){
		return $this->caracteristicas_cozinha;
	}

	public function setCaracteristicas_cozinha($caracteristicas_cozinha){
		$this->caracteristicas_cozinha = $caracteristicas_cozinha;
	}

	public function getDescricao(){
		return $this->descricao;
	}

	public function setDescricao($descricao){
		$this->descricao = $descricao;
	}

	public function getCondicao(){
		return $this->condicao;
	}

	public function setCondicao($condicao){
		$this->condicao = $condicao;
	}

	public function getManutencoes(){
		return $this->manutencoes;
	}

	public function setManutencoes($manutencoes){
		$this->manutencoes = $manutencoes;
	}

	public function getDimensao_lote(){
		return $this->dimensao_lote;
	}

	public function setDimensao_lote($dimensao_lote){
		$this->dimensao_lote = $dimensao_lote;
	}

	public function getNumero_lote(){
		return $this->numero_lote;
	}

	public function setNumero_lote($numero_lote){
		$this->numero_lote = $numero_lote;
	}

	public function getBaias(){
		return $this->baias;
	}

	public function setBaias($baias){
		$this->baias = $baias;
	}

	public function getEscritorios(){
		return $this->escritorios;
	}

	public function setEscritorios($escritorios){
		$this->escritorios = $escritorios;
	}

	public function getPets(){
		return $this->pets;
	}

	public function setPets($pets){
		$this->pets = $pets;
	}

	public function getQuartos_visita(){
		return $this->quartos_visita;
	}

	public function setQuartos_visita($quartos_visita){
		$this->quartos_visita = $quartos_visita;
	}

	public function getEstacionamento(){
		return $this->estacionamento;
	}

	public function setEstacionamento($estacionamento){
		$this->estacionamento = $estacionamento;
	}

	public function getPiscina(){
		return $this->piscina;
	}

	public function setPiscina($piscina){
		$this->piscina = $piscina;
	}

	public function getDimensoes_piscina(){
		return $this->dimensoes_piscina;
	}

	public function setDimensoes_piscina($dimensoes_piscina){
		$this->dimensoes_piscina = $dimensoes_piscina;
	}

	public function getTipo_piscina(){
		return $this->tipo_piscina;
	}

	public function setTipo_piscina($tipo_piscina){
		$this->tipo_piscina = $tipo_piscina;
	}

	public function getZipcode_plus4(){
		return $this->zipcode_plus4;
	}

	public function setZipcode_plus4($zipcode_plus4){
		$this->zipcode_plus4 = $zipcode_plus4;
	}

	public function getAno_construcao(){
		return $this->ano_construcao;
	}

	public function setAno_construcao($ano_construcao){
		$this->ano_construcao = $ano_construcao;
	}

	public function getList_agent(){
		return $this->list_agent;
	}

	public function setList_agent($list_agent){
		$this->list_agent = $list_agent;
	}

	public function getList_office(){
		return $this->list_office;
	}

	public function setList_office($list_office){
		$this->list_office = $list_office;
	}
		
	function __destruct(){
		unset($this->id,
			$this->id_rets,
			$this->valor,
			$this->finalidade,
			$this->tipo,
			$this->banheiros,
			$this->quartos,
			$this->area,
			$this->localizacao, 
			$this->latitude,
			$this->longitude,
			$this->informacoes_adicionais,
			$this->data_cad,
			$this->status,
			$this->visualizacoes,
			$this->id_cidade,
			$this->destaque,
			$this->imagens,
			$this->detalhes,
			$this->salas_adicionais,
			$this->ar_condicionado,
			$this->estilo_arquitetura,
			$this->nome_edificio,
			$this->andares_edificio,
			$this->andar,
			$this->caracteristicas_comunidade,
			$this->zipcode,
			$this->garagem,
			$this->caracteristicas_garagem,
			$this->dimensoes_garagem,
			$this->faculdades,
			$this->layout_interior,
			$this->caracteristicas_cozinha,
			$this->descricao,
			$this->condicao,
			$this->manutencoes,
			$this->dimensao_lote,
			$this->numero_lote,
			$this->baias,
			$this->escritorios,
			$this->pets,
			$this->quartos_visita,
			$this->estacionamento,
			$this->piscina,
			$this->dimensoes_piscina,
			$this->tipo_piscina,
			$this->zipcode_plus4,
			$this->ano_construcao,
			$this->list_agent,
			$this->list_office);
	}

}
?>