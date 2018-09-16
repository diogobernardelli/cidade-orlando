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

if (!$_REQUEST['id'])
	die("Cade o id ?");

$id = array();
$sql = "SELECT id_rets FROM imovel WHERE id = ".$_REQUEST['id'];
foreach ($conn->query($sql) as $row) {
	$id[] = $row['id_rets'];
}
$id = $id[0];
print_r($id);
echo '<br>';

//$id = $_REQUEST['id'];

if($connect) {
	@ob_start();

	//$conn->beginTransaction();

	$search = $rets->SearchQuery(
		'Property',																			// Resource
		'Listing',																			// Class
		//'((STATUS=|ACT),((StreetCity=WINDERMERE)|(StreetCity=SAINT CLOUD)|(StreetCity=KISSIMMEE)|(StreetCity=CLERMONT)|(StreetCity=WINTER GARDEN)|(StreetCity=OCOEE)|(StreetCity=APOPKA)|(StreetCity=OVIEDO)|(StreetCity=CELEBRATION)|(StreetCity=DAVENPORT)|(StreetCity=ORLANDO)|(StreetCity=LONGWOOD)|(StreetCity=ALTAMONTE SPRINGS)),((PropertyType=|RES)|(PropertyType=|REN)))',	// DMQL, with SystemNames
		'(Matrix_Unique_ID='.$id.')',
		array(
			'Format'	=> 'COMPACT-DECODED',
			//'Select'	=> 'Matrix_Unique_ID,ListPrice,SqFtTotal,StreetCity,StreetName,StreetSuffix,StreetNumber,BathsFull,BathsHalf,BedsTotal,PropertyDescription,PropertyStyle,PropertyType',
			//'Select'	=> 'StreetCity',
			//'Select' 	=> 'Matrix_Unique_ID,AdditionalRooms,Address,AirConditioning,AltAddress,ArchitecturalStyle,AWCRemarks,Adress,AirConditioning,AltAddress,ArchitecturalStyle,AWCRemarks,BathsTotal,BedsTotal,BuildingNameNumber,BuildingNumFloors,FloorNum,CommunityFeatures,PostalCode,CurrentPrice,FloorNum,GarageCarport,GarageFeatures,GarageDimensions,HighSchool,InteriorLayout,KitchenFeatures,LegalDescription,ListPrice,Location,LotDimensions,LotNum,MaintenanceIncludes,NumofBays,NumofOffices,NumofPets,NumofRestrooms,Parking,Pool,PoolDimensions,PoolType,PostalCodePlus4,PropertyDescription,PropertyStyle,PropertyType,RoadFrontage,SpaceType,SqFtTotal,StreetCity,StreetName,StreetNumber,StreetSuffix,Township,YearBuilt',
			'Select' => 'Matrix_Unique_ID,PriceChangeTimestamp,OriginalEntryTimestamp,ListPrice,SqFtTotal,StreetCity,StreetName,StreetSuffix,StreetNumber,BathsFull,BathsHalf,BedsTotal,PropertyDescription,PropertyStyle,PropertyType,AdditionalRooms,AirConditioning,ArchitecturalStyle,BuildingNameNumber,BuildingNumFloors,FloorNum,CommunityFeatures,PostalCode,GarageCarport,GarageFeatures,GarageDimensions,HighSchool,InteriorLayout,KitchenFeatures,LegalDescription,Location,LotDimensions,LotNum,MaintenanceIncludes,NumofBays,NumofOffices,NumofPets,NumofRestrooms,Parking,Pool,PoolDimensions,PoolType,PostalCodePlus4,YearBuilt',
			'Count'		=> 1,
			//'Offset'	=> 10608,
			//'Limit'		=> 200
		)
	);

	/* If search returned results */
	if($rets->TotalRecordsFound() > 0) {
		while($data = $rets->FetchRow($search)) {
			print_r($data);

			echo "<br><br>";
			
			$photos = $rets->GetObject('Property', 'LargePhoto', $data['Matrix_Unique_ID']);
			
			foreach($photos as $photo) {
				//$imageData = base64_encode(file_get_contents($photo['Data']));
				// Format the image SRC:  data:{mime};base64,{data};
				//$src = 'data: '.mime_content_type($photo['Data']).';base64,'.$imageData;
				$imageData = base64_encode($photo['Data']);
				$src = 'data: image/jpeg;base64,'.$imageData;
				
				echo '<img src="'.$src.'"><br>';
			}
			
			//print_r($photos);
				/*$n = 0;
				if (count(($photos) > 1)) {
					foreach ($photos as $photo) {
						if ($n > 0) {
							$img = date('Ymd') . $sysid . date('His') . $n . '.jpg';
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
					$img = date('Ymd') . $sysid . date('His') . $n . '.jpg';
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
				}*/
				$rets->FreeResult($photos);

			
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