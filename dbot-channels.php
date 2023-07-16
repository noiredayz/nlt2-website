<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
        "http://www.w3.org/TR/html4/loose.dtd">

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="dark-theme.css">
<title>Dungeonbot Channel list</title>
</head>
<body>
<?php
	$lbAPI = "http://127.0.0.1:7776/channels";

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
		<td style='width: 30px;'>&nbsp;</td>
		<td style='width: 120px';>Twitch ID</td>
		<td style='width: 270px';>Channel name</td>
	</tr>
<?php
	if(count($lb)==0){
		echo("\t<tr>\n\t\t<td colspan=2>No known channels.</td>\n\t</tr>");
	} else {
		$i = 1;
		foreach($lb as $u){
			echo("\t<tr>\n");
			echo("\t\t<td>".$i."</td>\n");
			echo("\t\t<td>".$u["_id"]."</td>\n");
			echo("\t\t<td><a href=\"https://twitch.tv/".$u["name"]."\" target=\"blank\">".$u["name"]."</td>\n");
			echo("\t</tr>\n");
			$i++;
		}
	}

?>
</table>
</body>
</html>
