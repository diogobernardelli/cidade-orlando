<?php
/*
Uploadify
Copyright (c) 2012 Reactive Apps, Ronnie Garcia
Released under the MIT License <http://www.opensource.org/licenses/mit-license.php> 
*/

// Define a destination
$targetFolder = '/tmp'; // Relative to the root

$verifyToken = md5('unique_salt' . $_POST['timestamp']);

if (!empty($_FILES) && $_POST['token'] == $verifyToken) {
	$tempFile = $_FILES['Filedata']['tmp_name'];
	$targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
	$nomeAleatorio = uniqid() . strrchr($_FILES['Filedata']['name'], ".");
	//$targetFile = rtrim($targetPath,'/') . '/' . $_FILES['Filedata']['name'];
	$targetFile = rtrim($targetPath,'/') . '/' . $nomeAleatorio;
	
	// Validate the file type
	$fileTypes = array('jpg','jpeg','gif','png'); // File extensions
	$fileParts = pathinfo($_FILES['Filedata']['name']);
	
	if (in_array($fileParts['extension'],$fileTypes)) {
		move_uploaded_file($tempFile,$targetFile);
		//echo '1';
		echo $nomeAleatorio;
	} else {
		echo 'Invalid file type.';
	}
}
?>