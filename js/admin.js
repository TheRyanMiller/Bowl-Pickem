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

    $('#addGame').on('click', function(){
		//Form validation
//		if ($('#bowlName').value == null || $('#team1').value == null || $('#team2').value == null || $('#gameDay').value == null || $('#addSeason').value == null){
//			alert("Please fill out the required fields");
//			return false;
//		}
		//else
		if ($('#bowlName').value == "" || $('#team1').value == "" || $('#team2').value == "" || $('#gameDay').value == "" || $('#addSeason').value == ""){
			alert("Please fill out the required fields");
			return false;
		}
		//End form validation
		else{
			var gameInfo2 = $('#bowlName').val() + ";" + $('#team1').val() + ";" + $('#team2').val() + ";" + $('#gameDay').val() + ";" + $('#addSeason').val();
			$.post("updateresults.php", {gameStr: gameInfo2}, 
					function(result){
						$('#bowlName').value = "";
						$('#team1').value = $('#team1').defaultValue;
						$('#team2').value = "";
						//$('#addSeason').value = "";
						$('#gameDay').value = "";
						alert("added");
					})
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
