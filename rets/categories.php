<?php @include_once('login.php'); ?>
<pre>
<?php

$config = new \PHRETS\Configuration;
$config->setLoginUrl($login)
        ->setUsername($un)
        ->setPassword($pw)
        ->setRetsVersion('1.7.2');

$rets = new \PHRETS\Session($config);
$connect = $rets->Login();

if($connect) {
	/* Get table layout */
	$fields = $rets->GetMetadataTable("Property", "Listing");
	var_dump($fields);
	/* Take the system name / human name and place in an array */
	$table = array();
	$string = '';
	foreach($fields as $field) {
		$table[$field['SystemName']] = $field['LongName'];
		$string .= $field['SystemName'].',';
	}

	/* Display output */
	print_r($table);
	echo '<br><br>';
	echo $string;
	$rets->Disconnect();
} else {
	$error = $rets->Error();
	print_r($error);
}

?>
</pre>