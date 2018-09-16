<?php
error_reporting(1);
ini_set('max_execution_time', -1);

@include_once('login.php');

@include_once('../pacotes/controller/ControllerGeral.php');


$controller = new ControllerFunctions();
$conn = $controller->getConnection();

if($connect) {
	//$conn->beginTransaction();

	$search = $rets->Search(
		'Property',																			// Resource
		'Property',																			// Class
		//'((STATUS=|ACT),(City=WINDERMERE),((PropertyType=|RES)|(PropertyType=|REN)))',	// DMQL, with SystemNames
		//'((STATUS=|ACT),((City=WINDERMERE)|(City=SAINT CLOUD)|(City=KISSIMMEE)|(City=CLERMONT)|(City=WINTER GARDEN)|(City=OCOEE)|(City=APOPKA)|(City=OVIEDO)|(City=CELEBRATION)|(City=DAVENPORT)|(City=ORLANDO)|(City=LONGWOOD)|(City=ALTAMONTE SPRINGS)),((PropertyType=|RES)|(PropertyType=|REN)))',	// DMQL, with SystemNames
		'((MlsStatus=|ACT),((City=WINDERMERE)|(City=SAINT CLOUD)|(City=KISSIMMEE)|(City=CLERMONT)|(City=WINTER GARDEN)|(City=OCOEE)|(City=APOPKA)|(City=OVIEDO)|(City=CELEBRATION)|(City=DAVENPORT)|(City=ORLANDO)|(City=LONGWOOD)|(City=ALTAMONTE SPRINGS)),(PropertyType=|RESI))',	// DMQL, with SystemNames => SEM ALUGUEL
		// array(
		// 	'Format'	=> 'COMPACT-DECODED',
		// 	'Select'	=> 'ListingKeyNumeric',
		// 	'Count'		=> 1
		// )
		[
	        'QueryType' => 'DMQL2',
	        'Count' => 1, // count and records
	        'Format' => 'COMPACT-DECODED',
	        'Select'	=> 'ListingKeyNumeric',
	        //'Limit' => 9999999999,
	        'Limit' => 1000,
	        'StandardNames' => 0, // give system names
	    ]
	);

	$array_rets = array();
	$array_db = array();

echo "<pre>LINHAS: ".$search->getTotalResultsCount().PHP_EOL;

	foreach ($search as $record) {
	    // echo $record['Address'] . "\n";
	    // is the same as:
	    // echo $record->get('Address') . "\n";

	    //$array_rets[] = $record->get('ListingKeyNumeric');
	    $array_rets[] = $record['ListingKeyNumeric'];
	}


	$sql = "SELECT id_rets FROM imovel ORDER BY id_rets";
	foreach ($conn->query($sql) as $row) {
		$array_db[] = $row['id_rets'];
	}
//print_r($array_db);
	$array_db_delete = array();
	foreach($array_db as $ar) {
		if (!in_array($ar, $array_rets)) {
			if ($ar) {
				$array_db_delete[] = $ar;
			}
		}
	}
//print_r($array_db_delete);
	$array_rets_new = array();
	foreach($array_rets as $ar) {
		if (!in_array($ar, $array_db))
			$array_rets_new[] = $ar;
	}
//print_r($array_rets_new);
//die();
	if (count($array_db_delete) > 50) {
		//mail ERRO DELETE
		//die("MTOS DELETES: ".count($array_db_delete));
	}

//INSERTS
//print_r($array_rets_new);
	foreach ($array_rets_new as $ar) {
		
		$qr = '((ListingKeyNumeric=' . $ar . '))';
		$search = $rets->Search(
			'Property',        // Resource
			'Property',        // Class
			$qr,            // DMQL, with SystemNames
			[
				'Format' => 'COMPACT-DECODED',
				//'Select' => 'Matrix_Unique_ID,ListPrice,SqFtTotal,City,StreetName,StreetSuffix,StreetNumber,BathsFull,BathsHalf,BedsTotal,PropertyDescription,PropertyStyle,PropertyType,AdditionalRooms,AirConditioning,ArchitecturalStyle,BuildingNameNumber,BuildingNumFloors,FloorNum,CommunityFeatures,PostalCode,GarageCarport,GarageFeatures,GarageDimensions,HighSchool,InteriorLayout,KitchenFeatures,LegalDescription,Location,LotDimensions,LotNum,MaintenanceIncludes,NumofBays,NumofOffices,NumofPets,NumofRestrooms,Parking,Pool,PoolDimensions,PoolType,PostalCodePlus4,YearBuilt,ListAgentFullName,ListOfficeName',
				'Select' => 'ListingKeyNumeric,ListPrice,BuildingAreaTotal,City,StreetName,StreetSuffix,StreetNumber,BathroomsFull,BathroomsHalf,BedroomsTotal,PropertyDescription,CurrentUse,PropertyType,AdditionalRooms,Cooling,ArchitecturalStyle,BuildingNameNumber,StoriesTotal,FloorNumber,AssociationAmenities,PostalCode,AttachedGarageYN,ParkingFeatures,GarageDimensions,HighSchool,InteriorFeatures,TaXLegalDescription,LotFeatures,LotSizeDimensions,TaXLot,AssociationFeeIncludes,NumofBays,NumofOffices,NumberOfPets,NumofRestrooms,PrivatePoolYN,PoolDimensions,PostalCodePlus4,YearBuilt,ListAgentFullName,ListOfficeName',
				'Count' => 1
			]
		);

		//PoolType removido conforme instruções - http://mfrmls.us7.list-manage.com/track/click?u=61a46b0c6fcc835f13a940877&id=1823dc74d7&e=2e27a09e7b
		
		if($search->getTotalResultsCount() > 0) {
			foreach ($search as $data) {
				print_r($data);
	
				$data = $data->toArray();
				
				print_r($data);
				
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
				//$url = "http://maps.google.com/maps/api/geocode/json?address=$address+".str_replace(" ", "+", $data['City'])."+FL&sensor=false";
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
											".(($data['FloorNumber'])?$data['FloorNumber']:'null').",
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
											".(($data['NumofBays'])?$data['NumofBays']:'null').",
											".(($data['NumofOffices'])?$data['NumofOffices']:'null').",
											".(($data['NumberOfPets'])?$data['NumberOfPets']:'null').",
											".(($data['NumofRestrooms'])?$data['NumofRestrooms']:'null').",
											'null',
											'".$data['PrivatePoolYN']."',
											'".$data['PoolDimensions']."',
											".(($data['PostalCodePlus4'])?$data['PostalCodePlus4']:'null').",
											".(($data['YearBuilt'])?$data['YearBuilt']:'null').",
											'".$data['ListAgentFullName']."',
											'".$data['ListOfficeName']."');";

				print_r($sql);
				echo PHP_EOL;
				
			}
		} else {
			echo '0 Records Found';
		}

		//$rets->FreeResult($search);
	}
	
	//$rets->Disconnect();


} else {
	$error = $rets->Error();
	print_r($error);
}

//echo "OK";
?>