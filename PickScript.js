$(document).ready(function() {
	//Check if existing confidence rankings exist for user
		//if yes, print them to page
		//if no, print default list (by game ID)
		
		//Add form elements to string
		//http://api.jquery.com/serialize/

	var confidence;
	var winners;

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
		$('#confirmSave').text("");
		$('#saveWarn').text("You have made changes that have not been saved yet.");
		$(this).parent().addClass('highlight');
		var $td = $(this).parent();
		$td.siblings().removeClass('highlight');
		$td.next().addClass('highlight');
	});
		
	$('#confidenceSort').sortable({
			update: function() {
				confidence = $('#confidenceSort').sortable('serialize');
				winners = $('#winners').serialize();
				$('#confirmSave').text("");
				$('#saveWarn').text("You have made changes that have not been saved yet.");
			}
	});
	
	confidence = $('#confidenceSort').sortable('serialize');
				
	$('#saveBtn').click(function(){
				confidence = $('#confidenceSort').sortable('serialize');
				winners = $('#winners').serialize();
				$.post("postpicks.php", confidence, 
					function(result){
						//$('#postRes').text(result);
						//$('#responseText').text("CONFIDENCE Query is complete.");
					})
				$.post("postpicks.php", {winStr: winners}, 
					function(result){
						$('#confirmSave').text("Your picks have been successfully saved.");
						$('#saveWarn').text("");
						//$('#confirmSave').text(result);
				})
	});
});
