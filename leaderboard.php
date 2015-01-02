<html><html lang="en">
<head>
  <meta charset="utf-8">
  <title>College Bowl Picker Page</title>
	<!-- Basic Page Needs
  ================================================== -->
	<meta charset="utf-8">
	<title>College Football Pick Em</title>
	<meta name="description" content="">
	<meta name="author" content=" Made by Keyners">
    <meta http-equiv="X-UA-Compatible" content="IE=9" />


	<!-- Mobile Specific Metas
  ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- PT Sans -->
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,600&subset=latin,latin-ext' rel='stylesheet' type='text/css'>

	<!-- Crete Roung -->
	<link href='http://fonts.googleapis.com/css?family=Crete+Round&subset=latin,latin-ext' rel='stylesheet' type='text/css'>

	<!-- CSS
  ================================================== -->
  	<link rel="stylesheet" href="css/reset.css">
	<link rel="stylesheet" href="css/base.css">
	<link rel="stylesheet" href="css/skeleton.css">
	<link rel="stylesheet" href="css/layout.css">
  <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css" />
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>

  <style>
	#leaderboardTbl td{cursor: grab; border-radius: 0px; padding: 10px;font-size: 1em; height: 10px; background: #F0F0F0}
	#headerRow td {padding: 10px;font-weight: bold; background: #33CCCC; color: #FFFFFF; text-align: center; height: 10px;}
	#leaderbaordTbl td.highlight {background: #33FF99; font-weight: bold;}
	#leaderboardTbl tr { border: solid thin; }
	#pts {color: green; font-weight: bold;}
	form {
		margin: 0 auto;
		}
	}
	input 
	#saveBtn{
		text-align: center;
	}
	table {
    margin: 0 auto;
	}

  </style>
</head>
<body>
	<header>			
		<nav>
			<div class='container'>
				<div class='five columns logo'>
					<a href='#'>Logo Spot</a>
				</div>

				<div class='eleven columns'>
					<ul class='mainMenu'>
						<li><a href='index.html' title='Home'>Home</a></li>
						<li><a href='PickList.php' title='My Picks'>My Picks</a></li>
						<li><a href='leaderboard.php' title='Leaderboard'>Leaderboard</a></li>
						<li><a href='#' title='Profile'>Profile</a></li>
						<li><a href='#' title='Blog'>Blog</a></li>
						<li><a href='admin.php' title='Admin'>Admin</a></li>
					</ul>
				</div>
			</div>
		</nav>

		<div class='container'>
			<div class='slogan'>
				<div class='ten columns'>
					<h1>College Bowl Pick Em</h1>
					<h2>Prove your NCAA football fanhood.</h2>
				</div>

				<div class='six columns'>
					<h4>How to play</h4>
					<p>Join a league. Each participant picks the winners of each bowl game, and then sort each game by your level of confidence in your selections. A correct pick wins you the confidence points you've wagered on that game. Most points wins.</p>
					<a href='#' class='button medium blue'>Official Rules</a>
				</div>
			</div>
		</div>	
	</header>
	<div id='leaderboardTbl'>_
<?php
	
	include_once 'common.php';
	//Build leaderboard table
	$bldTbl= "<table id='leaderboardTbl'>
	<col width='10'><col width='180'><col width='10'><caption>Leaderboard</caption><thead id='headerRow'><td>Rank</td><td>Player</td><td>Points Scored</td></thead>
		<tbody id='lbTblBody'>";
	$endTbl="</tbody><tfoot></tfoot></table>";
	$season = "2014";		
	//pass db credentials to function
	include 'login.php';
	$link = mysqli_connect($servername,$username,$password,$pickemDb);
	if (!$link){die("Connection error: " . mysqli_connect_errno());}
	
	$scoreQry = "SELECT picks.userid AS Player, SUM( 
				CASE WHEN actResults.winner = picks.winner
				THEN picks.confidence
				ELSE 0 
				END ) AS Points, SUM( 
				CASE WHEN actResults.gameid IS NULL 
				THEN picks.confidence
				ELSE 0 
				END ) AS AvailablePoints
				FROM picks
				JOIN games ON games.id = picks.gameid
				LEFT 
				JOIN actResults ON actResults.gameid = games.id
				WHERE games.year =  '".$season."'
				GROUP BY picks.userid
				ORDER BY Points DESC";

	$result = mysqli_query($link, $scoreQry);
	if (!$result) {errmsg('A database error occurred. Please contact Ryan.');}
	$rowCount = mysqli_num_rows($result);
	echo $bldTbl;
	$i = 1;
	while ($row = mysqli_fetch_row($result)){
		//Player[0], Points[1], Available Points [2]
		echo "<tr id='user_".$row[0]."'><td align='center'>".$i."</td><td align='center' class='user'>".$row[0]."</td>
		<td align='center'><span id='pts'>".$row[1]."</span> (".$row[2].")</td></tr>";
		$i ++;
	}
	echo $endTbl;
	
	//Highlight current user's username in list

?>
</div>
	<div class='clear'></div>
	<div class='clear'></div>


	<div class='container'>

		<div class='one-third column'>
			<a href='PickList.php'><img src='images/mypicks.png'>
			<h3>My Picks</h3></a>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
		</div>


		<div class='one-third column'>
			<a href='leaderboard.php'><img src='images/misc/goals.png'>
			<h3>Leaderboard</h3></a>
			<p>Quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			cillum dolore eu fugiat nulla pariatur.</p>
		</div>



		<div class='one-third column'>
			<img src='images/misc/about_us.png'>
			<h3>Profile</h3>
			<p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
		</div>
		
	</div>


	<div class='clear'></div>


	<div class='blue'>

		<div class='container'>
			<h3>About this project</h3>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
			<a href='#' class='dalej'>Find it on GitHub</a>
		</div>

	</div>
</body>
</html>

