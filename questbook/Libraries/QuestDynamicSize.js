//QuestBook DynamicQuestSize script

//Hides quests that shouldn't be drawn
//Shows quest scroll-bars when needed
function HideOwerflowQuests() {
	$('.BarPlayerQuest').each(function(i, obj) {
		$(this).show();
	});
	
	$('.BarPlayerQuestScrollDown').each(function(i, obj) {
		$(this).hide();
	});
	
	$('.BarPlayerQuestScrollUp').each(function(i, obj) {
		$(this).hide();
	});

	$('.BarPlayer').each(function(i, obj) {
		var BarPlayerObj = $(this);
		var QuestObjs = $(this).children().filter(".BarPlayerQuest");
		var QuestsCountForPage = Math.floor(($(BarPlayerObj).height() - 95 - 40 - 10) / 85);
		
		BarPlayerObj.children().filter("#BarPlayerScrollCounter").text("0");
		
		if(QuestObjs.size() > QuestsCountForPage) {
			var objs = $(this).children();
			objs.filter(".BarPlayerQuestScrollDown").css("top", $(BarPlayerObj).height() - 35);
			objs.filter(".BarPlayerQuestScrollDown").show();
			objs.filter(".BarPlayerQuestScrollUp").show();
			QuestObjs.each(function(i, obj) {
				if(i > QuestsCountForPage - 1) { $(this).hide(); }
			});
		}
		
		var ScrollCounterObj = BarPlayerObj.children().filter("#BarPlayerScrollCounter");
		var ScrollButtonUp = BarPlayerObj.children().filter(".BarPlayerQuestScrollUp");
		if(ScrollCounterObj.text() != "0") {
			$(ScrollButtonUp).css("background-color", "#999791");
			$(ScrollButtonUp).css("color", "black");
		}else{
			$(ScrollButtonUp).css("background-color", "#A3A3B1");
			$(ScrollButtonUp).css("color", "#9797B2");
		}
		
		var ScrollButtonDown = BarPlayerObj.children().filter(".BarPlayerQuestScrollDown");
		if(parseInt(ScrollCounterObj.text()) <= QuestObjs.size()) {
			$(ScrollButtonDown).css("background-color", "#999791");
			$(ScrollButtonDown).css("color", "black");
		}else{
			$(ScrollButtonDown).css("background-color", "#A3A3B1");
			$(ScrollButtonDown).css("color", "#9797B2");
		}
	});
}

//OnWindowResize
$( window ).resize(function() {
	HideOwerflowQuests();
});

//OnDocumentReady
$(document).ready(function() {
	HideOwerflowQuests();
});