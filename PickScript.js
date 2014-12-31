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
		$('#warnOrComp').text("You have made changes that have not been saved yet.");
		$('#warnOrComp').css('color', 'red', 'font-weight', 'bold');
		$(this).parent().addClass('highlight');
		var $td = $(this).parent();
		$td.siblings().removeClass('highlight');
		$td.next().addClass('highlight');
	});
	//Count number of rows in table
	var numRows = document.getElementById('confidenceTbl').getElementsByTagName('tbody')[0].getElementsByTagName('tr').length;

	//On resort
	$('#confidenceSort').sortable({
			update: function( event, ui ) {
				confidence = $('#confidenceSort').sortable('serialize');
				$(this).find('tr').each(function(i){
					$(this).find('td:last').text(numRows-i);
				});
				winners = $('#winners').serialize();
				$('#warnOrComp').text("You have made changes that have not been saved yet.");
				$('#warnOrComp').css('color', 'red');
			}
	});
	
	confidence = $('#confidenceSort').sortable('serialize');
				
	$('#saveBtn').click(function(){
				confidence = $('#confidenceSort').sortable('serialize');
				winners = $('#winners').serialize();
				$.post("postpicks.php", confidence, 
					function(result){
					})
				$.post("postpicks.php", {winStr: winners}, 
					function(result){
						$('#warnOrComp').text("Your picks have been successfully saved!");
						$('#warnOrComp').css('color', 'green');
				})
	});
});
