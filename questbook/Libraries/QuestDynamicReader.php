<?php
	function alert($msg) {
        echo '<script type="text/javascript">alert("' . $msg . '"); </script>';
    }

	//QuestBook Dynamic Quest Reader
	//Generates HTML elements by SQL database
	
	//HTML Element Spawner
	include ("Libraries/QuestElementSpawner.php"); 
	
	//SQL Helper
	include ("Libraries/SqlHelper.php"); 
	
	//SQL Create connection
	$conn = SqlConnect();

	//SQL Check connection
	if (!$conn) {
		alert("Connection to MySQL database failed: " . mysqli_connect_error());
	} else {
		//SQL Reads Account table
		$resultAcc = mysqli_query($conn, "SELECT ID, Username FROM Accounts");
		if (mysqli_num_rows($resultAcc) > 0) {
			while($dataAcc = mysqli_fetch_assoc($resultAcc)) {
				AddElementPlayerBarBegin($dataAcc["ID"], $dataAcc["Username"]);
					//SQL Reads users quests
					$resultQuests = mysqli_query($conn, "SELECT ID, Name, ImageUrl, Rank, Points FROM QuestLog WHERE OwnerID = " . $dataAcc["ID"] . " ORDER BY `QuestLog`.`ID` DESC");
					if (mysqli_num_rows($resultQuests) > 0) {
						while($dataQuest = mysqli_fetch_assoc($resultQuests)) {
							AddElementQuest($dataQuest["Name"], $dataQuest["ImageUrl"], $dataQuest["Points"], $dataQuest["Rank"]);
						}
					}
				AddElementPlayerBarEnd();
			}
		}
		
		mysqli_close($conn); 
	}
?> 