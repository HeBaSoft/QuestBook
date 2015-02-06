<?php
	//QuestBook HTML Element Spawner
	//Generates PlayerBar and Quest Elements

	function AddElementPlayerBarBegin($playerId, $playerName) {
		echo "<div class='BarPlayer' style='left: " . (($playerId + 1) * 330) . "px;'>";
		echo    "<p id='BarPlayerScrollCounter'>0</p>";
		echo 	"<div class='BarPlayerInfo'>";
		echo 		"<p class='BarPlayerInfoName'>" . $playerName ."</p> <br>";
		echo 		"<p class='BarPlayerInfoQuests'>? quests completed</p>";
		echo 	"</div>";
		echo 	"<div class='BarPlayerScore'>" . "?" . "</div>";
		echo    "<div class='BarPlayerQuestScrollUp'>Up</div>";
	}
	
	function AddElementQuest($questTitle, $questImageUrl, $questScore, $questRank) {
		echo 	"<div class='BarPlayerQuest'>";
		echo 		"<img class='ImgQuest' src='Pictures/" . $questImageUrl . "'>";
		echo 		"<p class='BarPlayerQuestTitle'>" . $questTitle . "</p>";
		echo 		"<p class='BarPlayerQuestScore'>" . $questScore . "p</p>";
		if($questRank != "none") {
			echo 	"<p class='BarPlayerQuestRank'>" . $questRank . " Rank</p>";
		}
		echo 	"</div>";
	}
	
	function AddElementPlayerBarEnd() {
		echo    "<div class='BarPlayerQuestScrollDown'>Down</div>";
		echo "</div>";
	}
	
?> 