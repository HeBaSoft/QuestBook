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
				<div class="BarLinkBase" id="BarLinkGatewayCZ" onclick="location.href='api.php'">
					QuestBook Gateway API ENG
				</div>
			</div>
			
			<br>
			
			<div class="BarText">
				Vítejte v QuestBook Gateway!<br>
			</div>

		</div>
		
		<div class="BodyText">
			<b style="color: #31669B;">Co je to QuestBook Gateway?</b> <br>
			QuestBook Gateway je API, která funguje na principu odesílání HTTP POST požadavků na náš PHP script a obdržení odpovědi jako data ve formě textového řetězce<br>
			Pokud umíte programovat, můžete použít tuto API ve vaší aplikaci, není to tak těžné, věřte mi<br>
			<br>
			
			<b style="color: #31669B;">Co mohu dělat s QuestBook Gateway?</b><br>
			V tuto chvíli je použítí naší API limitováno pouze na read-only funkce. Máme sice plány na přidání funkcí, které vám umožní přidávat questy a dělat mnoho úžasných věcí, ale v současnosti se musíme soustředit na důležitější věci (matematika, jídlo nebo chapadla)<br>
			<br>
			
			<b style="color: #31669B;">Jaké je adresa QuestBook Gateway?</b><br>
			Adresa je: <a href="gate.php">http://questbook.hebasoft.net/gate.php</a><br>
			<br>
			
			<b style="color: #31669B;">Jak mohu používat QuestBook Gateway?</b><br>
			Tato API je navrhnuta tak aby byla jednoduchá na použití, takže to nemůže být tak těžké! Doufám ...<br>
			Zde je několik základních parametrů, které můžete použít ve vaší HTTP POST žádosti:<br>
			<br>
			<i style="color: #374451;">Senznam uživatelů</i><br>
			<span style="font-size: 13px;">
				Název parametru: GetUsers<br>
				Hodnota: <br>
				Návratová hodnota: Seznam uživatelů oddělený čárkami<br>
			</span>
			<br>
			<i style="color: #374451;">Score uživatele</i><br>
			<span style="font-size: 13px;">
				Název parametru: GetUserScore<br>
				Hodnota: Uživatelské-jméno<br>
				Návratová hodnota: Součet bodů za všechny úkoly, které daný uživatel má<br>
			</span>
			<br>
			<i style="color: #374451;">Úkoly uživatele</i><br>
			<span style="font-size: 13px;">
				Název parametru: GetUserQuests<br>
				Hodnota: Uživatelské-jméno<br>
				Návratová hodnota: Seznam úkolů daného uživatele oddělený čárkami<br>
			</span>
			<br>
			<i style="color: #374451;">Detailní úkoly uživatele</i><br>
			<span style="font-size: 13px;">
				Název parametru: GetUserQuestsDetailed<br>
				Hodnota: Uživatelské-jméno<br>
				Návratová hodnota: Seznam detailních informací o úkolech daného uživatele, jednotilvé úkoly jsou odděleny pomocí znaku '|', jednotlivé parametry jsou odděleny čátkami<br>
			</span>
			<br>
			<i style="color: #374451;">Body za úkol</i><br>
			<span style="font-size: 13px;">
				Název parametru: GetQuestScore<br>
				Hodnota: Jméno-úkolu<br>
				Název parametru: UserName<br>
				Hodnota: Uživatelské-jméno<br>
				Návratová hodnota: Počet bodů obdržený za daný úkol<br>
			</span>
			<br>
			<i style="color: #374451;">Třída úkolu</i><br>
			<span style="font-size: 13px;">
				Název parametru: GetQuestRank<br>
				Hodnota: Jméno-úkolu<br>
				Název parametru: UserName<br>
				Hodnota: Uživatelské-jméno<br>
				Návratová hodnota: Třída daného úkolu, pokud daný úkol nemá třídu tento požadavek vrátí 'none'<br>
			</span>
			<br>
			<i style="color: #374451;">Obrázek úkolu</i><br>
			<span style="font-size: 13px;">
				Název parametru: GetQuestImageUrl<br>
				Hodnota: Jméno-úkolu<br>
				Název parametru: UserName<br>
				Hodnota: Uživatelské-jméno<br>
				Návratová hodnota: URL obrázku, který patří danému úkolu<br>
			</span>
			<br>
			
			<b style="color: #31669B;">Co mohu použít k přístupu a získání dat z QuestBook Gateway?</b><br>
			Jedna z největších výhod QuestBook Gateway je ta, že pracuje čistě pomocí HTTP POST požadavků. To znamená, že tuto API můžete využívat kdekoli kde máte přístup k internetu a jediná věc, kterou potřebujete je internetový prohlížeč<br>
			<br>
			<i style="color: #374451;">Internetový Prohlížeč</i><br>
			Můžete použít jednoduchý internetový prohlížeč, jelikož žádost HTTP POST, lze vytvořit jednoduše pomoicí on-line generátorů, jako je <a href="https://www.hurl.it/">tento</a><br>
			<br>
			<i style="color: #374451;">C#</i><br>
			Jako jeden z prostředků pro přístup k QuestBook Gateway lze využít vysokoúrovňový programovací jazyk C#. Připravili jsme pro vás třídu, která by vám měla ze začátku pomoci, stáhnout ji můžete <a href="Files/HttpRequest.cs">zde</a>, poté již stačí inportovat tuto třídu do vašeho projektu.<br>
			Tato přída je jednoduchá na používání, zde je několik příkladů:<br>
			<br>
			<pre style="margin:0em; overflow:auto; background-color:#C1C1C1;"><code style="font-family:Consolas,&quot;Courier New&quot;,Courier,Monospace; font-size:10pt; color:#000000;">List&lt;<span style="color:#0000ff;">string</span>&gt; QuestList = HttpRequest.GetPost(<span style="color:#a31515;">"http://questbook.hebasoft.net/gate.php"</span>, <span style="color:#a31515;">"GetUsers"</span>, <span style="color:#a31515;">"none"</span>).Split(<span style="color:#0000ff;">new</span> <span style="color:#0000ff;">char</span>[] { <span style="color:#a31515;">','</span> }).ToList();</code></pre>
			<span style="font-size: 9px;">Tento kus kódu vrací List uživatelů quest booku</span><br>
			<br>
			<pre style="margin:0em; overflow:auto; background-color:#C1C1C1;"><code style="font-family:Consolas,&quot;Courier New&quot;,Courier,Monospace; font-size:10pt; color:#000000;"><span style="color:#0000ff;">string</span> score = HttpRequest.GetPost(<span style="color:#a31515;">"http://questbook.hebasoft.net/gate.php"</span>, <span style="color:#a31515;">"GetQuestScore"</span>, <span style="color:#a31515;">"Launch QuestBook"</span>, <span style="color:#a31515;">"UserName"</span>, <span style="color:#a31515;">"Filip Šikula"</span>);</code></pre>
			<span style="font-size: 9px;">ento kus kódu vrací string, který reprezentuje počet bodů, obdržených za úkol s názvem Launch QuestBook dokončený uživatelem Filip Šikula </span><br>
			<br>
			<i style="color: #374451;">C++</i><br>
			Také můžete použít staré dobré C++, doporučuji použít knihovnu <a href="http://curl.haxx.se/libcurl/">libcurl</a>, tato knihovna se jednoduše používá a dokáže kromě protokolu HTTP pracovat s prokoly jako jsou IMAP, POP3, PUT nebo FTP<br>
			Zde můžete nalézt <a href="http://curl.haxx.se/libcurl/c/http-post.html">ukázku</a> kódu jak vytvořit požadavek HTTP POST<br>
			<br>
			<i style="color: #374451;">Mnoho dalších</i><br>
			Protože HTTP protokol se používá všude na internetu, je tento protokol podporován velkým množstvím programovacích i skriptovacích jazyků, jeden si vybertne...<br>
			<br>
		</div>		
	</body>
</html>