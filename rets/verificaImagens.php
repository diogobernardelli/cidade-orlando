<?php
@session_start();
/*if (!isset($_SESSION['co']['admin'])) {
	die('Não logado');
}*/
@include_once('../pacotes/controller/ControllerGeral.php');

$controller = new ControllerFunctions();
$conn = $controller->getConnection();

error_reporting(E_ERROR);
echo '<pre>';


	$conn->beginTransaction();

	$sql = "SELECT arquivo FROM imagem_imovel ORDER BY id_imovel";
$cont = 1;
	foreach ($conn->query($sql) as $row) {

		if(!file_exists("../uploads/".$row['arquivo'])) {
			echo $cont." - O arquivo não existe => ".$row['arquivo']."<br>";

			$sql = "DELETE FROM imagem_imovel WHERE arquivo = '".$row['arquivo']."'";
			$stm = $conn->prepare($sql);
			if (!$stm->execute()) {
				print_r($stm->errorInfo());
				$conn->rollBack();
				break;
			}
			$cont++;
		}

	}

	$conn->commit();

?>
</pre>