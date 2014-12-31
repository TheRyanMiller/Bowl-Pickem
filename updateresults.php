<?php
	//Save Results of "UPDATE GAME RESULTS"
	//Delete games from seasonal game listings
	
	include 'login.php';
	include_once 'common.php';

	session_start();
	$uid = $_SESSION['uid'];
	
	function chooseWinners(){
		echo <table id='winnersTbl'>
		echo <thead><td></td><td>Bowl</td><td></td><td>Team 1</td><td></td><td>Team 2</td><td></td><td></td><td>Season</td><td></td></thead>
		echo <tbody id='winnersTblBody'>
		$gameQry = "SELECT games.id, games.bowl, games.team1, games.team2, seasons.title FROM games, seasons WHERE games.year = seasons.year AND seasons.current = 1";
		$result = mysqli_query($link, $gameQry);
		if (!$result) {errmsg('A database error occurred. Please contact Ryan.');}
		$rowCount = mysqli_num_rows($result);
		while ($row = mysqli_fetch_row($result)){
			echo "<tr><td>".$row[0]."</td>"; //gameid
			echo "<td>".$row[1]."</td>"; //bowl name
			echo "<td><input type='radio' name='".$row[0]."' value='".$row[2]."'/></td>";
			echo "<td>".$row[2]."</td>"; //team 1
			echo "<td><input type='radio' name='".$row[0]."' value='".$row[3]."'/></td>";
			echo "<td>".$row[3]."</td>"; //team 2
			echo "<td><input type='radio' name='".$row[0]."' value=''/></td>";
			echo "<td>Result undecided</td>";
			echo "<td>".$row[4]."</td>";
			echo "<td><button class='updateBtn' rel='".$row[0]."'>Update</button></td>";
			echo "<td><button class='delBtn' rel='".$row[0]."'>Delete Game</button></td>";
			echo "<td id='btnMsg'></td>";
			echo "</tr>";
		}
		echo </tbody>
		echo </table>
	}

	//Establish DB Connection
	$link = mysqli_connect($servername, $username,$password,$pickemDb);
	if (!$link){die("Connection error: " . mysqli_connect_errno());}
	errmsg($_POST['gameWinStr']);
	/*
	//Update user's confidence
	$i=0;
	$winner = $_POST['game'];
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
		$query = "UPDATE picks SET
				winner = '".$winTeam."'
				WHERE gameid = ".$gameId." 
				AND userid='".$uid."'";
		$result = mysqli_query($link, $query);
		if (!$result) {errmsg('A database error occurred. Please contact Ryan Thomas Miller.');}
	}
	*/
?>
