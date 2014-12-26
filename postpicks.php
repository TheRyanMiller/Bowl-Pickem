<?php

	require_once 'login.php';
	require_once 'accesscontrol.php';
	
	//Establish DB Connection
	$link = mysqli_connect($servername, $username,$password,$pickemDb);
	if (!$link){die("Connection error: " . mysqli_connect_errno());}
	
	//Update user's confidence
	$i=0;
	
	$result = mysqli_query($link, $query);
	foreach ($_POST['game'] as $value) {
		$query = "REPLACE INTO picks SET
				userid = '".$uid."',
				gameid = ".$value.",
				confidence = ".$i;
		$result = mysqli_query($link, $query);
		$i++;
		if (!$result) {errmsg('A database error occurred. Please contact Ryan.');}
	}
	//Reset counter
	$i=0;
	foreach ($_POST['winner'] as $value) {
		$query = "REPLACE INTO picks SET
				winner = '".$i."'
				WHERE gameid = ".$winner.",
				AND userid='".$uid."'";
		errmsg($query);
		$result = mysqli_query($link, $query);
		$i++;
		if (!$result) {errmsg('A database error occurred. Please contact Ryan.');}
	}
	echo $query;
	//Update user's winner picks
	//      $_POST['winner']

?>
