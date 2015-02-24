<html>
	<head>
		<meta charset="UTF-8">
		
		<!--JQuery.js-->
		<script src="Libraries/jquery-2.0.3.js"></script>
		<script src="Libraries/jquery.color-2.1.2.js"></script>
		
		<!--CSS-->
		<link rel="stylesheet" type="text/css" href="Styles/communityupdate.css"> 
		<link rel="stylesheet" type="text/css" href="Styles/fonts.css"> 
		
		<!--Favicon-->
		<link rel="shortcut icon" href="Pictures/Favicon.ico">
		
		<script>
			$(document).ready(function(){
				$('#TextWrapper').data("Scroll" ,"Down");

				$("#DownArrow").click(function() {
					if(!$('#TextWrapper').is(':animated')){
						if($('#TextWrapper').data("Scroll") == "Down") {
							$('#TextWrapper').animate({
								top: '-=' + ($('#TextWrapper').position().top + $('#TextWrapper').height())  + "px"
							}, 1000, function() {
								$('#DownArrow').css({
									transform: 'rotate(180deg)'
								});
								$('#TextWrapper').data("Scroll" ,"Up");
							});
							$('#TwitterWrapper').animate({
								top: '-=' + ($('#TextWrapper').position().top + $('#TextWrapper').height() + 500)  + "px"
							}, 1000);
						} else {
							$('#TextWrapper').animate({
								top: '+=' + (($(window).height() / 2) + ($('#TextWrapper').height() - 120))  + "px"
							}, 1000, function() {
								$('#DownArrow').css({
									transform: 'rotate(0deg)'
								});
								$('#TextWrapper').data("Scroll" ,"Down");
							});
							$('#TwitterWrapper').animate({
								top: '+=' + (($(window).height() / 2) + ($('#TextWrapper').height() - 120) + 500)  + "px"
							}, 1000);
						}
					}
				});
				
			});
		</script>
		
		<title>QuestBook Community Update</title>
	</head>
	
	<body>
		<div id="GlobalWrapper">
			<div id="TextWrapper">
				<div id="Title">QuestBook</div>
				<div id="SubTitle">Community Update</div>
				<div id="Text">
					<div style="color: #BFBBAC;">QuestBook is currently unavailable due to Community update!</div><br>
					This update will bring our community closer together!<br>
					You can check the code in our repository on <a href="https://github.com/HeBaSoft/QuestBook">GitHub</a>.<br>
					Keep up with this update by hash-tag <a href="https://twitter.com/search?q=%23questbookcommunityupdate&src=typd">#QuestBookCommunityUpdate</a>.<br>
					Follow creator of QuestBook <a href="https://twitter.com/TheFilipsi">@TheFilipsi</a> and <a href="https://twitter.com/TheQuestBook">@TheQuestBook</a> itself on Twitter!
				</div>
				<div id="HiddenText">Also there's <a id="HiddenUrl" href="https://twitter.com/costiic">Vüjta</a>! Don't check him out</div>
				<img src="Pictures/ButtonArrow.png" alt="Vujta broke dis" id="DownArrow" height="128px" width="128px">
			</div>
			<div id="TwitterWrapper">
				<a class="twitter-timeline" data-dnt="true" href="https://twitter.com/search?q=%23QuestBookCommunityUpdate%20-RT" width="400" height="450" data-chrome="nofooter" data-widget-id="563988252777254912">Tweets about #QuestBookCommunityUpdate -RT</a>
				<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
				<a class="twitter-timeline" data-dnt="true" href="https://twitter.com/search?q=from%3A%40TheQuestBook%20-RT" width="400" height="450" data-chrome="nofooter" data-widget-id="564672975849680896">Tweets about from:@TheQuestBook -RT</a>
				<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
			</div>
		</div>
	</body>
</html>