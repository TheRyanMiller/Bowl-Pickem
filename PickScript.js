$(document).ready(function() {
	//Check if existing confidence rankings exist for user
		//if yes, print them to page
		//if no, print default list (by game ID)
		
		//Add form elements to string
		//http://api.jquery.com/serialize/

	var confidence;
	var winners;
	$('#confidenceSort').sortable({
			update: function() {
				confidence = $('#confidenceSort').sortable('serialize');
				winners = $('#winners').serialize();
				$('#queryStr').text(confidence);
				$('#winarray').text(winners);
				
				//IGNORE
				//var list = $('#confidenceSort').find('tr');
				//var str="";
				//var z;
				//for (var z = 0; z < list.length; ++z) {
				//	list[z].id = 1;
				//	str = str + list[z].id;
				//}
				//$('#confidenceSort').empty();
				//alert(str);
			}
	});
	
	confidence = $('#confidenceSort').sortable('serialize');
				
	$('#saveBtn').click(function(){
				confidence = $('#confidenceSort').sortable('serialize');
				winners = $('#winners').serialize();
				$.post("postpicks.php", confidence, 
					function(result){
						//$('#responseText').text("CONFIDENCE Query is complete.");
					})
				$.post("postpicks.php", {winStr: winners}, 
					function(result){
						$('#responseText').text("WINNERS Query is complete." + result);
					})
		});
});
