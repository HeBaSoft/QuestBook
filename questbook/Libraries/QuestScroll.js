//QuestBook QuestScroll for index.php
//OnDocumentReady
$(document).ready(function() {
	//Hides Arrow Buttons when needed
	if($(".BarPlayer").size() <= 3) {
		$("#ArrowRight").hide();
	}
	$("#ArrowLeft").hide();	

	//Player scroll function
	$("#ArrowRight").click(function() {
		if($('.BarPlayer').is(':animated') == false && scroll < ($('.BarPlayer').size() - 3)){
			$(".BarPlayer").stop().animate({
				left: '-=330px'
			},250);
			
			scroll++;
			if(scroll >= ($('.BarPlayer').size() - 3)) { $(this).hide(); }
			$("#ArrowLeft").show();	
		}
	});
	
	$("#ArrowLeft").click(function( ){
		if($('.BarPlayer').is(':animated') == false && scroll > 0){
			$(".BarPlayer").stop().animate({
				left: '+=330px'
			},250);
			
			scroll--;
			if(scroll <= 0) { $(this).hide(); }
			$("#ArrowRight").show();
		}
	});
	
	//Quest scroll function
	//ScrollDown
	$('.BarPlayerQuestScrollDown').click(function() {					
		var PlayerDiv = $(this).parent();
		var QuestObjs = PlayerDiv.children().filter(".BarPlayerQuest");
		var ScrollCounterObj = PlayerDiv.children().filter("#BarPlayerScrollCounter");
		var QuestsCountForPage = Math.floor(($(PlayerDiv).height() - 95 - 40 - 10) / 85);
		
		if(QuestObjs.is(':animated') == false) {	
			var QuestScrollIndex = parseInt(ScrollCounterObj.text());
			
			QuestObjs.each(function(i, obj) {
				if(i > QuestScrollIndex && $(this).is(":visible") == false) {
					$(this).show("200");
					QuestObjs.eq(QuestScrollIndex).hide("200");
					QuestScrollIndex++;
					return(false); //break;
				}
			});
			ScrollCounterObj.text(QuestScrollIndex);
			
			if(QuestScrollIndex > 0) {
				var ScrollButtonUp = PlayerDiv.children().filter(".BarPlayerQuestScrollUp");
				$(ScrollButtonUp).css("background-color", "#999791");
				$(ScrollButtonUp).css("color", "black");
			}
			
			if(QuestsCountForPage + QuestScrollIndex != QuestObjs.size()) {
				$(this).css("background-color", "#999791");
				$(this).css("color", "black");
			} else {
				$(this).css("background-color", "#A3A3B1");
				$(this).css("color", "#9797B2");
			}
		}
	});
	
	//Quest scroll function
	//ScrollUp
	$('.BarPlayerQuestScrollUp').click(function() {
		var PlayerDiv = $(this).parent();
		var QuestObjs = PlayerDiv.children().filter(".BarPlayerQuest");
		var ScrollCounterObj = PlayerDiv.children().filter("#BarPlayerScrollCounter");
		var QuestsCountForPage = Math.floor(($(PlayerDiv).height() - 95 - 40 - 10) / 85);
		
		if(QuestObjs.is(':animated') == false) {
			var QuestScrollIndex = parseInt(ScrollCounterObj.text());
			if(ScrollCounterObj.text() != "0") {
				QuestObjs.each(function(i, obj) {
					if(i > QuestScrollIndex && QuestScrollIndex > 0) {
						if($(this).is(":visible") == false){
							QuestObjs.eq(i - 1).hide("200");
							QuestObjs.eq(QuestScrollIndex - 1).show("200");
							QuestScrollIndex--;
							return(false); //break;
						}else if(i == QuestObjs.size() - 1) {
							QuestObjs.eq(i).hide("200");
							QuestObjs.eq(QuestScrollIndex - 1).show("200");
							QuestScrollIndex--;
							return(false); //break;
						}
					}
				});
				
				ScrollCounterObj.text(QuestScrollIndex);
			}
			
			if(QuestScrollIndex > 0) {
				$(this).css("background-color", "#999791");
				$(this).css("color", "black");
			} else {
				$(this).css("background-color", "#A3A3B1");
				$(this).css("color", "#9797B2");
			}
			
			if(QuestsCountForPage + QuestScrollIndex != QuestObjs.size()) {
				var ScrollButtonDown = PlayerDiv.children().filter(".BarPlayerQuestScrollDown");
				$(ScrollButtonDown).css("background-color", "#999791");
				$(ScrollButtonDown).css("color", "black");
			}
		}
	});
});