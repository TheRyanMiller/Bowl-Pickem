function seasonSelect(season){
	alert(season);
	$.post("updateresults.php", {seasonStr: season}, function(result){
		//{pickupname : stringofdata}
	});
};

$(document).ready(function() {

    $('.tabs .tab-links a').on('click', function(e)  {
        var currentAttrValue = $(this).attr('href');
 
        // Show/Hide Tabs
        $('.tabs ' + currentAttrValue).show().siblings().hide();
 
        // Change/remove current tab to active
        $(this).parent('li').addClass('active').siblings().removeClass('active');
 
        e.preventDefault();
    });

//
//
//ADD GAME FORM SUBMIT
//
//
    $('#addGame').on('click', function(){
		if ($('#bowlName').val() == "" || $('#team1').val() == "" || $('#team2').val() == "" || $('#gameDay').val() == "" || $('#selectSeason').val() == ""){
			alert("Please fill out the required fields");
			return false;
		}
		//End form validation
		else{
			var gameInfo2 = $('#bowlName').val() + ";" + $('#team1').val() + ";" + $('#team2').val() + ";" + $('#gameDay').val() + ";" + $('#selectSeason').val();
			//alert(gameInfo2);

			$.post("updateresults.php", {gameStr: gameInfo2}, 
					function(result){
						if(result){
							var addGameConf = "There was a problem adding this to the database.";
							$('#addGameMsg').removeClass('confirmText');
							$('#addGameMsg').addClass('warnText');
							$('#addGameMsg').text(addGameConf);
						}
						else{
							var bowl = $('#bowlName').val();
							var addGameConf = "Successfully added " + bowl + " to the database";
							$('#addGameMsg').text(addGameConf);
							$('#addGameMsg').removeClass('warnText');
							$('#addGameMsg').addClass('confirmText');
							$('#bowlName').val('');
							$('#team1').val('');
							$('#team2').val('');
							$('#selectSeason').val('');
							$('#gameDay').val('');
						}
					}
			)			
		}
	});

//
//
//ADD SEASON FORM SUBMIT
//
//
    $('#addSeason').on('click', function(){
		if ($('#seasonYear').val() == "" || $('#seasonTitle').val() == "" || $('#seasonStart').val() == "" || $('#seasonLock').val() == "" || $('#seasonEnd').val() == ""){
			alert("Please fill out the required fields");
			return false;
		}
		//End form validation
		else{
			var seasonInfo2 = $('#seasonYear').val() + ";" + $('#seasonTitle').val() + ";" + $('#seasonStart').val() + ";" + $('#seasonLock').val() + ";" + $('#seasonEnd').val();
			alert(seasonInfo2);

			$.post("updateresults.php", {seasonStr: seasonInfo2}, 
					function(result){
						if(result){
							var addGameConf = "There was a problem adding this to the database.";
							$('#addSeasonMsg').removeClass('confirmText');
							$('#addSeasonMsg').addClass('warnText');
							$('#addSeasonMsg').text(addGameConf);
						}
						else{
							var seasonTitle = $('#seasonTitle').val();
							var addSeasonConf = "Successfully added " + seasonTitle + " to the database";
							$('#addSeasonMsg').text(addSeasonConf);
							$('#addSeasonMsg').removeClass('warnText');
							$('#addSeasonMsg').addClass('confirmText');
							$('#seasonYear').val('');
							$('#seasonTitle').val('');
							$('#seasonStart').val('');
							$('#seasonLock').val('');
							$('#seasonEnd').val('');
						}
					}
			)			
		}
	});
    
	//highlight buttons green
	$('input:radio').each(function(i,e) {
		if($(e).is(':checked')){
			$(e).parent().addClass('highlight');
			var $td = $(e).parent();
			$td.siblings().removeClass('highlight');
			$td.next().addClass('highlight');
		}
	});
	$('input:radio').change(function() {
		$('#btnMsg').text("You have made changes that have not been saved yet.");
		$('#btnMsg').css('color', 'red', 'font-weight', 'bold');
		$(this).parent().addClass('highlight');
		var $td = $(this).parent();
		$td.siblings().removeClass('highlight');
		$td.next().addClass('highlight');
	});
	
	$('.updateBtn').click(function(){
				var game = $(this).attr('rel');
				var winner = $("input:checked[name='"+ game +"']").val();
				var gameWinStr = game + ";" + winner;
				alert(gameWinStr);
				$.post("updateresults.php", {gameWinStr: winner}, 
					function(result){
						$('#btnMsg').text("Winner has been saved!");
						$('#btnMsg').css('color', 'green');
					}
				)
				/*
				$.post("postpicks.php", {winStr: winners}, 
					function(result){
						$('#warnOrComp').text("Your picks have been successfully saved!");
						$('#warnOrComp').css('color', 'green');
				})
				*/
	});
	
	$('.delBtn').click(function(){
				var gameid = $(this).attr('rel');
				alert(gameid);
	});
	
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
		$(this).css('width',size*4);
		$('.yearId').css('width',size*4);
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
			$.post("updateresults.php", {recordEdit: svSeasonStr}, 
					function(result){
						if(!result){
							$('#textput').empty();
							$('#textput').text('Edits saved successfully.');
							$('#textput').addClass('confirmText');
							}
						else{
							$('#textput').empty();
							$('#textput').text('Edits failed. Please contact Ryan.');
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
