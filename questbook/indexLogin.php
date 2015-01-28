<html>
	<head>
		<meta charset="UTF-8">
		
		<!--JavaScript Global Variables-->
		<script>
			var scroll = 0;
		</script>
		
		<!--JQuery.js-->
		<script src="Libraries/jquery-2.0.3.js"></script>
		<script src="Libraries/jquery.color-2.1.2.js"></script>
		
		<!--SideButton.js-->
		<script src="Libraries/SideButton.js"></script>
		
		<!--Scoreboard.js-->
		<script src="Libraries/Scoreboard.js"></script>
		
		<!--QuestScroll.js-->
		<script src="Libraries/QuestScroll.js"></script>
		
		<!--QuestDynamicSize.js-->
		<script src="Libraries/QuestDynamicSize.js"></script>
		
		<!--CSS-->
		<link rel="stylesheet" type="text/css" href="Styles/index.css"> 
		<link rel="stylesheet" type="text/css" href="Styles/fonts.css"> 
		
		<!--Favicon-->
		<link rel="shortcut icon" href="Pictures/Favicon.ico">
		
		<title>QuestBook</title>
		
		<!--JavaScript-->
		<script>
			//Initialize SideButton Animation
			SideButtonAnimateElement("#BarLinkGateWay");
		
			//OnDocumentReady
			$(document).ready(function(){
				//Calculates total number of quests for each player
				$('.BarPlayer').each(function(i, obj) {
					var objs = $(this).children();
					objs.filter(".BarPlayerInfo").children().filter(".BarPlayerInfoQuests").text(objs.filter(".BarPlayerQuest").size() + " quests completed");
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

				//Hide/Show login area
				$("#ButtonShowLogin").click(function(){
					if($("#BarLogin").is(':animated') == false){
						$("#BarLogin").slideToggle();
						if($(this).attr("src") == "Pictures/ButtonArrowDown.png") {
							$(this).attr("src", "Pictures/ButtonArrowUp.png");
						} else {
							$(this).attr("src", "Pictures/ButtonArrowDown.png");
						}
					}
				});
				
				//Login
				$("#ButtonLogin").click(function(){
					if($("#ButtonLogin").attr("src") == "Pictures/ButtonLogin.png") {
						$("#ButtonLogin").attr("src", "Pictures/ButtonLogout.png");
						$("#LoginPasswordInput").css("display", "none");
						$("#LoginUserInput").css("display", "none");
						$("#LoggedUser").css("display", "initial");
					} else {
						$("#ButtonLogin").attr("src", "Pictures/ButtonLogin.png");
						$("#LoggedUser").css("display", "none");
						$("#LoginPasswordInput").css("display", "initial");
						$("#LoginUserInput").css("display", "initial");
					}
				});
				
			}); 
		</script>
	</head>
	<body>
		<div id="BarSideLeft">
			<!--<a href="https://twitter.com/TheQuestBook"><img src="Pictures/ButtonTwitter.png" id="ButtonTwitter"></a>
			-->
			<div class="BarTextVersion" style="margin-top: 5px; margin-bottom: 5px;">
				Zde mají být informace o verzi, toto je Beta, jsem líný ...
			</div>
			
			<div id="BarLogin">
				<img src="Pictures/ButtonLogin.png" id="ButtonLogin" style="width: 32px; height:32px; margin: 5px; float: left;">
				<input type="text" id="LoginUserInput" class="InputLogin" placeholder="Username" name="usr">
				<input type="password" id="LoginPasswordInput" class="InputLogin" placeholder="Password" name="pass">
				<span class="ObjCenter" id="LoggedUser" style="display: none;">Filip Šikula</span>
			</div>
			
			<div id="BarTitle">
				<img src="Pictures/ButtonArrowDown.png" id="ButtonShowLogin">
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
				Ready for an adventure?
			</div>
			
			<br>

			<div class="BarText" id="ScoreBoard">
				<p style="display: inline; font-size: 10px;">Click to scroll</p> <br>
			</div>
			
		</div>
		
		<img src="Pictures/ArrowLeft.png" id="ArrowLeft">
		<img src="Pictures/ArrowRight.png" id="ArrowRight">

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
		
		<div id="BarSideRight">
		
		</div>

	</body>
</html>
