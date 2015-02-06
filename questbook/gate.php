<?php
	//QuestBook Gateway API

	//SQL Helper
	include ("Libraries/SqlHelper.php"); 
	
	//Global variables
	$ImagePath = "http://questbook.hebasoft.net/Pictures/";
	
	if (isset($_POST['GetUsers'])) {
		echo SqlGetUsers();
		
	}else if (isset($_POST['GetUserQuests'])) {
		$UserName = $_POST['GetUserQuests'];
		echo SqlGetUserQuests(SqlGetUserId($UserName));
		
	} else if (isset($_POST['GetUserQuestsDetailed'])) {
		$UserName = $_POST['GetUserQuestsDetailed'];
		echo SqlGetUserQuestsDetailed(SqlGetUserId($UserName));
		
	} else if (isset($_POST['GetUserScore'])) {
		$UserName = $_POST['GetUserScore'];
		echo SqlGetUserScore(SqlGetUserId($UserName));
		
	}else if (isset($_POST['GetQuestScore']) && isset($_POST['UserName']) ) {
		$QuestName = $_POST['GetQuestScore'];
		$UserName = $_POST['UserName'];
		echo SqlGetQuestScore(SqlGetUserId($UserName), $QuestName);
		
	}else if (isset($_POST['GetQuestRank']) && isset($_POST['UserName']) ) {
		$QuestName = $_POST['GetQuestRank'];
		$UserName = $_POST['UserName'];
		echo SqlGetQuestRank(SqlGetUserId($UserName), $QuestName);
		
	}else if (isset($_POST['GetQuestImageUrl']) && isset($_POST['UserName']) ) {
		$QuestName = $_POST['GetQuestImageUrl'];
		$UserName = $_POST['UserName'];
		$data = SqlGetQuestImageUrl(SqlGetUserId($UserName), $QuestName);
		if($data != "Not found") {
			echo $ImagePath . $data;
		} else {
			echo $data;
		}
		
	}else{
		echo "Unknown request!";
	}
?>
