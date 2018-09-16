<?php
@session_start();
/*if (!isset($_SESSION['co']['admin'])) {
	die('Não logado');
}*/
$numberDir = 1;
$pathDir = '../uploads/imovel';
$dirFinal = '';

//die();

//MÉTODO PARA RETORNAR O DIRETÓRIO QUE TENHA MENOS DE 5000 IMAGENS, CASO CONTRÁRIO, CRIA NOVO DIRETÓRIO
function getPath($dir) {
	GLOBAL $numberDir;
	GLOBAL $pathDir;
	GLOBAL $dirFinal;

	$dir .= $numberDir;
	$dir .= '/';

	try {
		$fi = new FilesystemIterator($dir, FilesystemIterator::SKIP_DOTS);
		if (iterator_count($fi) < 5000) {
			$dirFinal = $dir;
			return $dirFinal;
		} else {
			$numberDir++;
			getPath($pathDir);
		}
	} catch (Exception $e) {
		$old_umask = umask(0);
		mkdir($pathDir.$numberDir, 0777);
		umask($old_umask);

		getPath($pathDir);
	}
}

$dir = getPath($pathDir);

@include_once('login.php');
@include_once('../pacotes/controller/ControllerGeral.php');

$rets = new PHRETS;
$connect = $rets->Connect($login, $un, $pw);

$controller = new ControllerFunctions();
$conn = $controller->getConnection();

error_reporting(E_ERROR);
echo '<pre>';

/*if (!$_REQUEST['id'])
	die("Cade o id ?");

$id = array();
$sql = "SELECT id_rets FROM imovel WHERE id = ".$_REQUEST['id'];
foreach ($conn->query($sql) as $row) {
	$id[] = $row['id_rets'];
}
$id = $id[0];
print_r($id);
echo '<br>';
*/
//$id = $_REQUEST['id'];

