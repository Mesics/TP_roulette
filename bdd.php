<?php
	function connexionBdd(){
		try{
			$bdd=new PDO('mysql:host=iutdoua-web.univ-lyon1.fr;dname=test;charset=utf8', 'p1408199', '216169');
			return $bdd;
		}catch (Exception $e){
			die('Erreur connexion : ' . $e->getMessage());
			return false;
		}

	function connexionJoueur($user, $pwd) {
		$bdd = connexionBdd();
		if($bdd) {
			$query = $bdd->query('SELECT * FROM Player WHERE name = "'.$user.'";');
			$data = $query->fetch();
			if($user != '' and $pwd != '') {

				if($data['name'] == $user) {
					if($data['password'] == $pwd) {
						$_SESSION['idUser'] = $data['id'];
						$_SESSION['nameUser'] = $data['name'];

					$_SESSION['joueur_argent'] = $data['argent'];
					$res = 'ok';
				} else {
					$res = 'Mot de passe éronné';
				}
			} else {
				$res = 'Utilisateur inconnu';
			}
		} else {
			$res = 'Vous devez remplir les champs';
		}
	}
	$bdd = null;
	return $res;
}




?>
