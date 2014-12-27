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
	$winners=$_POST['winStr'];
	$winArr = explode("&", $winners);

	foreach ($winArr as $value){
		$data = explode("=",$value);
		$gameId = $data[0];
		$winTeam = str_replace("+", " ", $data[1]);
		echo $winTeam;
		$query = "UPDATE picks SET
				winner = '".$winTeam."'
				WHERE gameid = ".$gameId." 
				AND userid='".$uid."'";
		$result = mysqli_query($link, $query);
		if (!$result) {errmsg('A database error occurred. Please contact Ryan.');}
	}
	echo "aaaaaa";
	echo $query;
	echo "bbbbbb";
?>
