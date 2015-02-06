<?php
	//SqlHelpter
	//Provides connection and easy management of SQL Database

	function AsciiCheck($data) {
		if(isset($_POST['ASCII'])) {
			//This is a horrible way how to do it, but I have no idea how to do it the normal way
			$special = array("ě", "š", "č", "ř", "ž", "ý", "á", "í", "é", "ü", "ú", "ů", "Ě", "Š", "Č", "Ř", "Ž", "Ý", "Á", "Í", "É", "Ü", "Ú", "Ů");
			$normal =  array("e", "s", "c", "r", "z", "y", "a", "i", "e", "u", "u", "u", "E", "S", "C", "R", "Z", "Y", "A", "I", "E", "U", "U", "U");	
			return str_replace($special, $normal, $data);
		} else {
			return $data;
		}
	}

	function SqlConnect() {
		include ("Libraries/SqlLogin.php");
		
		$conn = new mysqli($servername, $username, $password);
		if (!$conn) {
			echo "Connection to MySQL database failed: " . mysqli_connect_error();
		} else {
			mysqli_set_charset($conn, "utf8");
			mysqli_select_db($conn, "questbook_hebasoft_net");
		}
		return $conn;
	}
	
	function SqlPassQuery($query, $retunParamsWithSelectors) {
		$conn = SqlConnect();
		$result = mysqli_query($conn, $query);
		if (mysqli_num_rows($result) > 0) {
			$select = explode(",", substr($query, strpos($query, "SELECT") + 7, strpos($query, "FROM") - (strpos($query, "SELECT") + 7) - 1));

			$returnData = "";
			while($data = mysqli_fetch_assoc($result)) {
				if($returnData != "") { $returnData = $returnData . ";"; }
				for ($i = 0; $i < sizeof($select); $i++) {
					if(substr($returnData, -1) != ";" && $returnData != "") { $returnData = $returnData . ","; }
					if($retunParamsWithSelectors) {
						$returnData = $returnData . $select[$i] . ":" . $data[$select[$i]];
					} else {
						$returnData = $returnData . $data[$select[$i]];
					}
				}
			}
			
			mysqli_close($conn);
			return $returnData;
		}
		if ($conn) { mysqli_close($conn); }
		return "Not found";
	}
	
	function SqlGetUserId($username) {
		$data = SqlPassQuery("SELECT ID FROM Accounts WHERE Username = '" . $username . "'", false);
		if($data == "Not found") { return -1; }
		return $data;
	}

	function SqlGetUsers() {
		return AsciiCheck(SqlPassQuery("SELECT Username FROM Accounts", false));
	}
	
	function SqlGetUserQuests($UserId) {
		return AsciiCheck(SqlPassQuery("SELECT Name FROM QuestLog WHERE OwnerID = " . $UserId, false));
	}
	
	function SqlGetUserScore($UserId) {
		$data = SqlPassQuery("SELECT Points FROM QuestLog WHERE OwnerID = " . $UserId, false);
		return array_sum(explode(",", $data));
	}
	
	function SqlGetQuestScore($UserId, $QuestName) {
		return SqlPassQuery("SELECT Points FROM QuestLog WHERE OwnerID = " . $UserId . " AND Name = '" . $QuestName . "'", false);
	}
	
	function SqlGetQuestRank($UserId, $QuestName) {
		return AsciiCheck(SqlPassQuery("SELECT Rank FROM QuestLog WHERE OwnerID = " . $UserId . " AND Name = '" . $QuestName . "'", false));
	}
	
	function SqlGetQuestImageUrl($UserId, $QuestName) {
		return SqlPassQuery("SELECT ImageUrl FROM QuestLog WHERE OwnerID = " . $UserId . " AND Name = '" . $QuestName . "'", false);
	}
	
	function SqlGetUserQuestsDetailed($UserId) {
		return AsciiCheck(SqlPassQuery("SELECT Name,ImageUrl,Rank,Points FROM QuestLog WHERE OwnerID = " . $UserId, true));
	}
?>