<?php 

	session_start();
	require_once('bdd.php');
	/* connexion à la base de données */
	$bdd = new BaseDeDonnees('localhost','p1408199','216169');
	$bdd->connexionBdd();
	
	/* si il n'y a pas de session ouverte on redirige vers l'acceuil */
	if(!isset($_SESSION['user']))
		header('Location: index.php');

	$jeu="";
	$result="";
	$tirageR=0;
	if(isset($_POST['play']))
	{
		if(isset($_POST['mise']) && $_POST['mise']!="" && $_POST['mise']<=$_SESSION['money'])
		{
			if(isset($_POST['numero']) && $_POST['numero']!="")
			{
				$tirageR=rand(1,36);
				if($_POST['numero']==$tirageR)
				{
					$result="Bravo, Vous avez gagné 35x votre mise !";
					$_SESSION['money']+=$_POST['mise']*35;
				} else {
					$result="Dommage, c'est perdu...";
					$_SESSION['money']-=$_POST['mise'];
				}
			
			} else {
				
				if( isset($_POST['parite']) )
				{
					$tirageR=rand(1,36);
					if( ($_POST['parite']=='pair' && $tirageR%2==0 ) || ($_POST['parite']=="impair" && ($tirageR%2)==1) )
					{
						$result="Bravo, vous avez gagné 2x votre mise !";
						$_SESSION['money']+=$_POST['mise']*2;
					} else {
						$result="Dommage, c'est perdu...";
						$_SESSION['money']-=$_POST['mise'];
					}
				} else $jeu="Veuillez jouer un nombre ou une parité !";
			}
		} else $jeu="Veuillez rentrer une mise valide";
		$bdd->majUser($_SESSION['money'],$_SESSION['user'],$_SESSION['passwd']);
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Jeu de la Roulette</title>
		<link rel="stylesheet" href="style/style.css" />
		<link rel="stylesheet" href="style/roulette.css" />
	</head>

	<body>
		<header>
			<h1>Jeu de la Roulette</h1>
		</header>

		<main>			
			<?php
				if($result!="")
					echo "<p>" . $result ."</p>";
			?>
			
			<?php
		
				echo "<h2>" . $_SESSION['user'] . "</h2>";
				echo "<p>" . $_SESSION['money'] . " €<php>";
			
			?>
			
			<form method="post" action="roulette.php">
				<input type="number" name="mise" min="1" placeholder="Votre mise" autofocus /><br.>
				<div id="conteneur_form">
					<label>Mise sur un nombre<br/>
						<input type="number" id='mise' name="numero" min="1" max="36" step="1" />
					</label>
					<p>ou</p>
					<label>Mise sur la parité<br/>
						<label><input type="radio" name="parite" value="pair">Pair</label><br>
						<label><input type="radio" name="parite" value="impair">Impair</label><br>
					<label>
				</div>
				<?php
					if($jeu!="")
					echo "<p id='error'>" . $jeu . "</p>";
				?>
				<input type="submit" id='jouer' value="Jouer" name="play" />
			</form>
			
			<p id='link'><a href="index.php?deco">Deconnexion</a></p>
		</main>	
	</body>
	
</html>