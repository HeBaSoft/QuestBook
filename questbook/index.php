<html>
	<head>
		<meta charset="UTF-8">
		<script src="Libraries/jquery-2.0.3.js"></script>
		<script src="Libraries/jquery.color-2.1.2.js"></script>
		<link rel="stylesheet" type="text/css" href="Styles/index.css"> 
		<link rel="shortcut icon" href="Pictures/Favicon.ico">
		<title>QuestBook</title>
		
		<script>
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
			$(document).ready(function(){
				
				//Gateway API button animation
				$("#BarLinkGateWay").mouseenter(function(){
					var ThisObj = $(this);
					$(ThisObj).data("timer", setTimeout(function(){
						$(ThisObj).data("anim", true);
						$(ThisObj).stop(true, true).animate({
							width: '+=10px',
							'line-height': '+=10px',
							height: '+=10px',
							color: '#ffcc00'
						}, 250);
					}, 100));
				}).mouseout(function(){
					clearTimeout($(this).data("timer"));
					if($(this).data("anim") == true) {
						$(this).data("anim", false);
						$(this).stop(true, true).animate({
							width: '-=10px',
							'line-height': '-=10px',
							height: '-=10px',
							color: '#54504A'
						}, 95);
					}
				});
				
				//Player scroll function
				var scroll = 0;
				$("#ArrowRight").click(function(){
					if($('.BarPlayer').is(':animated') == false && scroll <= ($('.BarPlayer').length - 4)){
						$(".BarPlayer").stop().animate({
							left: '-=330px'
						},250);
						scroll++;
					}
				});
				
				$("#ArrowLeft").click(function(){
					if($('.BarPlayer').is(':animated') == false && scroll > 0){
						$(".BarPlayer").stop().animate({
							left: '+=330px'
						},250);
						scroll--;
					}
				});
			
				//Calculates total score for players, create scoreboard array
				var scoreIndex = 0;
				var score = new Array();
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
				
				//Calculates total number of quests for each player
				$('.BarPlayer').each(function(i, obj) {
					var objs = $(this).children();
					objs.filter(".BarPlayerInfo").children().filter(".BarPlayerInfoQuests").text(objs.filter(".BarPlayerQuest").size() + " quests completed");
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
				$(".ScoreBoardLine").click(function(){
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
				
				//Hides quests that shouldn't be drawn
				//Shows quest scroll-bars when needed
				HideOwerflowQuests();
				
				//Quest scroll function
				//ScrollDown
				$('.BarPlayerQuestScrollDown').click(function(){					
					var PlayerDiv = $(this).parent();
					var QuestObjs = PlayerDiv.children().filter(".BarPlayerQuest");
					var ScrollCounterObj = PlayerDiv.children().filter("#BarPlayerScrollCounter");
					var QuestsCountForPage = Math.floor(($(PlayerDiv).height() - 95 - 40 - 10) / 85);
					
					if(QuestObjs.is(':animated') == false){	
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
				$('.BarPlayerQuestScrollUp').click(function(){
					var PlayerDiv = $(this).parent();
					var QuestObjs = PlayerDiv.children().filter(".BarPlayerQuest");
					var ScrollCounterObj = PlayerDiv.children().filter("#BarPlayerScrollCounter");
					var QuestsCountForPage = Math.floor(($(PlayerDiv).height() - 95 - 40 - 10) / 85);
					
					if(QuestObjs.is(':animated') == false){
						var QuestScrollIndex = parseInt(ScrollCounterObj.text());
						if(ScrollCounterObj.text() != "0") {
							QuestObjs.each(function(i, obj) {
								if(i > QuestScrollIndex && QuestScrollIndex > 0) {
									if($(this).is(":visible") == false){
										QuestObjs.eq(i - 1).hide("200");
										QuestObjs.eq(QuestScrollIndex - 1).show("200");
										QuestScrollIndex--;
										return(false); //break;
									}else if(i == QuestObjs.size() - 1){
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
						}else{
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
				
				//Color ranked quests
				$(".BarPlayerQuestRank").each(function(i, obj) {
					QuestObj = $(this).parent();
					Data = $(this).text();

					switch(Data) {
						case "Bronze Rank":
							$(this).css("color", "#a36e28");
						break;
						
						case "Silver Rank":
							$(this).css("color", "#DDDDDD");
						break;
						
						case "Gold Rank":
							$(this).css("color", "#FFEA2D");
						break;
					}
				});
				
			}); 
		</script>
	</head>
	<body>
		<div id="BarSideLeft">
			<a href="https://twitter.com/TheQuestBook"><img src="Pictures/ButtonTwitter.png" id="ButtonTwitter"></a>
			<div class="BarTextVersion" style="margin-top: 5px; margin-bottom: 5px;">
				QuestBook, Version: 0.5, Last update: 26.11.2014
			</div>
			
			<div id="BarTitle">
				<img src="Pictures/QuestBook.png" class="ObjCenter">
				<div id="Title">QuestBook</div>
				<br>
			</div>
			
			<br>
			
			<div id="BarLinks">
				<div class="BarLinkBase" id="BarLinkGateWay" onclick="location.href='api.php'">
					QuestBook Gateway API
				</div>
			</div>
			<br>
			
			<div class="BarText">
				Welcome to QuestBook!<br>
			</div>
			
			<br>

			<div class="BarText" id="ScoreBoard">
				<p style="display: inline; font-size: 10px;">Click to scroll</p> <br>
			</div>
			
		</div>

		<?php
			$playerCount = 0;
			$file = fopen("Files/QuestLog.txt", "r");
			while(!feof($file)){
				$line = fgets($file);
				if(substr($line, 0, 7) == "player{"){
					$playerCount++;
					echo "<div class='BarPlayer' style='left: " . ($playerCount * 330) . "px;'>";
				}					
				else if(substr($line, 0, 5) == "name=") {
					$player = substr($line, 5);
					echo    "<p id='BarPlayerScrollCounter'>0</p>";
					echo 	"<div class='BarPlayerInfo'>";
					echo 		"<p class='BarPlayerInfoName'>" . $player ."</p> <br>";
					echo 		"<p class='BarPlayerInfoQuests'>? quests completed</p>";
					echo 	"</div>";
					echo 	"<div class='BarPlayerScore'>" . "?" ."</div>";
					echo    "<div class='BarPlayerQuestScrollUp'>Up</div>";
				}
				else if(substr($line, 0, 6) == "quest{") {
					echo 	"<div class='BarPlayerQuest'>";
				}
				else if(substr($line, 0, 6) == "title=") {
					$title = substr($line, 6);
					echo 		"<p class='BarPlayerQuestTitle'>" . $title . "</p>";
				}
				else if(substr($line, 0, 4) == "img=") {
					$img = substr($line, 4);
					echo 		"<img class='ImgQuest' src='Pictures/" . $img . "'>";
				}
				else if(substr($line, 0, 6) == "score=") {
					$score = substr($line, 6, -2);
					echo 		"<p class='BarPlayerQuestScore'>" . $score . "p</p>";
				}
				else if(substr($line, 0, 5) == "rank=" && substr($line, 0, 9) != "rank=none") {
					$rank = substr($line, 5, -2);
					echo 		"<p class='BarPlayerQuestRank'>" . $rank . " Rank</p>";
				}
				else if(substr($line, 0, 2) == "};") {
					echo    "<div class='BarPlayerQuestScrollDown'>Down</div>";
					echo "</div>";
				}
				else if(substr($line, 0, 1) == "}") {
					echo "</div>";
				}
			}						
			fclose($file);
		?> 
		
		<img src="Pictures/ArrowLeft.png" id="ArrowLeft">
		<img src="Pictures/ArrowRight.png" id="ArrowRight">
		
		<div id="BarSideRight">
		
		</div>

	</body>
</html>