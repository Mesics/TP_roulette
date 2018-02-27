<?php 
	session_start();
	
	/* connexion à la base de données */
	function connexionBdd(){
		try{
			$bdd=new PDO('mysql:host=localhost;dname=p1408199;charset=utf8', 'p1408199', '216169');
			return $bdd;
		}catch (Exception $e){
			die('Erreur connexion : ' . $e->getMessage());
			return false;
		}
	}
	
	function connexionUser($user, $pwd) {
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
	}
	/* fonction d'ajout d'un utilisateur */
	function ajoutUser($user, $pwd)
	{
		$bdd = connexionBdd();
		if($bdd)
		{
			$requete = 'INSERT INTO p1408199.Player (name, password) 
				values ("' . $user . '","'. $pwd .'";)';
			$req=$bdd->prepare($requete);
			$req->execute(
				array(
					
		}	
		$bdd=null;		
	}
		
	
	$error="";
	
	if(isset($_POST['submit']))
	{		
		if(isset($_POST['user']) && $_POST['user']!="")
		{
			if(isset($_POST['passwd']) && $_POST['passwd']!="")
			{
				ajoutUser($_POST['user'], $_POST['passwd']);
				$msg=connexionUser($_POST['user'], $_POST['passwd']);
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
				if($error!="") echo "<p id='error'> " . $error . "</p>";
			?>
			<input type="submit" value="Envoyer" name="submit" />
			<input type="reset" value="Effacer" name="reset" />
		</form>

		<p id='link'>Déjà membre de notre super jeu ? <a href="index.php">Connecte toi</a> </p>

	</body>
	
</html>