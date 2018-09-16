<?php
@session_start();

@include_once('login.php');
@include_once('../pacotes/controller/ControllerGeral.php');

$rets = new PHRETS;
$connect = $rets->Connect($login, $un, $pw);

$controller = new ControllerFunctions();
$conn = $controller->getConnection();

error_reporting(E_ERROR);
echo '<pre>';

if($connect) {
	@ob_start();

	//$conn->beginTransaction();

	$date = new DateTime(date('Y-m-d H:i:s'));
	$dtini = $date;
	$date->modify('-5 days');
	$dt = $date->format('Y-m-d');
	
	$search = $rets->SearchQuery(
		'Property',																			// Resource
		'Listing',																			// Class
		'((PriceChangeTimestamp='.$dt.'T00:00:00+),(STATUS=|ACT),((StreetCity=WINDERMERE)|(StreetCity=SAINT CLOUD)|(StreetCity=KISSIMMEE)|(StreetCity=CLERMONT)|(StreetCity=WINTER GARDEN)|(StreetCity=OCOEE)|(StreetCity=APOPKA)|(StreetCity=OVIEDO)|(StreetCity=CELEBRATION)|(StreetCity=DAVENPORT)|(StreetCity=ORLANDO)|(StreetCity=LONGWOOD)|(StreetCity=ALTAMONTE SPRINGS)),(PropertyType=|RES))',	// DMQL, with SystemNames => SEM ALUGUEL
		array(
			'Format'	=> 'COMPACT-DECODED',
			//'Select'	=> 'Matrix_Unique_ID,ListPrice,SqFtTotal,StreetCity,StreetName,StreetSuffix,StreetNumber,BathsFull,BathsHalf,BedsTotal,PropertyDescription,PropertyStyle,PropertyType',
			//'Select'	=> 'StreetCity',
			//'Select' 	=> 'Matrix_Unique_ID,AdditionalRooms,Address,AirConditioning,AltAddress,ArchitecturalStyle,AWCRemarks,Adress,AirConditioning,AltAddress,ArchitecturalStyle,AWCRemarks,BathsTotal,BedsTotal,BuildingNameNumber,BuildingNumFloors,FloorNum,CommunityFeatures,PostalCode,CurrentPrice,FloorNum,GarageCarport,GarageFeatures,GarageDimensions,HighSchool,InteriorLayout,KitchenFeatures,LegalDescription,ListPrice,Location,LotDimensions,LotNum,MaintenanceIncludes,NumofBays,NumofOffices,NumofPets,NumofRestrooms,Parking,Pool,PoolDimensions,PoolType,PostalCodePlus4,PropertyDescription,PropertyStyle,PropertyType,RoadFrontage,SpaceType,SqFtTotal,StreetCity,StreetName,StreetNumber,StreetSuffix,Township,YearBuilt',
			'Select' => 'Matrix_Unique_ID,ListPrice',
			'Count'		=> 1,
			//'Offset'	=> 10608,
			//'Limit'		=> 200
		)
	);

	/* If search returned results */
	if($rets->TotalRecordsFound() > 0) {
		while($data = $rets->FetchRow($search)) {
			print_r($data);
			
			$sql = "UPDATE imovel SET valor = '".$data['ListPrice']."' WHERE id_rets = '".$data['Matrix_Unique_ID']."';";
			echo $sql.'<br><br>';
			$stm = $conn->prepare($sql);
			if (!$stm->execute()){
				print_r($stm->errorInfo());
				//$conn->rollBack();
				//return false;
				die();
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