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
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
  <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
  <script src="http://code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
  <script src="PickScript.js"></script>
  <style>
	  #confidenceSort .bowl{background: #FFFFCC; margin: 0; padding: 0; }
	  #confidenceSort td {padding: 10px;font-size: 1em; height: 12px; background: #F0F0F0}
	  #headerRow td {padding: 10px;font-weight: bold; background: #483D8B; color: #FFFFFF; text-align: center;}
	  input[type=radio]:checked {background: green;}
  </style>
</head>
<body>
 <?php
populatePickList($uid);
 ?>
	<div id="responseText"></div></div>
	<div id="queryStr"></div>
	<div id="winarray"></div>
	<input id="saveBtn" type="button" value="Save" />
</body>
</html>
