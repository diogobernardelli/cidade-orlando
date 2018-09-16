<?php
if ($_POST['arquivo'] != 'condutor_default.jpg'){
$caminho = $_SERVER['DOCUMENT_ROOT']."/tmp/".$_POST['arquivo'];
$caminhodois = $_SERVER['DOCUMENT_ROOT']."/uploads/".$_POST['arquivo'];

if (file_exists($caminho) and !empty($_POST['arquivo'])){
        // Removendo arquivo
        @unlink($caminho);
}
if (file_exists($caminhodois) and !empty($_POST['arquivo'])){
        // Removendo arquivo
        @unlink($caminhodois);
}
unset($caminho,$_POST);
}
?>