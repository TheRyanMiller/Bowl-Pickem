<?php
	include_once 'accesscontrol.php';
	include_once 'displaylogic.php';
	include_once 'common.php';
	include_once 'login.php';
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
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
  <script src="PickScript.js"></script>
  <style>
	#confidenceSort .bowl{background: #33CCCC; margin: 0; padding: 0; color: white;}
	#confidenceSort td{cursor: grab; border-radius: 3px; padding: 10px;font-size: 1em; height: 10px; background: #F0F0F0}
	#headerRow td {padding: 10px;font-weight: bold; background: #33CCCC; color: #FFFFFF; text-align: center; height: 10px;}
	#confidenceSort td.highlight {background: #33FF99; font-weight: bold;}
	#saveWarn {color: red;}
	#confirmSave {color: green;}
	#saveBtnRw {
		color: red;
		background: white;}
	#warnOrComp {
		background: white;
		color: red;
		}
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
						<li><a href='#' title='Leaderboard'>Leaderboard</a></li>
						<li><a href='#' title='Profile'>Profile</a></li>
						<li><a href='#' title='Blog'>Blog</a></li>
						<li><a href='#' title='Admin'>Admin</a></li>
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
		 <?php
		populatePickList($uid);
		 ?>
	</div>

</body>
</html>
