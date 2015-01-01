<?php
	include_once 'accesscontrol.php';
	include_once 'displaylogic.php';
	include_once 'common.php';
	include_once 'login.php';
	
	session_start();
	$uid = $_SESSION['uid'];
?>
<html lang="en">
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
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
  <script src="js/PickScript.js"></script>
  <style>
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
	<div id='pickTbl'>
		<br>_
		 <?php
		populatePickList($uid);
		 ?>
	</div>



<!-- Display lower third
-->

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
	</div>
</body>
</html>