if($connect) {
	@ob_start();

	//$conn->beginTransaction();

	$search = $rets->SearchQuery(
		'Property',																			// Resource
		'Listing',																			// Class
		'((STATUS=|ACT),((StreetCity=WINDERMERE)|(StreetCity=SAINT CLOUD)|(StreetCity=KISSIMMEE)|(StreetCity=CLERMONT)|(StreetCity=WINTER GARDEN)|(StreetCity=OCOEE)|(StreetCity=APOPKA)|(StreetCity=OVIEDO)|(StreetCity=CELEBRATION)|(StreetCity=DAVENPORT)|(StreetCity=ORLANDO)|(StreetCity=LONGWOOD)|(StreetCity=ALTAMONTE SPRINGS)),((PropertyType=|RES)|(PropertyType=|REN)))',	// DMQL, with SystemNames
		//'(Matrix_Unique_ID='.$id.')',
		array(
			'Format'	=> 'COMPACT-DECODED',
			//'Select'	=> 'Matrix_Unique_ID,ListPrice,SqFtTotal,StreetCity,StreetName,StreetSuffix,StreetNumber,BathsFull,BathsHalf,BedsTotal,PropertyDescription,PropertyStyle,PropertyType',
			//'Select'	=> 'StreetCity',
			//'Select' 	=> 'Matrix_Unique_ID,AdditionalRooms,Address,AirConditioning,AltAddress,ArchitecturalStyle,AWCRemarks,Adress,AirConditioning,AltAddress,ArchitecturalStyle,AWCRemarks,BathsTotal,BedsTotal,BuildingNameNumber,BuildingNumFloors,FloorNum,CommunityFeatures,PostalCode,CurrentPrice,FloorNum,GarageCarport,GarageFeatures,GarageDimensions,HighSchool,InteriorLayout,KitchenFeatures,LegalDescription,ListPrice,Location,LotDimensions,LotNum,MaintenanceIncludes,NumofBays,NumofOffices,NumofPets,NumofRestrooms,Parking,Pool,PoolDimensions,PoolType,PostalCodePlus4,PropertyDescription,PropertyStyle,PropertyType,RoadFrontage,SpaceType,SqFtTotal,StreetCity,StreetName,StreetNumber,StreetSuffix,Township,YearBuilt',
			'Select' => 'Matrix_Unique_ID,ListPrice,SqFtTotal,StreetCity,StreetName,StreetSuffix,StreetNumber,BathsFull,BathsHalf,BedsTotal,PropertyDescription,PropertyStyle,PropertyType,AdditionalRooms,AirConditioning,ArchitecturalStyle,BuildingNameNumber,BuildingNumFloors,FloorNum,CommunityFeatures,PostalCode,GarageCarport,GarageFeatures,GarageDimensions,HighSchool,InteriorLayout,KitchenFeatures,LegalDescription,Location,LotDimensions,LotNum,MaintenanceIncludes,NumofBays,NumofOffices,NumofPets,NumofRestrooms,Parking,Pool,PoolDimensions,PoolType,PostalCodePlus4,YearBuilt',
			'Count'		=> 1,
			'Offset'	=> 10608,
			'Limit'		=> 200
		)
	);

	/* If search returned results */
	if($rets->TotalRecordsFound() > 0) {
		while($data = $rets->FetchRow($search)) {
			print_r($data);
			//ob_flush();

			$finalidade = 'Compra';
			if ($data['PropertyType'] == 'Rental')
				$finalidade = 'Aluguel';

			$tipo = 'Casa';
			if ($data['PropertyStyle'] == 'Condo' || $data['PropertyStyle'] == 'Townhouse')
				$tipo = 'Condomínio';

			$banheiros = (int) $data['BathsFull'] + (int) $data['BathsHalf'];

			$area = 0;
			if ($data['SqFtTotal'])
				$area = number_format($data['SqFtTotal'] / 10.764, 2, '.', '');

			$idcidade = null;
			if ($data['StreetCity'] == "ORLANDO")
				$idcidade = 374;
			else if ($data['StreetCity'] == "SAINT CLOUD")
				$idcidade = 542;
			else if ($data['StreetCity'] == "KISSIMMEE")
				$idcidade = 543;
			else if ($data['StreetCity'] == "CLERMONT")
				$idcidade = 544;
			else if ($data['StreetCity'] == "WINTER GARDEN")
				$idcidade = 545;
			else if ($data['StreetCity'] == "OCOEE")
				$idcidade = 546;
			else if ($data['StreetCity'] == "APOPKA")
				$idcidade = 547;
			else if ($data['StreetCity'] == "OVIEDO")
				$idcidade = 548;
			else if ($data['StreetCity'] == "CELEBRATION")
				$idcidade = 549;
			else if ($data['StreetCity'] == "DAVENPORT")
				$idcidade = 550;
			else if ($data['StreetCity'] == "LONGWOOD")
				$idcidade = 551;
			else if ($data['StreetCity'] == "ALTAMONTE SPRINGS")
				$idcidade = 552;
			else if ($data['StreetCity'] == "WINDERMERE")
				$idcidade = 553;

			$endereco = '';
			if ($data['StreetNumber']) {
				$endereco .= $data['StreetNumber'];
				$endereco .= ' ';
			}
			if ($data['StreetName']) {
				$endereco .= $data['StreetName'];
				$endereco .= ' ';
			}
			if ($data['StreetSuffix']) {
				$endereco .= $data['StreetSuffix'];
			}

			$endereco = str_replace("TRAIL", "TR", $endereco);
			$endereco = trim($endereco);

			//BUSCANDO LATITUDE/LONGITUDE
			//$address = str_replace(' ', '+', $endereco);
			//$url = "http://maps.google.com/maps/api/geocode/json?address=$address+".str_replace(" ", "+", $data['StreetCity'])."+FL&sensor=false";
			//$ch = curl_init();
			//curl_setopt($ch, CURLOPT_URL, $url);
			//curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			//curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
			//curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			//curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			//$response = curl_exec($ch);
			//curl_close($ch);
			//$response_a = json_decode($response);
			//$lat = $response_a->results[0]->geometry->location->lat;
			//$long = $response_a->results[0]->geometry->location->lng;

			if (!$lat)
				$lat = 'null';

			if (!$long)
				$long = 'null';

			$data = array_map(addslashes, $data);

			$sql = "INSERT INTO imovel (valor,
										finalidade,
										tipo,
										banheiros,
										quartos,
										area,
										informacoes_adicionais,
										localizacao,
										latitude,
										longitude,
										id_cidade,
										id_rets,
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
										ano_construcao)
								VALUES
										(" . $data['ListPrice'] . ",
										'$finalidade',
										'$tipo',
										$banheiros,
										" . $data['BedsTotal'] . ",
										$area,
										'" . $data['PropertyDescription'] . "',
										'$endereco',
										$lat,
										$long,
										$idcidade,
										" . $data['Matrix_Unique_ID'] . ",
										'".$data['AdditionalRooms']."',
										'".$data['AirConditioning']."',
										'".$data['ArchitecturalStyle']."',
										'".$data['BuildingNameNumber']."',
										".(($data['BuildingNumFloors'])?$data['BuildingNumFloors']:'null').",
										".(($data['FloorNum'])?$data['FloorNum']:'null').",
										'".$data['CommunityFeatures']."',
										".(($data['PostalCode'])?$data['PostalCode']:'null').",
										'".$data['GarageCarport']."',
										'".$data['GarageFeatures']."',
										'".$data['GarageDimensions']."',
										'".$data['HighSchool']."',
										'".$data['InteriorLayout']."',
										'".$data['KitchenFeatures']."',
										'".$data['LegalDescription']."',
										'".$data['Location']."',
										'".$data['MaintenanceIncludes']."',
										'".$data['LotDimensions']."',
										'".$data['LotNum']."',
										".(($data['NumofBays'])?$data['NumofBays']:'null').",
										".(($data['NumofOffices'])?$data['NumofOffices']:'null').",
										".(($data['NumofPets'])?$data['NumofPets']:'null').",
										".(($data['NumofRestrooms'])?$data['NumofRestrooms']:'null').",
										'".$data['Parking']."',
										'".$data['Pool']."',
										'".$data['PoolDimensions']."',
										'".$data['PoolType']."',
										".(($data['PostalCodePlus4'])?$data['PostalCodePlus4']:'null').",
										".(($data['YearBuilt'])?$data['YearBuilt']:'null').");";

			$stm = $conn->prepare($sql);
			if (!$stm->execute()){
				echo $sql.'=>';
				print_r($stm->errorInfo());
				//$conn->rollBack();
				//return false;
				die();
			} else {
				$id_imovel = $conn->lastInsertId('imovel_id_seq');
				echo $sql.'<br>';

				$photos = $rets->GetObject('Property', 'LargePhoto', $data['Matrix_Unique_ID']);
				$n = 0;
				if (count(($photos) > 1)) {
					foreach ($photos as $photo) {
						if ($n > 0) {
							$img = date('Ymd') . $id_imovel . date('His') . $n . '.jpg';
							$dir = getPath($pathDir);
							if ($dir == '')
								$dir = getPath($pathDir);
							file_put_contents($dir . $img, $photo['Data']);

							$dir = str_replace("../uploads/", "", $dir);
							$img = $dir . $img;
							$sql2 = "INSERT INTO imagem_imovel (id_imovel, arquivo, ordem) VALUES ($id_imovel, '$img', $n);";
							$stm2 = $conn->prepare($sql2);
							if (!$stm2->execute()) {
								print_r($stm2->errorInfo());
								//$conn->rollBack();
								//return false;
								die();
							}
						}
						$n++;
					}
				} else {
					$img = date('Ymd') . $id_imovel . date('His') . $n . '.jpg';
						$dir = getPath($pathDir);
						if ($dir == '')
							$dir = getPath($pathDir);
						file_put_contents($dir . $img, $photos[0]['Data']);

						$dir = str_replace("../uploads/", "", $dir);
						$img = $dir . $img;
						$sql2 = "INSERT INTO imagem_imovel (id_imovel, arquivo, ordem) VALUES ($id_imovel, '$img', $n);";
						$stm2 = $conn->prepare($sql2);
						if (!$stm2->execute()) {
							print_r($stm2->errorInfo());
							//$conn->rollBack();
							//return false;
							die();
						}
				}
				$rets->FreeResult($photos);

			}
		}
	} else {
		echo '0 Records Found';
	}
/*
	ob_end_flush();
	$rets->FreeResult($search);
	$rets->Disconnect();

	$sql = "UPDATE imovel SET destaque = FALSE";
	$stm = $conn->prepare($sql);
	if (!$stm->execute()) {
		print_r($stm->errorInfo());
		$conn->rollBack();
		//return false;
		die();
	}

	$sql = "UPDATE imovel SET destaque = TRUE WHERE id IN (SELECT id FROM imovel ORDER BY RANDOM() LIMIT 10);";
	$stm = $conn->prepare($sql);
	if (!$stm->execute()) {
		print_r($stm->errorInfo());
		$conn->rollBack();
		//return false;
		die();
	}

	$conn->commit();*/
} else {
	$error = $rets->Error();
	print_r($error);
}

?>
</pre>