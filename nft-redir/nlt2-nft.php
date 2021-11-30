<?php
	require_once("nlt2-dbconfig.php");
	
	$turl = $_GET["id"];
	if(!$turl || strlen($turl)!=10){
		die("missing or invalid identified");
	}
	if(!$db_file || strlen($db_file)==0){
		die("missing or empty required config parameter db_file");
	}
	try{
		$db = new SQLite3($db_file, SQLITE3_OPEN_READONLY);
	}
	catch(Exception $err){
		die($err);
	}
	$retval = $db->querySingle("SELECT * FROM nft WHERE uid='".$turl."';", true);
	if(!$retval){
		die("identified not found.");
	}

?>
<html>
<head>
<title><?php echo($retval["title"]); ?></title>
<meta property="og:title" content="<?php echo($retval["title"]); ?>" >
<meta property="og:description" content="<?php echo($retval["desc"]); ?>" >
<meta property="og:type" content="website" />
<meta property="og:image" content="<?php echo($retval["thumbnail"]); ?>" >
</head>
<script type="text/javascript">
function NaM(){
	window.location.href = "<?php echo($retval["link"]); ?>";
}
</script>
<body onLoad="NaM()">
If you are not being redirected automatically, click this LuL: <a href="<?php echo($retval["link"]); ?>" target="_blank"><?php echo($retval["title"]); ?></a>
<?php $db->close(); ?>
</body>
</html>
