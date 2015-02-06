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
				<img src="Pictures/ButtonLogin.png" id="ButtonLogin" style="width: 32px; height:32px; margin: 5px; float: left; cursor: pointer;">
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
		
		<!--Quest Reader Start-->
		<?php 
			include ("Libraries/QuestDynamicReader.php"); 
		?>
		<!--Quest Reader End-->
		
		<img src="Pictures/ArrowLeft.png" id="ArrowLeft">
		<img src="Pictures/ArrowRight.png" id="ArrowRight">
		
		<div id="BarSideRight">
		</div>

	</body>
</html>
