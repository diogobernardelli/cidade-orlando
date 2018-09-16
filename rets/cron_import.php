<?php
error_reporting(0);
//ini_set('display_errors', 'On');
//error_reporting(E_ALL);

$numberDir = 1;
$pathDir = '../uploads/imovel';
$dirFinal = '';


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

$controller = new ControllerFunctions();
$conn = $controller->getConnection();

if($connect) {
	//$conn->beginTransaction();

	$search = $rets->Search(
		'Property',																			// Resource
		'Property',																			// Class
		//'((STATUS=|ACT),(StreetCity=WINDERMERE),((PropertyType=|RES)|(PropertyType=|REN)))',	// DMQL, with SystemNames
		//'((STATUS=|ACT),((StreetCity=WINDERMERE)|(StreetCity=SAINT CLOUD)|(StreetCity=KISSIMMEE)|(StreetCity=CLERMONT)|(StreetCity=WINTER GARDEN)|(StreetCity=OCOEE)|(StreetCity=APOPKA)|(StreetCity=OVIEDO)|(StreetCity=CELEBRATION)|(StreetCity=DAVENPORT)|(StreetCity=ORLANDO)|(StreetCity=LONGWOOD)|(StreetCity=ALTAMONTE SPRINGS)),((PropertyType=|RES)|(PropertyType=|REN)))',	// DMQL, with SystemNames
		'((MlsStatus=|ACT),((City=WINDERMERE)|(City=SAINT CLOUD)|(City=KISSIMMEE)|(City=CLERMONT)|(City=WINTER GARDEN)|(City=OCOEE)|(City=APOPKA)|(City=OVIEDO)|(City=CELEBRATION)|(City=DAVENPORT)|(City=ORLANDO)|(City=LONGWOOD)|(City=ALTAMONTE SPRINGS)),(PropertyType=|RESI))',	// DMQL, with SystemNames => SEM ALUGUEL
		[
	        'QueryType' => 'DMQL2',
	        'Count' => 1, // count and records
	        'Format' => 'COMPACT-DECODED',
	        'Select'	=> 'ListingKeyNumeric',
	        'Limit' => 9999999999,
	        'StandardNames' => 0, // give system names
	    ]
	);

	$array_rets = array();
	$array_db = array();

	if($search->getTotalResultsCount() > 0) {
		foreach ($search as $record) {
		    $array_rets[] = $record->get('ListingKeyNumeric');
		}
	}

	$sql = "SELECT id_rets FROM imovel ORDER BY id_rets";
	foreach ($conn->query($sql) as $row) {
		$array_db[] = $row['id_rets'];
	}

	$array_db_delete = array();
	foreach($array_db as $ar) {
		if (!in_array($ar, $array_rets)) {
			if ($ar) {
				$array_db_delete[] = $ar;
			}
		}
	}

	$array_rets_new = array();
	foreach($array_rets as $ar) {
		if (!in_array($ar, $array_db))
			$array_rets_new[] = $ar;
	}
	
	if (count($array_db_delete) > 50) {
		//mail ERRO DELETE
		die("MTOS DELETES: ".count($array_db_delete));
	}
	
	foreach ($array_db_delete as $ar) {

		$sql = "SELECT t1.arquivo AS imagem FROM imagem_imovel t1 INNER JOIN imovel t2 ON t1.id_imovel = t2.id WHERE t2.id_rets = $ar";
		foreach ($conn->query($sql) as $row) {
			//@unlink(dirname(__FILE__).'/../uploads/'.$row['imagem']);
			@unlink('../uploads/'.$row['imagem']);
		}

		$sql = "DELETE FROM imagem_imovel WHERE id_imovel = (SELECT id FROM imovel WHERE id_rets = $ar)";
		$stm = $conn->prepare($sql);
		if (!$stm->execute()) {
			echo $sql . '=>';
			print_r($stm->errorInfo());
			//$conn->rollBack();
			//return false;
			die();
		}

		$sql = "DELETE FROM imovel WHERE id_rets = $ar";
		$stm = $conn->prepare($sql);
		if (!$stm->execute()) {
			echo $sql . '=>';
			print_r($stm->errorInfo());
			//$conn->rollBack();
			//return false;
			die();
		}
	}

//INSERTS
	foreach ($array_rets_new as $ar) {
		//echo $ar.'<br>';
		$qr = '((ListingKeyNumeric=' . $ar . '))';
		$search = $rets->Search(
			'Property',        // Resource
			'Property',        // Class
			$qr,            // DMQL, with SystemNames
			[
				'Format' => 'COMPACT-DECODED',
				//'Select' => 'Matrix_Unique_ID,ListPrice,SqFtTotal,StreetCity,StreetName,StreetSuffix,StreetNumber,BathsFull,BathsHalf,BedsTotal,PropertyDescription,PropertyStyle,PropertyType,AdditionalRooms,AirConditioning,ArchitecturalStyle,BuildingNameNumber,BuildingNumFloors,FloorNum,CommunityFeatures,PostalCode,GarageCarport,GarageFeatures,GarageDimensions,HighSchool,InteriorLayout,KitchenFeatures,LegalDescription,Location,LotDimensions,LotNum,MaintenanceIncludes,NumofBays,NumofOffices,NumofPets,NumofRestrooms,Parking,Pool,PoolDimensions,PoolType,PostalCodePlus4,YearBuilt,ListAgentFullName,ListOfficeName',
				'Select' => 'ListingKeyNumeric,ListPrice,BuildingAreaTotal,City,StreetName,StreetSuffix,StreetNumber,BathroomsFull,BathroomsHalf,BedroomsTotal,PropertyDescription,CurrentUse,PropertyType,AdditionalRooms,Cooling,ArchitecturalStyle,BuildingNameNumber,StoriesTotal,FloorNumber,AssociationAmenities,PostalCode,AttachedGarageYN,ParkingFeatures,GarageDimensions,HighSchool,InteriorFeatures,TaXLegalDescription,LotFeatures,LotSizeDimensions,TaXLot,AssociationFeeIncludes,NumofBays,NumofOffices,NumberOfPets,NumofRestrooms,PrivatePoolYN,PoolDimensions,PostalCodePlus4,YearBuilt,ListAgentFullName,ListOfficeName',
			    'Count' => 1 // count and records
			    
			]
		);

		//PoolType removido conforme instruções - http://mfrmls.us7.list-manage.com/track/click?u=61a46b0c6fcc835f13a940877&id=1823dc74d7&e=2e27a09e7b
		
		if($search->getTotalResultsCount() > 0) {
			foreach ($search as $data) {
				//print_r($data);

				$data = $data->toArray();
				
				$finalidade = 'Compra';
				if ($data['PropertyType'] == 'Rental')
					$finalidade = 'Aluguel';

				$tipo = 'Casa';
				if ($data['CurrentUse'] == 'Condo') {
					$tipo = 'Apartamento';
				} else if ($data['CurrentUse'] == 'Townhouse') {
					$tipo = 'Casa geminada';
				}

				$banheiros = (int)$data['BathroomsFull'] + (int)$data['BathroomsHalf'];

				$area = 0;
				if ($data['BuildingAreaTotal'])
					$area = number_format($data['BuildingAreaTotal'] / 10.764, 2, '.', '');

				$idcidade = null;
				if ($data['City'] == "ORLANDO")
					$idcidade = 374;
				else if ($data['City'] == "SAINT CLOUD")
					$idcidade = 542;
				else if ($data['City'] == "KISSIMMEE")
					$idcidade = 543;
				else if ($data['City'] == "CLERMONT")
					$idcidade = 544;
				else if ($data['City'] == "WINTER GARDEN")
					$idcidade = 545;
				else if ($data['City'] == "OCOEE")
					$idcidade = 546;
				else if ($data['City'] == "APOPKA")
					$idcidade = 547;
				else if ($data['City'] == "OVIEDO")
					$idcidade = 548;
				else if ($data['City'] == "CELEBRATION")
					$idcidade = 549;
				else if ($data['City'] == "DAVENPORT")
					$idcidade = 550;
				else if ($data['City'] == "LONGWOOD")
					$idcidade = 551;
				else if ($data['City'] == "ALTAMONTE SPRINGS")
					$idcidade = 552;
				else if ($data['City'] == "WINDERMERE")
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
											zipcode_plus4,
											ano_construcao,
											list_agent,
											list_office)
									VALUES
											(" . $data['ListPrice'] . ",
											'$finalidade',
											'$tipo',
											$banheiros,
											" . (($data['BedroomsTotal']!='')?$data['BedroomsTotal']:'0') . ",
											$area,
											'" . $data['PropertyDescription'] . "',
											'".addslashes($endereco)."',
											$lat,
											$long,
											$idcidade,
											" . $data['ListingKeyNumeric'] . ",
											'".$data['AdditionalRooms']."',
											'".$data['Cooling']."',
											'".$data['ArchitecturalStyle']."',
											'".$data['BuildingNameNumber']."',
											".(($data['StoriesTotal'])?$data['StoriesTotal']:'null').",
											".(($data['FloorNumber'])?preg_replace("/[^0-9]/", '', $data['FloorNumber']):'null').",
											'".$data['AssociationAmenities']."',
											".(($data['PostalCode'])?$data['PostalCode']:'null').",
											'".$data['AttachedGarageYN']."',
											'".$data['ParkingFeatures']."',
											'".$data['GarageDimensions']."',
											'".$data['HighSchool']."',
											'".$data['InteriorFeatures']."',
											'null',
											'".$data['TaXLegalDescription']."',
											'".$data['LotFeatures']."',
											'".$data['AssociationFeeIncludes']."',
											'".$data['LotSizeDimensions']."',
											'".$data['TaXLot']."',
											".(($data['NumofBays'])?preg_replace("/[^0-9]/", '', $data['NumofBays']):'null').",
											".(($data['NumofOffices'])?preg_replace("/[^0-9]/", '', $data['NumofOffices']):'null').",
											".(($data['NumberOfPets'])?preg_replace("/[^0-9]/", '', $data['NumberOfPets']):'null').",
											".(($data['NumofRestrooms'])?preg_replace("/[^0-9]/", '', $data['NumofRestrooms']):'null').",
											'null',
											'".$data['PrivatePoolYN']."',
											'".$data['PoolDimensions']."',
											".(($data['PostalCodePlus4'])?$data['PostalCodePlus4']:'null').",
											".(($data['YearBuilt'])?$data['YearBuilt']:'null').",
											'".$data['ListAgentFullName']."',
											'".$data['ListOfficeName']."');";

				$stm = $conn->prepare($sql);
				if (!$stm->execute()) {
					echo $sql . '=>';
					print_r($stm->errorInfo());
					//$conn->rollBack();
					//return false;
					//die();
				} else {
					$id_imovel = $conn->lastInsertId('imovel_id_seq');
					//echo '<br>' . $sql . '<br>';

					$photos = $rets->GetObject('Property', 'LargePhoto', $data['ListingKeyNumeric']);
					$n = 0;
					if (count(($photos) > 1)) {
						foreach ($photos as $photo) {
							if ($n > 0) {
								$img = date('Ymd') . $id_imovel . date('His') . $n . '.jpg';
								$dir = getPath($pathDir);
								if ($dir == '')
									$dir = getPath($pathDir);
								file_put_contents($dir . $img, $photo->getContent());

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
						//file_put_contents($dir . $img, $photos[0]['Data']);
						file_put_contents($dir . $img, $photo->getContent());

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
					//$rets->FreeResult($photos);

				}
			}
		} else {
			echo '0 Records Found';
		}

		//$rets->FreeResult($search);
	}
	
	//$rets->Disconnect();
	
//SETANDO DESTAQUES ALEATÓRIOS
	$sql = "UPDATE imovel SET destaque = FALSE";
	$stm = $conn->prepare($sql);
	if (!$stm->execute()) {
		print_r($stm->errorInfo());
		//$conn->rollBack();
		//return false;
		die();
	}

	$sql = "UPDATE imovel SET destaque = TRUE WHERE id IN (SELECT id FROM imovel ORDER BY RANDOM() LIMIT 10);";
	$stm = $conn->prepare($sql);
	if (!$stm->execute()) {
		print_r($stm->errorInfo());
		//$conn->rollBack();
		//return false;
		die();
	}
	//$conn->commit();

} else {
	$error = $rets->Error();
	print_r($error);
}

//echo "OK";
?>