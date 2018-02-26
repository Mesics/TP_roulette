<!--  MACCAGNO Coralie - TP Roulette -->


<?php 
	session_start();
	

	require_once('bdd.php');

	$error="";
	
	if (isset($_GET['deco'])){
		##on vide la session
		unset($_SESSION['user']);
		unset($_SESSION['money']);
	}
	
	if (isset($_SESSION['user']))
		header('Location: roulette.php');
	
	if(isset($_POST['submit']))
	{
		if(isset($_POST['user']) && $_POST['user']=="Coco" )
		{
			if(isset($_POST['passwd']) && $_POST['passwd']=='1234')
			{
				$_SESSION['user']=$_POST['user'];
				$_SESSION['money']='20000';
				header('Location: roulette.php');
			} else $error='Mot de passe erroné';
		} else $error='Identifiant inconnu';
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
			$requete= 'SELECT * FROM Player';
			$reponse = $bdd->query($requete);
			echo $reponse;
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
