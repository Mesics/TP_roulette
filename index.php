<!--  MACCAGNO Coralie - TP Roulette -->


<?php 
	session_start();
	
	require_once('bdd.php');
	
	/* connexion à la base de données */
	$basedonnee = new BaseDeDonnees('localhost','p1408199','216169');
	$basedonnee->connexionBdd();

	$error="";
	
	/* Quand on appuie sur le bouton déconnexion de la page du 
	jeu :  on vide toutes les sessions */
	if (isset($_GET['deco'])){
		##on vide la session
		unset($_SESSION['user']);
		unset($_SESSION['money']);
	}
	
	/* si le joueur est déjà connecté on le redirige directement
		sur la page du jeu */
	if (isset($_SESSION['user']))
		header('Location: roulette.php');
	
	/* vérification de l'identité */
	if(isset($_POST['submit']))
	{
		$msg = $basedonnee->connexionUser($_POST['user'], $_POST['passwd']);
		
		if ($msg!='ok')
			$error=$msg;
		else 
			header('Location: roulette.php');
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Connexion</title>
		<link rel="stylesheet" href="style/style.css" />
		<link rel="stylesheet" href="style/index.css" />
	</head>
	
	<body>
		<?php 
			if($error!="") echo $error;
		?>
		<h1>Jeu de la Roulette</h1>
		<h2>Connexion</h2>

		<form method="post" action="index.php">
			<input type="text" name="user" placeholder="Identifiant" autofocus /><br/>
			<input type="password" name="passwd" placeholder="Mot de passe" /><br/>
			<?php
				if($error!="") echo "<p id='error'> " . $error . "</p>";
			?>
			<input type="submit" value="Envoyer" name="submit" />
			<input type="reset" value="Effacer" name="reset" />
		</form>
		
		
		<p id='link'>Pas encore membre ? Viens t'<a href="inscription.php">inscrire</a>... </p>
	</body>

</html>
