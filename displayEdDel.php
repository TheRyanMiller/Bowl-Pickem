<html>
<head>
	<link rel="stylesheet" href="css/reset.css">
	<link rel="stylesheet" href="css/base.css">
	<link rel="stylesheet" href="css/skeleton.css">
	<link rel="stylesheet" href="css/layout.css">
	<link rel="stylesheet" href="css/admin.css">
	<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css" />
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
	<script src="js/admin.js"></script>
	<script>
	$(document).ready(function() {
		
		var recordInfo;
		var recordId;
		var svSeasonStr;
		
		//disable all inputs on page load
		$('#seasonList').find('tr td input:enabled').each(function(){
			$(this).prop('disabled', true);
		});
		
		//auto-size
		$('.varLength').each(function(){
			var value = $(this).val();
			var size  = value.length * 2;
			$(this).css('size',size*4);
			$('.yearId').css('size',size*4);
		})
		
		$('input').each(function(){
			var value = 20;
			var size  = value.length * 2;
			$(this).css('size',size*4);
			$('.yearId').css('size',size*4);
		})

		//toggle disable/enable on "edit click"
		$("table tr .editBtn").on('click', function(e){
			$(this).closest('td').parent().find('td input').each(function(){
				//toggle
				if ($(this).is(':disabled')){
					$(this).prop('disabled', false);
				}
				else{
					$(this).prop('disabled', true);
				}
			});
		});
		
		//Save Edits to season
		$("#saveSeasonEdit").on('click', function(e){
			//find season records that are enabled and build a string
			svSeasonStr ="";
			numInputs = $('#seasonList').find('tr td input:enabled').length;
			if (numInputs == 0){
				alert('You have not selected any records for edit.');
			}
			else{
				//iterate over rows
				$('#seasonList').find('tr').each(function(){
					//check if inputs on this row are enabled
					if($(this).find('td input:enabled').length > 0){
							//is this first input?
							if (svSeasonStr==""){
								//do nothing
							}
							else{
								//this is not first input so add ampersand
								svSeasonStr = svSeasonStr + "&";
							}
							//iterate through enabled inputs on this row
							$(this).find('td input:enabled').each(function(){
								if (svSeasonStr==""){
									svSeasonStr = $(this).val() + ";";
								}
								else{
									svSeasonStr = svSeasonStr + $(this).val() + ";";
								}
							});
					}
					});
				alert(svSeasonStr);
				$.post("updateresults.php", {recordEdit: svSeasonStr}, 
						function(result){
							if(!result){
								$('#textput').empty();
								$('#textput').text('Success');
								$('#textput').addClass('confirmText');

							}
							else{
								$('#textput').empty();
								$('#textput').text('Failed');
							}
						}
				);
			};
			
			});
		
		$(".deleteBtn").on('click', function(e){
			var r = confirm("Are you sure you want to delete this record?");
			if (r == true) {
				$(this).closest('td').parent().find('td input').each(function(){
					recordInfo = recordInfo + $(this).val();
				});
				recordId = $(this).closest('td').parent().find('td input').first().val();
				rowToDelete = $(this).closest('td').parent()
				$.post("updateresults.php", {recordDel: recordId}, 
						function(result){
							if(result){
								var delRecordErr = "There was a problem deleting this record from the database.";
							}
							else{
								rowToDelete.remove();
							}
						});
			}
		});
	});
	
	</script>
	<style>
		input {
			width:100%;
			box-sizing:border-box;
			-moz-box-sizing:border-box;
}
		#containerDiv {
			width:80%;
			margin:0 auto;
		}
		#right {
			width:50%;
			height: 200px;
			float:left;
			background: red;
		}
		#phpOut {
			width:50%;
			float:right;
			background: blue;
		}
	</style>
</head>
<body>

<div id='containerDiv'>
	<div id='right'>
	</div>
	<div id='phpOut'>
		<?php
			//Database stuff
			include_once 'login.php';
			include_once 'common.php';
			$link = mysqli_connect($servername,$username,$password,$pickemDb);
			if (!$link){die("Connection error: " . mysqli_connect_errno());}
			$listSeasonsQry ="SELECT year, startDate, lockDate, endDate, title FROM seasons";
			$result = mysqli_query($link, $listSeasonsQry);
			if (!$result) {errmsg('A database error occurred. Please contact Ryan.');}

			//Build 5 column table (year, startDate, lockDate, endDate, title)
			$tableStart="<table id='seasonList'><thead><tr></tr><td>Year</td><td>Start</td><td>Lock</td><td>End</td><td>Title</td><td></td><td></td></tr></thead><tbody>";
			$tableEnd="</tbody><tfoot><tr><td colspan='4'><button id='saveSeasonEdit'>Save Edits</button></td></tr></tfoot></table>";
			echo $tableStart;
			
			//Display list of records
			while ($row = mysqli_fetch_row($result)){
				echo "<tr><td><input id='".$row[0]."' type='text' class='varLength' value='".$row[0]."' disabled /> </td>";
				echo "<td><input id='startDate_".$row[0]."' type='date' class='varLength' value='".$row[1]."' disabled /> </td>";
				echo "<td><input id='lockDate_".$row[0]."' type='date' class='varLength' value='".$row[2]."' disabled /> </td>";
				echo "<td><input id='endDate_".$row[0]."' type='date' class='varLength' value='".$row[3]."' disabled /> </td>";
				echo "<td><input id='title_".$row[0]."' type='text' class='varLength' value='".$row[4]."' disabled /> </td>"; 
				//Add edit and delete button rows
				echo "<td><button class='editBtn' id='edit_".$row[0]."'>Edit</button></td>";
				echo "<td><button class='deleteBtn' id='delete_".$row[0]."'>Delete</button></td></tr>";
			}
			echo $tableEnd;
			echo "<div id='textput'></div>";
			//Edit Delete Actions

		?>
	</div>
	</div>
</body>
</html>
