<?php
@session_start();
/*if (!isset($_SESSION['co']['admin'])) {
	die('Não logado');
}*/

@include_once('login.php');

if (!$_REQUEST['id'])
	die("Cade o id ?");

$id = $_REQUEST['id'];

if($connect) {
	@ob_start();

	//$conn->beginTransaction();

	$search = $rets->Search(
		'Property',																			// Resource
		'Property',																			// Class
		//'((STATUS=|ACT),((StreetCity=WINDERMERE)|(StreetCity=SAINT CLOUD)|(StreetCity=KISSIMMEE)|(StreetCity=CLERMONT)|(StreetCity=WINTER GARDEN)|(StreetCity=OCOEE)|(StreetCity=APOPKA)|(StreetCity=OVIEDO)|(StreetCity=CELEBRATION)|(StreetCity=DAVENPORT)|(StreetCity=ORLANDO)|(StreetCity=LONGWOOD)|(StreetCity=ALTAMONTE SPRINGS)),((PropertyType=|RES)|(PropertyType=|REN)))',	// DMQL, with SystemNames
		'(ListingKeyNumeric='.$id.')',
		[
			'Format'	=> 'COMPACT-DECODED',
			//'Select'	=> 'Matrix_Unique_ID,ListPrice,SqFtTotal,StreetCity,StreetName,StreetSuffix,StreetNumber,BathsFull,BathsHalf,BedsTotal,PropertyDescription,PropertyStyle,PropertyType',
			//'Select'	=> 'StreetCity',
			//'Select' 	=> 'Matrix_Unique_ID,AdditionalRooms,Address,AirConditioning,AltAddress,ArchitecturalStyle,AWCRemarks,Adress,AirConditioning,AltAddress,ArchitecturalStyle,AWCRemarks,BathsTotal,BedsTotal,BuildingNameNumber,BuildingNumFloors,FloorNum,CommunityFeatures,PostalCode,CurrentPrice,FloorNum,GarageCarport,GarageFeatures,GarageDimensions,HighSchool,InteriorLayout,KitchenFeatures,LegalDescription,ListPrice,Location,LotDimensions,LotNum,MaintenanceIncludes,NumofBays,NumofOffices,NumofPets,NumofRestrooms,Parking,Pool,PoolDimensions,PoolType,PostalCodePlus4,PropertyDescription,PropertyStyle,PropertyType,RoadFrontage,SpaceType,SqFtTotal,StreetCity,StreetName,StreetNumber,StreetSuffix,Township,YearBuilt',
			'Select' => 'ListingKeyNumeric,ListPrice,BuildingAreaTotal,City,StreetName,StreetSuffix,StreetNumber,BathroomsFull,BathroomsHalf,BedroomsTotal,PropertyDescription,CurrentUse,PropertyType,AdditionalRooms,Cooling,ArchitecturalStyle,BuildingNameNumber,StoriesTotal,FloorNumber,AssociationAmenities,PostalCode,AttachedGarageYN,ParkingFeatures,GarageDimensions,HighSchool,InteriorFeatures,TaXLegalDescription,LotFeatures,LotSizeDimensions,TaXLot,AssociationFeeIncludes,NumofBays,NumofOffices,NumberOfPets,NumofRestrooms,PrivatePoolYN,PoolDimensions,PostalCodePlus4,YearBuilt,ListAgentFullName,ListOfficeName',
			'Count'		=> 1,
			//'Offset'	=> 10608,
			//'Limit'		=> 200
		]
	);

	/* If search returned results */
	if($search->getTotalResultsCount() > 0) {
		foreach ($search as $data) {
			print_r($data);

			echo "<br><br>";
			
			$photos = $rets->GetObject('Property', 'LargePhoto', $data['ListingKeyNumeric']);

			foreach($photos as $photo) {
				//$imageData = base64_encode(file_get_contents($photo['Data']));
				// Format the image SRC:  data:{mime};base64,{data};
				//$src = 'data: '.mime_content_type($photo['Data']).';base64,'.$imageData;
				$imageData = base64_encode($photo->getContent());
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
				//$rets->FreeResult($photos);

			
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