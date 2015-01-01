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



//------------------------
//GAME RESULTS TAB
//------------------------

	if (isset($_POST['seasonStr'])){
		$seasonStr=$_POST['seasonStr'];
		errmsg($seasonStr);
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

?>
