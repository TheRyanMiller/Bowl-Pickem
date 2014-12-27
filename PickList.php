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
  <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css" />
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
  <script src="PickScript.js"></script>
  <style>
	#confidenceSort .bowl{background: #FFFFCC; margin: 0; padding: 0; }
	#confidenceSort td{padding: 10px;font-size: 1em; height: 10px; background: #F0F0F0}
	#headerRow td {padding: 10px;font-weight: bold; background: #483D8B; color: #FFFFFF; text-align: center; height: 10px;}
	#confidenceSort td.highlight {background: #33FF99;}
	#saveWarn {color: red;}
	#confirmSave {color: green;}
  </style>
</head>
<body>
 <?php
populatePickList($uid);
 ?>
	<div id="responseText"></div></div>

	<input id="saveBtn" type="button" value="Save" />
	<span id="saveWarn"></span>
	<span id="confirmSave"></span>
	<div id="postRes"></div>
</body>
</html>
