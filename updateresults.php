<?php
	//Save Results of "UPDATE GAME RESULTS"
	//Delete games from seasonal game listings
	include_once 'login.php';
	include_once 'common.php';
	$link = mysqli_connect($servername, $username,$password,$pickemDb);
	if (!$link){die("Connection error: " . mysqli_connect_errno());}


//------------
//ADD GAME TAB
//------------
	if(isset($_POST['gameStr'])){
		//VALIDATE FIELDS ARE FULL/VALID!!!
		$gameStr = $_POST['gameStr'];
		$gameInfo = explode(';', $gameStr);
		//bowl;team1;team2;gameDay;addSeason
		$addGameQry = "INSERT INTO games (bowl, team1, team2, date, year)
						VALUES ('".$gameInfo[0]."', '".$gameInfo[1]."', '".$gameInfo[2]."', '".$gameInfo[3]."', '".$gameInfo[4]."')";
		$result = mysqli_query($link, $addGameQry);
		if (!$result) {errmsg('A database error occurred. Please contact Ryan.');}
		else {
		}
	}

//------------
//ADD SEASON TAB
//------------

	if(isset($_POST['seasonStr'])){
		//VALIDATE FIELDS ARE FULL/VALID!!!
		$seasonStr = $_POST['seasonStr'];
		$seasonInfo = explode(';', $seasonStr);
		//year;title;startDate;lockDate;endDate
		$addSeasonQry = "INSERT INTO seasons (year, title, startDate, lockDate, endDate)
						VALUES ('".$seasonInfo[0]."', '".$seasonInfo[1]."', '".$seasonInfo[2]."', '".$seasonInfo[3]."', '".$seasonInfo[4]."')";
		$result = mysqli_query($link, $addSeasonQry);
		if (!$result) {errmsg('A database error occurred. Please contact Ryan.');}
		else {
		}
	}


//------------------------
//GAME RESULTS TAB
//------------------------

	if (isset($_POST['aaa'])){

	}
	
	function chooseWinners(){
		echo "<table id='winnersTbl'>";
		echo "<thead><td></td><td>Bowl</td><td></td><td>Team 1</td><td></td><td>Team 2</td><td></td><td></td><td>Season</td><td></td></thead>";
		echo "<tbody id='winnersTblBody'>";
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
	echo "</tbody>";
	echo "</table>";
	};


//------------
//USER PAYMENTS TAB
//------------



//RESULTS DISPLAY RECORD ACTIONS
//Delete

	if(isset($_POST['recordDel'])){
		$recordId = $_POST['recordDel'];
		//$delRecordInfo = explode(';', $recordId);
		$delSeasonQry = "DELETE FROM seasons WHERE year = '".$recordId."'";
		$result = mysqli_query($link, $delSeasonQry);
		if (!$result) {errmsg('A database error occurred. Please contact Ryan.');}
		else {
		}
	}
//Edit Season
	if(isset($_POST['recordEdit'])){
		$editStr = $_POST['recordEdit'];
		$editStr = substr($editStr, 0, -1);
		$editRecs = explode('&', $editStr);
		foreach($editRecs as $value){
			$indvEdits = explode(';', $value);
			$editSeasonQry = "UPDATE seasons SET year='".$indvEdits[0]."', startDate='".$indvEdits[1]."', lockDate='".$indvEdits[2]."', endDate='".$indvEdits[3]."', title='".$indvEdits[4]."' WHERE year = '".$indvEdits[0]."'";
			$result = mysqli_query($link, $editSeasonQry);
			if (!$result) {errmsg('A database error occurred. Please contact Ryan.');}
		}
	}

?>
