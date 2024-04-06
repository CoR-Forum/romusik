<?php 

/* ####################################################################################
Ein einfacher Audio-Player auf HTML5 Basis.
Browser: IE 9+, Chrome (auch iOS), Safari (auch iOS), Firefox ab V. 21, neue Opera
http://webdesign.weisshart.de 2014
Lizenz: CC BY-NC-SA 3.0 DE
##################################################################################### */

/* ################### hier die .mp3 Dateien  ##################################### */

	$url = array (
    "https://cdn.treudler.net/18/190905224714075-uGEWb-x.mp3",
	"https://cdn.treudler.net/18/190905222611860-ZrM0v-x.mp3",
	"https://cdn.treudler.net/18/190905222658546-YH6rb-x.mp3",
	"https://cdn.treudler.net/18/190905222710535-fbHmR-x.mp3",		
	"https://cdn.treudler.net/18/190905222736082-w3Bxf-x.mp3",
    "https://cdn.treudler.net/18/190905222822984-QjyL4-x.mp3",
    "https://cdn.treudler.net/18/190905222840877-mtsOk-x.mp3",
    "https://cdn.treudler.net/18/190905222904880-yDwNj-x.mp3",
    "https://cdn.treudler.net/18/190905224741300-ZsybV-x.mp3",
    "https://cdn.treudler.net/18/190905224951800-ioiW1-x.mp3",
	"https://cdn.treudler.net/18/190905224019533-JCHxu-x.mp3",
	"files/data2_00002.ogg",
	"files/data2_00003.ogg",
	"files/data2_00004.ogg",
	"files/data2_00005.ogg",
	"files/data2_00006.ogg",
	"files/data2_00007.ogg",
	"files/data2_00008.ogg",
	"files/data2_00009.ogg",
	"files/data2_00197.ogg",
	"files/data2_00254.ogg",
	"files/data2_00256.ogg",
	"files/data2_00257.ogg",
	"files/data2_00258.ogg",
	"files/data2_00259.ogg",
	"files/data2_00260.ogg",
	"files/data2_00261.ogg",
	"files/data2_00262.ogg",
	"files/data2_00292.ogg",
	"files/data2_00401.ogg",
	"files/data2_00403.ogg",
	"files/data2_00466.ogg",
	"files/data2_00467.ogg",
	"files/data2_00497.ogg"



	
	//letzte Zeile ohne schließendes Komma!
	);

	/* ################### und hier die angezeigten Titel  ######################### */
	$name = array (
    "Credits",
	"Regnum Carnival",
	"Duel in the colisseum",	
	"The immortals",			
	"The message on the stones",
    "Sand Ocean",
    "A new adventure begins",
    "Skolheim/Rottersval",
    "Hopstad",
    "Montsognir",
	"Santas House",
	"files/data2_00002.ogg",
	"files/data2_00003.ogg",
	"files/data2_00004.ogg",
	"files/data2_00005.ogg",
	"files/data2_00006.ogg",
	"files/data2_00007.ogg",
	"files/data2_00008.ogg",
	"files/data2_00009.ogg",
	"files/data2_00197.ogg",
	"files/data2_00254.ogg",
	"files/data2_00256.ogg",
	"files/data2_00257.ogg",
	"files/data2_00258.ogg",
	"files/data2_00259.ogg",
	"files/data2_00260.ogg",
	"files/data2_00261.ogg",
	"files/data2_00262.ogg",
	"files/data2_00292.ogg",
	"files/data2_00401.ogg",
	"files/data2_00403.ogg",
	"files/data2_00466.ogg",
	"files/data2_00467.ogg",
	"files/data2_00497.ogg"
      //letzte Zeile ohne schließendes Komma!
	);


/* ##################### ab hier nicht mehr editieren ############################## */

$aufruf ="";
$direktLink ="";


function isIOS($user_agent=NULL) {
    if(!isset($user_agent)) {
        $user_agent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
    }
    return (strpos($user_agent, 'iPhone') !== FALSE || strpos($user_agent, 'iPad') !== FALSE || strpos($user_agent, 'iPod') !== FALSE );
}


/* den uebergebenen Titel abfragen */
if (isset($_REQUEST['titel']))  {
	$_REQUEST['titel'] = htmlentities($_REQUEST['titel']);
	if (!is_numeric($_REQUEST['titel']) || $_REQUEST['titel'] > count($url) ) {$titel = $url[0];}
	$autoplay="autoplay"; /* kein Autoplay in iOS */
	$neuer_titel=true; 
	for ($i = 1; $i <= count($url); $i++) {
		if ($_REQUEST["titel"] == $i) {$titel = $url[$i-1];}
	}
} else {
	$titel = $url[0];
	$autoplay = "";
}

/* die Linkliste generieren */
for ($i = 1; $i <= count($url); $i++) {
	$aufruf .= '<li><a href="?titel='.$i.'"> '.$name[$i-1];
	if ($titel == $url[$i-1]) {
		$aufruf .= "<span class='star'> ✔︎</span>";
	}
	$aufruf .= "</a></li>\n";

	$direktlink .= '<li><a style="color:#000" href="'.$url[$i-1].'"> '.$name[$i-1].'</a></li>';
}

?>
<!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />

<link rel="stylesheet" type="text/css" media="screen" href="player.css" />
<title>player</title>
<!-- <script src="modernizr.custom.29132.js"></script> -->

<?php
if(isIOS()) {
echo '
<style>
	#player {background: #e1e1e1 !important;border: 2px solid #aaa;}
	li a {color:#000 !important;}
	li {border-top: 1px solid #aaa !important}
	audio {margin: 10px 0 5px 0;filter: invert(0);}
</style>
';
}
?>



</head>
<body  onload="Lautstaerke()">

<!-- <h2>HTML5 Audio- und Radio-Player</h2> -->

<div id="h2"></div>
<!-- script>
if (top.location == self.location) {
    // Seite in einem Frame geladen
	document.getElementById('h2').innerHTML='<h1></h1>';
}	
</script -->





<div id="ie_fallback"></div>
<div id="player">

<!-- erstaunlich: ohne <source> tag gehts auch mit VO auf iOS -->
<audio id="innerplayer" src="<?php echo $titel; ?>"  controls <?php echo $autoplay; ?> ></audio>

<ul>
<?php echo $aufruf; ?>
</ul>
</div>

<div id="down_hinweis"></div>
<!-- script>
if (top.location == self.location) {
    // Seite in einem Frame geladen
	document.getElementById('down_hinweis').innerHTML='<p class="bem"><a href="/audio_tag.php">Beschreibung und Download</a>';
}	
</script -->



<?php
$neuer_titel = 0;
if (isset($_REQUEST['titel']))  {$neuer_titel=$_REQUEST['titel'];}

?>

<script>

/* Damit Screen Reader Ausgaben nicht uebertoent werden: */
function Lautstaerke() {
	document.getElementById("innerplayer").volume=0.7;
	/* Fokus auf Player setzen nach Anwahl */
	var neu = <?php echo $neuer_titel; ?>;
	
	if ( neu !== 0 ) {
		//		document.getElementById('innerplayer').focus(); // führt zu Springen des Fokus in iOS
	}
}

</script>



<?php 
/* ###########  serielle Wiedergabe ######### */

if ($neuer_titel >= count($url)) {
	$next = 1;
} elseif ($neuer_titel == 0) {
	$next = 2;
} else {
	$next = $neuer_titel +1;
} 

echo '
<script>	
document.getElementById("innerplayer").addEventListener("ended", function() {
	window.location = "?titel='.$next.'";
	return false;
});
</script>
';

?>



</body>
</html>

