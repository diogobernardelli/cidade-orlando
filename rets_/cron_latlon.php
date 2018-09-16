<?php
error_reporting(0);

@include_once('../pacotes/controller/ControllerGeral.php');
$controller = new ControllerFunctions();
$conn = $controller->getConnection();

$cont = 1;

	$sql = "SELECT t1.id, t1.localizacao, t2.nome as cidade
			FROM imovel t1
			INNER JOIN cidade t2 ON t1.id_cidade = t2.id
			WHERE latitude IS NULL
				AND semlatlon IS FALSE
			LIMIT 2500";
	foreach ($conn->query($sql) as $row) {
		usleep(250000);
		//sleep(2);
		//BUSCANDO LATITUDE/LONGITUDE
		$address = str_replace(' ', '+', $row['localizacao']);
		$url = "https://maps.google.com/maps/api/geocode/json?address=$address+".str_replace(" ", "+", $row['cidade'])."+FL&sensor=false&key=AIzaSyDD_E5RvOBfAN04BLnyJYbg3DIILo7g2sI";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		$response = curl_exec($ch);
		curl_close($ch);
		$response_a = json_decode($response);
		$lat = $response_a->results[0]->geometry->location->lat;
		$long = $response_a->results[0]->geometry->location->lng;

		if (!$lat)
			$lat = 'null';

		if (!$long)
			$long = 'null';

		if ($lat != 'null' && $long != 'null') {
			$sql2 = "UPDATE imovel SET latitude = $lat, longitude = $long, semlatlon = FALSE WHERE id = " . $row['id'];
			//echo $cont.' => '.$sql2.'<br><br>';	
			//flush();
			//ob_flush();
			$stm2 = $conn->prepare($sql2);
			if (!$stm2->execute()) {
				echo $sql2 . '=>';
				print_r($stm2->errorInfo());
				//$conn->rollBack();
				//return false;
				die();
			}
		} else {
			//echo $cont.' => ';
			//print_r($response_a);					
			//flush();
			//ob_flush();
			
			if ($response_a->status == 'OVER_QUERY_LIMIT' || $response_a->status == 'REQUEST_DENIED')
				break;
			else if ($response_a->status == 'ZERO_RESULTS') {
				$sql3 = "UPDATE imovel SET semlatlon = TRUE WHERE id = " . $row['id'];
				$stm3 = $conn->prepare($sql3);
				if (!$stm3->execute()) {
					echo $sql3 . '=>';
					print_r($stm3->errorInfo());
					//$conn->rollBack();
					//return false;
					break;
				}
			}
		}

		$cont++;
	}

	//$conn->commit();
//echo "OK";
?>