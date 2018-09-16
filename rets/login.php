<?php 
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

@include_once('PHRETS/vendor/autoload.php');

/////////////////////////// LOGIN INFO /////////////////////////////

// $login = 'http://rets.mfrmls.com/contact/rets/login';
$login = 'https://retsdd.mfrmls.com/matrixdd/rets/login';
$un = 'RETS1366';
$pw = '$nt8-Jj2';

////////////////////////////////////////////////////////////////////

$config = new \PHRETS\Configuration;
$config->setLoginUrl($login)
        ->setUsername($un)
        ->setPassword($pw)
        ->setRetsVersion('1.5');

$config->setOption('use_post_method', true);

$rets = new \PHRETS\Session($config);
$connect = $rets->Login();

?>