<?
ini_set('display_errors','Off');
setcookie('cidadeorlando_lang', '', null, '/');
unset($_COOKIE['cidadeorlando_lang']);
setcookie('cidadeorlando_lang', $_POST['lang'], time()+3600*24*30*12*5, '/');
exit('true');
?>