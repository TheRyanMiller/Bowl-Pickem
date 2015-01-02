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
});
