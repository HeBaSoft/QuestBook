//QuestBook Scoreboard
//OnDocumentReady
$(document).ready(function(){
	//Initialization of global variables
	var scoreIndex = 0;
	var score = new Array();

	//Calculates total score for players, create scoreboard array
	$('.BarPlayer').each(function(i, obj) {
		var objs = $(this).children();
		var totalvalue = 0;
		objs.filter(".BarPlayerQuest").each(function(i, obj) {
			$(this).children().filter(".BarPlayerQuestScore").each(function(i, obj) {
				var text = $(this).text();
				totalvalue += parseInt(text.substring(0, text.length - 1));
			});
		});
		scoreIndex++;
		objs.filter(".BarPlayerScore").text(totalvalue);
		score[scoreIndex] = totalvalue + "p | " + objs.filter(".BarPlayerInfo").children().filter(".BarPlayerInfoName").text();
	});
	
	//Sorting function for scoreboard
	function SortFunction(a,b) {
		var aVal = a.substring(0, a.indexOf("|") - 2);
		var bVal = b.substring(0, b.indexOf("|") - 2);
		return bVal - aVal;
	}
	
	//Sorts and draws scoreboard
	score.sort(SortFunction);
	for(var i = 0; i < scoreIndex; i++){
		$('#ScoreBoard').append("<p class='ScoreBoardLine'>" + score[i] + "</p><br>");
	}
	
	//Fast scroll using scoreboard
	$(".ScoreBoardLine").click(function() {
		var text = $(this).text();
		var name = text.substr(text.indexOf('|') + 2);
		var playerObjs = $("body").children().filter(".BarPlayer").children().filter(".BarPlayerInfo").children().filter(".BarPlayerInfoName");
		
		playerObjs.each(function(i, obj) {
			if($(this).text() == name){
				if(i > scroll + 2) {
					var offset = 0; if(i >= playerObjs.size() - 3) { offset = 2; }
					for(var s = 0; s < i - scroll - offset; s++){
						setTimeout(function(){
							$('#ArrowRight').click();
						},300 + s * 300);
					}
				}else if(i < scroll) {
					for(var s = 0; s < scroll - i; s++){
						setTimeout(function(){
							$('#ArrowLeft').click();
						},300 + s * 300);
					}
				}
				return(false); //break;
			}
		});
	});
});