<?php
    include 'config.php';
	//$conn = new mysqli('pondacams.com','pondacam_live','Pondacams@123#','pondacam_live');
	$xml = json_decode(file_get_contents("http://api.currencylayer.com/live?access_key=e661ac291ed45c000d57ece8f5548656"));
	$rule = $conn -> getRow('USDZAR',['id'=>'1']);

	$rate = $xml -> quotes -> USDZAR;
	echo $rate;
	$upd  = $conn -> updateData('USDZAR',['rate'=> $rate],['id'=>'1']);
	

?>