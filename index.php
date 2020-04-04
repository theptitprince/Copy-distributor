<?php
session_start();
include("function.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Rendu</title>

	<link rel="stylesheet" href="style.css" />
	<link rel="stylesheet" href="style-form.css" />

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

	<link rel="icon" type="image/x-icon" href="favicon.png" />
</head>
<body>


	<div id="top"><h1><a href="index.php">Rendu</a></h1></div>

	<div id="wrapper">
		<div id="side-bar">
			<ol>
				<li><a href="index.php">Selection des emails</a></li>
				<li>Selection des copies</li>
				<li>Distribution des copies</li>
			</ol>
		</div>
		<div id="content">
			<?php include("aplet.php"); ?>
		</div>
		<div class="clear"></div>

	</div>

	<div id="footer"><p>©2004-2020 The p'tit prince</p></div>

</body>
</html>
