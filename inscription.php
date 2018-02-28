<?php 
	session_start();
	require_once('bdd.php');

	/* connexion à la base de données */
	$bdd = new BaseDeDonnees('localhost','p1408199','216169');
	$bdd->connexionBdd();
	
	$error="";
	
	if(isset($_POST['submit']))
	{		
		if(isset($_POST['user']) && $_POST['user']!="")
		{
			if(isset($_POST['passwd']) && ($_POST['passwd']!=""))
			{
				$bdd->ajoutUser($_POST['user'], $_POST['passwd']);
				$msg= ($bdd->connexionUser($_POST['user'], $_POST['passwd']));
				if($msg!='ok')
					$error=$msg;
				else
					header('Location: roulette.php');
			} else $error='Veuillez entrer un mot de passe';
		} else $error='Veuillez entrer un identifiant';
	}		
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Inscription</title>
		<link rel="stylesheet" href="style/style.css" />
	</head>

	<body>
		<h1>Jeu de la Roulette</h1>
		<h2>Inscription</h2>
		<form method="post" action="inscription.php">
			<input type="text" name="user" placeholder="Identifiant" autofocus /><br/>
			<input type="password" name="passwd" placeholder="Mot de passe" /><br/>
			<?php
				if($error!="") 
					echo "<p id='error'> " . $error . "</p>";
			?>
			<input type="submit" value="Envoyer" name="submit" />
			<input type="reset" value="Effacer" name="reset" />
		</form>

		<p id='link'>Déjà membre de notre super jeu ? <a href="index.php">Connecte toi</a> </p>
	
	</body>


	
</html>