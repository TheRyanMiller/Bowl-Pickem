function seasonSelect(season){
	$.post("updateresults.php", {season: test}, function(result){
		errmsg(season);
	});
};

jQuery(document).ready(function() {
    jQuery('.tabs .tab-links a').on('click', function(e)  {
        var currentAttrValue = jQuery(this).attr('href');
 
        // Show/Hide Tabs
        jQuery('.tabs ' + currentAttrValue).show().siblings().hide();
 
        // Change/remove current tab to active
        jQuery(this).parent('li').addClass('active').siblings().removeClass('active');
 
        e.preventDefault();
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
