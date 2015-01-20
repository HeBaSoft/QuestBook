<html>
	<head>
		<meta charset="UTF-8">
		
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
		<link rel="stylesheet" type="text/css" href="Styles/api.css"> 
		<link rel="stylesheet" type="text/css" href="Styles/fonts.css"> 

		<title>QuestBook API</title>
		
		<script>
			//Initialize SideButton Animation
			SideButtonAnimateElement("#BarLinkQuestBook");
			SideButtonAnimateElement("#BarLinkGatewayCZ");
		</script>
	</head>
	<body>
		<div id="BarSideLeft">
			<div class="BarTextVersion" style="margin-top: 5px; margin-bottom: 5px;">
				Gateway, Version: 0.2, Last update: 1.12.2014
			</div>
			<div id="BarTitle">
				<img id="ImgLogoQuestBook" src="Pictures/QuestBook.png" >
				<div id="BarTitleQuestBook">QuestBook</div>
				<div id="BarTitleAPI">Gateway</div>
			</div>
			
			<br>
			
			<div id="BarLinks">
				<div class="BarLinkBase" id="BarLinkQuestBook" onclick="location.href='index.php'">
					QuestBook
				</div>
				<div class="BarLinkBase" id="BarLinkGatewayCZ" onclick="location.href='apicz.php'">
					QuestBook Gateway API CZ
				</div>
			</div>
			
			<br>
			
			<div class="BarText">
				Welcome to QuestBook Gateway!<br>
				Looking for something specific?
			</div>

		</div>
		
		<div class="BodyText">
			<b style="color: #31669B;">What is QuestBook Gateway?</b> <br>
			QuestBook Gateway is an API that is based around on sending HTTP POST requests to our PHP script and getting response as string of data <br>
			If you know how to code, you can use this API in your application, it is not that hard, trust me<br>
			<br>
			
			<b style="color: #31669B;">What can I do with QuestBook Gateway?</b><br>
			Unfortunately, in this time is usage of your API limited to read-only features. We have some plans to add features that should allow you to add quests and do other cool stuff, but we have to focus on more important things<br>
			<br>
			
			<b style="color: #31669B;">What is the address of QuestBook Gateway?</b><br>
			The address is: <a href="gate.php">http://questbook.hebasoft.net/gate.php</a><br>
			<br>
			
			<b style="color: #31669B;">How can I use QuestBook Gateway?</b><br>
			This API is designed to be easy-to-use, so it can't be so hard! I hope.<br>
			There are few basic parameters that you can use in yours POST request:<br>
			<br>
			<i style="color: #374451;">User list</i><br>
			<span style="font-size: 13px;">
				Parameter name: GetUsers<br>
				Value: <br>
				Returns: List of users separated by commas<br>
			</span>
			<br>
			<i style="color: #374451;">User score</i><br>
			<span style="font-size: 13px;">
				Parameter name: GetUserScore<br>
				Value: User-name<br>
				Returns: Sum of all points from all quests that given user have<br>
			</span>
			<br>
			<i style="color: #374451;">User quests</i><br>
			<span style="font-size: 13px;">
				Parameter name: GetUserQuests<br>
				Value: User-name<br>
				Returns: List of quests that belongs to specified user, this list is separated by commas<br>
			</span>
			<br>
			<i style="color: #374451;">User quests detailed</i><br>
			<span style="font-size: 13px;">
				Parameter name: GetUserQuestsDetailed<br>
				Value: User-name<br>
				Returns: List of detailed information about quests that belongs to specified user, quests are separated by '|' and parameters by commas<br>
			</span>
			<br>
			<i style="color: #374451;">Quest score</i><br>
			<span style="font-size: 13px;">
				Parameter name: GetQuestScore<br>
				Value: Quest-name<br>
				Parameter name: UserName<br>
				Value: User-name<br>
				Returns: Number of points for given quest<br>
			</span>
			<br>
			<i style="color: #374451;">Quest rank</i><br>
			<span style="font-size: 13px;">
				Parameter name: GetQuestRank<br>
				Value: Quest-name<br>
				Parameter name: UserName<br>
				Value: User-name<br>
				Returns: Rank that given quest have, if given quest do not have rank this returns 'none'<br>
			</span>
			<br>
			<i style="color: #374451;">Quest image</i><br>
			<span style="font-size: 13px;">
				Parameter name: GetQuestImageUrl<br>
				Value: Quest-name<br>
				Parameter name: UserName<br>
				Value: User-name<br>
				Returns: URL of image that belongs to given quest <br>
			</span>
			<br>
			
			<b style="color: #31669B;">What can I use to access QuestBook Gateway?</b><br>
			What is great about QuestBook Gateway is that it is using just HTTP POST requests, so you can use it anywhere where you have access to Internet and only thing you need is the Internet Browser<br>
			<br>
			<i style="color: #374451;">Internet Browser</i><br>
			You can use just simple Internet Browser and create HTTP POST request using some on-line generator, like <a href="https://www.hurl.it/">this</a> one<br>
			<br>
			<i style="color: #374451;">C#</i><br>
			You can also use high level programming language, C# to access QuestBook Gateway. We have preprepared class that should help you to get started, you can download it <a href="Files/HttpRequest.cs">here</a> and import it to your project<br>
			Usage of our class is very simple, you can take a look at following example:<br>
			<br>
			<pre style="margin:0em; overflow:auto; background-color:#C1C1C1;"><code style="font-family:Consolas,&quot;Courier New&quot;,Courier,Monospace; font-size:10pt; color:#000000;">List&lt;<span style="color:#0000ff;">string</span>&gt; QuestList = HttpRequest.GetPost(<span style="color:#a31515;">"http://questbook.hebasoft.net/gate.php"</span>, <span style="color:#a31515;">"GetUsers"</span>, <span style="color:#a31515;">"none"</span>).Split(<span style="color:#0000ff;">new</span> <span style="color:#0000ff;">char</span>[] { <span style="color:#a31515;">','</span> }).ToList();</code></pre>
			<span style="font-size: 9px;">This code returns List of users of quest book</span><br>
			<br>
			<pre style="margin:0em; overflow:auto; background-color:#C1C1C1;"><code style="font-family:Consolas,&quot;Courier New&quot;,Courier,Monospace; font-size:10pt; color:#000000;"><span style="color:#0000ff;">string</span> score = HttpRequest.GetPost(<span style="color:#a31515;">"http://questbook.hebasoft.net/gate.php"</span>, <span style="color:#a31515;">"GetQuestScore"</span>, <span style="color:#a31515;">"Launch QuestBook"</span>, <span style="color:#a31515;">"UserName"</span>, <span style="color:#a31515;">"Filip Šikula"</span>);</code></pre>
			<span style="font-size: 9px;">This code return string that represents number of points that is received from quest Launch QuestBook that was completed by user Filip Šikula </span><br>
			<br>
			<i style="color: #374451;">C++</i><br>
			You can also use good old C++, I recommend to use <a href="http://curl.haxx.se/libcurl/">libcurl</a> dll library, it is fairy easy-to-use library that can besides HTTP protocol do also protocols like IMAP, POP3, PUT or FTP<br>
			Here you can find an <a href="http://curl.haxx.se/libcurl/c/http-post.html">example</a> how to do HTTP POST Request<br>
			<br>
			<i style="color: #374451;">Lot of others</i><br>
			Because HTTP protocol is used everywhere on the internet, it is supported almost in every programming language, choose one...<br>
			<br>
		</div>		
	</body>
</html>