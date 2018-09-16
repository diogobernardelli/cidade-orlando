<?php @include_once('login.php'); ?>
<pre>
<?php

$rets = new PHRETS;

$connect = $rets->Connect($login, $un, $pw);

if($connect) {
	/* Get table layout */
	$fields = $rets->GetMetadataTable("Property", "Listing");
	
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