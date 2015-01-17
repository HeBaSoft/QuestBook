<?php
	//QuestBook GateWay API

	//This is a horrible way how to do it, but I have no idea how to do it the normal way
	$special = array("ě", "š", "č", "ř", "ž", "ý", "á", "í", "é", "ü", "ú", "ů", "Ě", "Š", "Č", "Ř", "Ž", "Ý", "Á", "Í", "É", "Ü", "Ú", "Ů");
	$normal =  array("e", "s", "c", "r", "z", "y", "a", "i", "e", "u", "u", "u", "E", "S", "C", "R", "Z", "Y", "A", "I", "E", "U", "U", "U");

	if (isset($_POST['GetUsers'])) {
		$players = "";
	
		$file = fopen("Files/QuestLog.txt", "r");
		while(!feof($file)) {
			$line = fgets($file);
			if(substr($line, 0, 5) == "name=") {
				$players = $players . substr($line, 5, -2) . ",";
			}
		}
		fclose($file);
	
		if(isset($_POST['ASCII'])) {
			echo str_replace($special, $normal, $players);
		} else {
			echo $players;
		}
	}else if (isset($_POST['GetUserQuests'])) {
		$UserName = $_POST['GetUserQuests'];
		
		$IsReadingQuest = false;
		$IsReadingUser = false;
		$Data = "";
	
		$file = fopen("Files/QuestLog.txt", "r");
		while(!feof($file)) {
			$line = fgets($file);
			if(substr($line, 0, 5) == "name=" && (substr($line, 5, -2) == $UserName || str_replace($special, $normal, substr($line, 5, -2)) == str_replace($special, $normal, $UserName) )) {
				$IsReadingUser = true;
			}
			else if(substr($line, 0, 6) == "quest{" && $IsReadingUser == true) {
				$IsReadingQuest = true;
			}
			else if(substr($line, 0, 6) == "title=" && $IsReadingQuest == true) {
				$Data = $Data . substr($line, 6, -2) . ",";
			}
			else if(substr($line, 0, 1) == "}") {
				if($IsReadingQuest == true){
					$IsReadingQuest = false;
				}else if($IsReadingUser == true){
					$IsReadingUser = false;
					break;
				}
			}
		}
		fclose($file);
	
		if(isset($_POST['ASCII'])) {
			echo str_replace($special, $normal, $Data);
		} else {
			echo $Data;
		}
	} else if (isset($_POST['GetUserQuestsDetailed'])) {
		$ImagePath = "http://questbook.hebasoft.net/Pictures/";
		$UserName = $_POST['GetUserQuestsDetailed'];
		
		$IsReadingQuest = false;
		$IsReadingUser = false;
		
		$Img = "";
		$Title = "";
		$Score = "";
		$Rank = "";
		$Data = "";
	
		$file = fopen("Files/QuestLog.txt", "r");
		while(!feof($file)) {
			$line = fgets($file);
			if(substr($line, 0, 5) == "name=" && (substr($line, 5, -2) == $UserName || str_replace($special, $normal, substr($line, 5, -2)) == str_replace($special, $normal, $UserName) )) {
				$IsReadingUser = true;
			}
			else if(substr($line, 0, 6) == "quest{" && $IsReadingUser == true) {
				$IsReadingQuest = true;
			}
			else if(substr($line, 0, 4) == "img=" && $IsReadingQuest == true) {
				$Img = substr($line, 4, -2);
			}
			else if(substr($line, 0, 6) == "title=" && $IsReadingQuest == true) {
				$Title = substr($line, 6, -2);
			}
			else if(substr($line, 0, 6) == "score=" && $IsReadingQuest == true) {
				$Score = substr($line, 6, -2);
			}
			else if(substr($line, 0, 5) == "rank=" && $IsReadingQuest == true) {
				$Rank = substr($line, 5, -2);
			}
			else if(substr($line, 0, 1) == "}") {
				if($IsReadingQuest == true){
					$Data = $Data . "name:" . $Title . ",img:" . $ImagePath . $Img . ",score:" . $Score . ",rank:" . $Rank . "|";
					$Img = ""; $Title = ""; $Score = ""; $Rank = "";
					$IsReadingQuest = false;
				}else if($IsReadingUser == true){
					$IsReadingUser = false;
					break;
				}
			}
		}
		fclose($file);
	
		if(isset($_POST['ASCII'])) {
			echo str_replace($special, $normal, $Data);
		} else {
			echo $Data;
		}
	} else if (isset($_POST['GetUserScore'])) {
		$UserName = $_POST['GetUserScore'];
		
		$IsReadingQuest = false;
		$IsReadingUser = false;
		$TotalScore = 0;
	
		$file = fopen("Files/QuestLog.txt", "r");
		while(!feof($file)) {
			$line = fgets($file);
			if(substr($line, 0, 5) == "name=" && (substr($line, 5, -2) == $UserName || str_replace($special, $normal, substr($line, 5, -2)) == str_replace($special, $normal, $UserName) )) {
				$IsReadingUser = true;
			}
			else if(substr($line, 0, 6) == "quest{" && $IsReadingUser == true) {
				$IsReadingQuest = true;
			}
			else if(substr($line, 0, 6) == "score=" && $IsReadingQuest == true) {
				$TotalScore += intval(substr($line, 6, -2));
			}
			else if(substr($line, 0, 1) == "}") {
				if($IsReadingQuest == true){
					$IsReadingQuest = false;
				}else if($IsReadingUser == true){
					$IsReadingUser = false;
					break;
				}
			}
		}
		fclose($file);

		echo $TotalScore;
	}else if (isset($_POST['GetQuestScore']) && isset($_POST['UserName']) ) {
		$QuestName = $_POST['GetQuestScore'];
		$UserName = $_POST['UserName'];
		$IsReadingUser = false;
		$IsReadingRightQuest = false;
		$Score = "";
	
		$file = fopen("Files/QuestLog.txt", "r");
		while(!feof($file)) {
			$line = fgets($file);
			if(substr($line, 0, 5) == "name=" && (substr($line, 5, -2) == $UserName || str_replace($special, $normal, substr($line, 5, -2)) == str_replace($special, $normal, $UserName) )) {
				$IsReadingUser = true;
			}else if(substr($line, 0, 6) == "title=" && substr($line, 6, -2) == $QuestName && $IsReadingUser == true) {
				$IsReadingRightQuest = true;
			}else if(substr($line, 0, 6) == "score=" && $IsReadingRightQuest == true) {
				$Score = substr($line, 6, -2);
				break;
			}
		}
		fclose($file);
	
		echo $Score;
	}else if (isset($_POST['GetQuestRank']) && isset($_POST['UserName']) ) {
		$QuestName = $_POST['GetQuestRank'];
		$UserName = $_POST['UserName'];
		$IsReadingUser = false;
		$IsReadingRightQuest = false;
		$Rank = "";
	
		$file = fopen("Files/QuestLog.txt", "r");
		while(!feof($file)) {
			$line = fgets($file);
			if(substr($line, 0, 5) == "name=" && (substr($line, 5, -2) == $UserName || str_replace($special, $normal, substr($line, 5, -2)) == str_replace($special, $normal, $UserName) )) {
				$IsReadingUser = true;
			}else if(substr($line, 0, 6) == "title=" && substr($line, 6, -2) == $QuestName && $IsReadingUser == true) {
				$IsReadingRightQuest = true;
			}else if(substr($line, 0, 5) == "rank=" && $IsReadingRightQuest == true) {
				$Rank = substr($line, 5, -2);
				break;
			}
		}
		fclose($file);
	
		if(isset($_POST['ASCII'])) {
			echo str_replace($special, $normal, $Rank);
		} else {
			echo $Rank;
		}
	}else if (isset($_POST['GetQuestImageUrl']) && isset($_POST['UserName']) ) {
		$ImagePath = "http://questbook.hebasoft.net/Pictures/";
		$QuestName = $_POST['GetQuestImageUrl'];
		$UserName = $_POST['UserName'];
		$IsReadingUser = false;
		$LastImg = "";
		$Url = "";
	
		$file = fopen("Files/QuestLog.txt", "r");
		while(!feof($file)) {
			$line = fgets($file);
			if(substr($line, 0, 5) == "name=" && (substr($line, 5, -2) == $UserName || str_replace($special, $normal, substr($line, 5, -2)) == str_replace($special, $normal, $UserName) )) {
				$IsReadingUser = true;
			}else if(substr($line, 0, 4) == "img=") {
				$LastImg = substr($line, 4, -2);
			}else if(substr($line, 0, 6) == "title=" && substr($line, 6, -2) == $QuestName && $IsReadingUser == true) {
				$Url = $LastImg;
				break;
			}
		}
		fclose($file);

		if($Url != "") {
			echo $ImagePath . $Url;
		} else {
			echo "Not found! :(";
		}
	}else{
		echo "Unknown request!";
	}
?>
