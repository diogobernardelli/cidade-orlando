<?php
@session_start();
/*if (!isset($_SESSION['co']['admin'])) {
	die('Não logado');
}*/

@include_once('login.php');
@include_once('../pacotes/controller/ControllerGeral.php');

$rets = new PHRETS;
$connect = $rets->Connect($login, $un, $pw);

$controller = new ControllerFunctions();
$conn = $controller->getConnection();

error_reporting(E_ERROR);
echo '<pre>';

if($connect) {
	//@ob_start();

	//$conn->beginTransaction();

	//$sql = "SELECT id, id_rets FROM imovel ORDER BY id LIMIT 2000 OFFSET 10000";
	//$sql = "SELECT id, id_rets FROM imovel WHERE id = 24837";
	$sql = "SELECT id, id_rets FROM imovel WHERE tipo = 'Condomínio' LIMIT 2000 OFFSET 0";
	foreach ($conn->query($sql) as $row) {

		$search = $rets->SearchQuery(
			'Property',                                                                            // Resource
			'Listing',                                                                            // Class
			//'((STATUS=|ACT),((StreetCity=SAINT CLOUD)|(StreetCity=KISSIMMEE)|(StreetCity=CLERMONT)|(StreetCity=WINTER GARDEN)|(StreetCity=OCOEE)|(StreetCity=APOPKA)|(StreetCity=OVIEDO)|(StreetCity=CELEBRATION)|(StreetCity=DAVENPORT)|(StreetCity=ORLANDO)|(StreetCity=LONGWOOD)|(StreetCity=ALTAMONTE SPRINGS)),((PropertyType=|RES)|(PropertyType=|REN)))',	// DMQL, with SystemNames
			//'((STATUS=|ACT),((StreetCity=SAINT CLOUD)|(StreetCity=KISSIMMEE)|(StreetCity=CLERMONT)|(StreetCity=WINTER GARDEN)|(StreetCity=OCOEE)|(StreetCity=APOPKA)|(StreetCity=OVIEDO)|(StreetCity=CELEBRATION)|(StreetCity=DAVENPORT)|(StreetCity=LONGWOOD)|(StreetCity=ALTAMONTE SPRINGS)),((PropertyType=|RES)|(PropertyType=|REN)))',	// DMQL, with SystemNames
			'(Matrix_Unique_ID=' . $row['id_rets'] . ')',
			array(
				'Format' => 'COMPACT-DECODED',
				//'Select'	=> 'Matrix_Unique_ID,ListPrice,SqFtTotal,StreetCity,StreetName,StreetSuffix,StreetNumber,BathsFull,BathsHalf,BedsTotal,PropertyDescription,PropertyStyle,PropertyType',
				//'Select' => 'AdditionalRooms,AirConditioning,ArchitecturalStyle,BuildingNameNumber,BuildingNumFloors,FloorNum,CommunityFeatures,PostalCode,GarageCarport,GarageFeatures,GarageDimensions,HighSchool,InteriorLayout,KitchenFeatures,LegalDescription,Location,LotDimensions,LotNum,MaintenanceIncludes,NumofBays,NumofOffices,NumofPets,NumofRestrooms,Parking,Pool,PoolDimensions,PoolType,PostalCodePlus4,YearBuilt',
				'Select' => 'PropertyStyle',
				'Count' => 1,
				//'Offset'	=> 10410,
				//'Limit' => 200
			)
		);

		/* If search returned results */
		if ($rets->TotalRecordsFound() > 0) {
			while ($data = $rets->FetchRow($search)) {
				print_r($data);

				$data = array_map(addslashes, $data);
				/*
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
				*/
				
				$tipo = 'Casa';
				if ($data['PropertyStyle'] == 'Condo') {
					$tipo = 'Apartamento';
				} else if ($data['PropertyStyle'] == 'Townhouse') {
					$tipo = 'Casa geminada';
				}
				
				$sql = "UPDATE imovel SET tipo = '".$tipo."' WHERE id = ".$row['id'].";";
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
	}
} else {
	$error = $rets->Error();
	print_r($error);
}

$rets->FreeResult($search);
$rets->Disconnect();

?>
</pre>