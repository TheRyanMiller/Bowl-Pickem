<?php
/*Each time PickList.php loads, it will return either default game order (direct from GAMES)
 * or it will return ordered list of USER picks.
 * When "Save" button is clicked, if user hasn't picked a winner
 * insert blank value for "Winner" in picks table to record a record
 * Set unique key on PICKS table and USE REPLACE INTO http://dev.mysql.com/doc/refman/5.0/en/replace.html
 * */
//has user made picks?
//SPIT FROM DB

	function populatePickList($user){
		//prep table HTML
		$bldTbl= "<form id='winners'><table id='confidenceTbl'><thead id='headerRow'><td>Bowl</td><td></td><td>Team 1</td><td></td><td>Team 2</td><td>Game Day</td></thead>".
				"<tbody id='confidenceSort'>";
		$endTbl="</tbody></tbody></table></form>";
				
		//pass db credentials to function
		include 'login.php';
		$link = mysqli_connect($servername,$username,$password,$pickemDb);
		if (!$link){die("Connection error: " . mysqli_connect_errno());}
		$sql = "SELECT * FROM picks WHERE userid = '".$user."'";
		$result = mysqli_query($link, $sql);
		if (!$result) {errmsg('A database error occurred. Please contact Ryan.');}
		$rowCount = mysqli_num_rows($result);
		//errmsg($user);
		if ($rowCount > 0){
			//SQL to get table populate information
			$sql= "SELECT games.id, games.team1, games.team2, games.date, games.bowl, picks.userid, picks.confidence, picks.winner ".
				"FROM picks ".
				"INNER JOIN games ON picks.gameid = games.id ".
				"WHERE picks.userid = '".$user."' ".
				"AND games.year = '2014' ".
				"ORDER BY picks.confidence ASC";
			$result = mysqli_query($link, $sql);
			if (!$result) {errmsg('A database error occurred. Please contact Ryan.');}
			$rowCount = mysqli_num_rows($result);
			echo "<br>Row Count: ".$rowCount."<br>";
			echo $bldTbl;
			//loop through games and output HTML string
			while ($row = mysqli_fetch_row($result)){
				//gameid[0], team1[1], team2[2], gameDay[3], bowl[4], userid[5], confidence[6], winner[7]
				echo "<tr id='game_".$row[0]."'><td class='bowl'>".$row[4]."</td>
				<td><input type='radio' name='".$row[0]."' value='".$row[1]."'></input>
				</td><td class='team1'>".$row[1]."</td><td>
				<input type='radio' name='".$row[0]."' value='".$row[2]."'></input>
				</td><td class='team2'>".$row[2]."</td><td class='gameDay'>".$row[3]."</td></tr>";
			}
			echo $endTbl;
		}
		else{
			echo "no rows found";
			//no picks made yet- print default set of games
			$sql="SELECT games.id, games.team1, games.team2, games.date, games.bowl ".
				"FROM games ".
				"WHERE games.year = '2014' ".
				"ORDER BY games.id ASC";
			$result = mysqli_query($link, $sql);
			if (!$result) {errmsg('A database error occurred. Please contact Ryan.');}
			$rowCount = mysqli_num_rows($result);
			echo $bldTbl;
			while ($row = mysqli_fetch_row($result)){
				//gameid[0], team1[1], team2[2], gameDay[3], bowl[4], userid[5], confidence[6], winner[7]
				echo "<tr id='game_".$row[0]."'><td class='bowl'>".$row[4]."</td>
				<td><input type='radio' name='".$row[0]."' value='".$row[1]."'></input>
				</td><td class='team1'>".$row[1]."</td><td>
				<input type='radio' name='".$row[0]."' value='".$row[2]."'></input>
				</td><td class='team2'>".$row[2]."</td><td class='gameDay'>".$row[3]."</td></tr>";
			}
			echo $endTbl;
		}
	}

//SEND TO DB

/*
	
<tr id=$gameId><td>$bowl</td><td>$team1</td><td>$team2</td><td>$gameDay</td></tr>

// Get your list items
var items = $('#confidenceSort').find('tr');

// The new index order for each item
var order = [4, 2, 0, 1, 3];

// Map the existing items to their new positions        
var orderedItems = $.map(order, function(value) {
    return items.get(value);
});

// Clear the old list items and insert the newly ordered ones
$('#mylist').empty().html(orderedItems);
*/
?>
