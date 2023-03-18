<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
        "http://www.w3.org/TR/html4/loose.dtd">

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="dark-theme.css">
<title>Dungeonbot leaderboard</title>
</head>
<body>
<?php
	$lbAPI = "http://127.0.0.1:7776/leaderboard";
	
	$res = curl_init();
	curl_setopt($res, CURLOPT_URL, $lbAPI);
	curl_setopt($res, CURLOPT_RETURNTRANSFER, true);
	$data = curl_exec($res);
	$err = curl_error($res);
	if($err!=''){
		die($err);
	}
	$lb = json_decode($data, true);
	curl_close($res);
?>
<table style="border: 2px solid white; border-collapse: collapse;">
	<tr>
		<td>Rank</td>
		<td>Username</td>
		<td>Level</td>
		<td>Total experience</td>
		<td>Entries/Wins</td>
		<td>Winrate</td>
	</tr>
<?php
	if(count($lb)<10){
		echo("\t<tr>\n\t\t<td colspan=6>Leaderboard becomes available after more than 10 registered players.</td>\n\t</tr>");
	} else {
		$i = 1;
		foreach($lb as $u){
			$wr = number_format(($u["dungeon_wins"]/$u["dungeons"]*100), 2)."%";
			echo("\t<tr>\n");
			echo("\t\t<td>".$i."</td>\n");
			echo("\t\t<td>".$u["username"]."</td>\n");
			echo("\t\t<td>".$u["user_level"]."</td>\n");
			echo("\t\t<td>".$u["total_experience"]."</td>\n");
			echo("\t\t<td>".$u["dungeons"]."/".$u["dungeon_wins"]."</td>\n");
			echo("\t\t<td>".$wr."</td>\n");
			echo("\t</tr>\n");
			$i++;
		}
	}

?>
</table>
</body>
</html>
