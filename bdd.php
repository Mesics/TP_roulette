<?php
class bdd {
	
	private $bdd;
	private $host;
	private $user;
	private $pwd;
	
	/* méthode d'initialisation du PDO */
	public function connexionBdd(){
		try{
			$bdd=new PDO('mysql:host=localhost;dname=p1408199;charset=utf8', 'p1408199', '216169');
			return $bdd;
		}catch (Exception $e){
			die('Erreur connexion : ' . $e->getMessage());
			return false;
		}
	}
	
	/* méthode de connexin de l'utilisateur */
	public function connexionUser($user, $pwd) {
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
	
	/* méthode ajout utilisateur à base de données */
	public function ajoutUser() {
		/* blabla */
	}
	
	/* méthode de màj dun joueur dans la base de données */
	public function majUser(){
		
		
	}
	
	/*méthode ajout de partie dans la bdd */
	public function ajoutPartie() {
		
	}
}