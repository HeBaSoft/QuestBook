<?php
	//QuestBook Dynamic Quest Reader
	//Generates HTML elements by reading Files/QuestLog.txt file

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