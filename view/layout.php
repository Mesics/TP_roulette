<!--- MACCAGNO Coralie - TP Roulette : page layout --->


<!DOCTYPE html>
<html>
	<head>
		<title><?= $titlePage ?></title>
		<link rel="stylesheet" href="style/style.css" />
		<link rel="stylesheet" href="style/<?=$module?>.css" />
	</head>
	
	<body>
		<?php
			// if($module=='connexion')
				// include ('connexion.php');
			// if($module=='roulette')
				// include ('roulette.php');
			
			include($module'.php');
		?>
		
	
	</body>
</html>