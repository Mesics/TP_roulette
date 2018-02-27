<!--  MACCAGNO Coralie - TP Roulette -->


<?php 
	session_start();
	

	require_once('bdd.php');
/* méthode d'initialisation du PDO
	function connexionBdd(){
		try{
			$bdd=new PDO('mysql:host=localhost;dname=p1408199;charset=utf8', 'p1408199', '216169');
			return $bdd;
		}catch (Exception $e){
			die('Erreur connexion : ' . $e->getMessage());
			return false;
		}
	}
	
	/* méthode de connexin de l'utilisateur
/*	function connexionUser($user, $pwd) {
		$bdd = connexionBdd();
		if($bdd) {
			$reponse = $bdd->query('SELECT * FROM p1408199.Player WHERE name = "'.$user.'";');
			$data = $reponse->fetch();
			
			if($user != '' and $pwd != '') {
				if($data['name'] == $user) {
					if($data['password'] == $pwd) {
						$_SESSION['idUser'] = $data['id'];
						$_SESSION['user'] = $data['name'];
						$_SESSION['money'] = $data['money'];
						$connexion = 'ok';
					} else {
						$connexion = 'Mot de passe éronné';
					}
				} else {
					$connexion = 'Utilisateur inconnu';
				}
			} else {
				$connexion = 'Veuillez remplir tous les champs';
			}
		}
		$bdd = null;
		return $connexion;
	}*/
	
	
	
	$error="";
	
	/* Quand on appuie sur le bouton déconnexion de la page du 
	jeu ; on vide toutes les sessions */
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
		$msg = $funcBdd->connexionUser($_POST['user'], $_POST['passwd']);
		
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
