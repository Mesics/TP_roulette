<!--- MACCAGNO Coralie - TP Roulette : Class Player DAO --->

<!-- DAO = INTERFACE ENTRE PHP ET BASE DE DONNEES -->
<?php

$xml = simplexml_load_file($xmlstring);


class PlayerDAO {
	/*
	private $bdd; // objet PDO
	
	public function __construct()
	{
		try{
			$this->bdd=new PDO('mysql:host=localhost;dname=p1408199;charset=utf8', 'p1408199', '216169',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		}catch (Exception $e){
			die('Erreur connexion : ' . $e->getMessage());
		}
		
	} */
	/*
	public function getByName($n) {
		$sql='SELECT * from p1408199.Player WHERE name=?';
		$rep=$this->bdd->prepare($sql);
		$rep->execute(array($n));
		$data=$rep->fetch();
		$player = new Player($data['id'], $data['name'], $data['money']);
		
		return $player ; 
	}
	public function getById($i)
	{
		$sql='SELECT * from p1408199.Player WHERE id=?';
		$rep=$this->bdd->prepare($sql);
		$rep->execute(array($i));
		$data=$rep->fetch();
		$player = new playerDTO($data['id'], $data['name'], $data['money']);
		
		return $player ; 	
	}*/
		
	/* méthode de connexion de l'utilisateur */ /* 
	public function connect($user, $pwd) {
		$errorCo='';
	
		// on sélectionne les données de l'user 
		$req='SELECT * FROM p1408199.Player WHERE name = ?;';
		$reponse = $this->bdd->prepare($req);
		$reponse->execute(array($user));		
		$data = $reponse->fetch();		
	
		if($data['name'] == $user) {
		// on vérifie qu'on a bien une donnée corespondant au nom 
		rentré par l'utilisateur 
			
			if($data['password'] == $pwd) {
			//on vérifie que le mdp soit bien celui associé à l'user
			//on rentre ensuite les données dans les sessions
				$_SESSION['idUser'] = $data['id'];
				$_SESSION['user'] = $data['name'];
				$_SESSION['money'] = $data['money'];
			} else { $errorCo = 'Mot de passe éronné'; }
				
		} else { $errorCo = 'Utilisateur inconnu'; }
		
		return $errorCo; //on retourne à quelle étape s'est arrêté la méthode
	} */
	public function connect($user, $pwd) {
	
	return $errorCo; //on retourne à quelle étape s'est arrêté la méthode
	}
	
	/* méthode ajout utilisateur à base de données */
	public function addUser($user1, $pwd1)
	{
		$msg=''; 
		
		$reqUser = 'SELECT * FROM p1408199.Player WHERE name = ? ;';
		$reponse=$this->bdd->prepare($reqUser);
		$reponse->execute(array($user1));
			
		if($reponse->fetch())
		{
			$msg='Identifiant déjà utilisé';	
		}
		else
		{
			$requete='INSERT INTO p1408199.Player(name, password) values(?,?);'; 
				//on ne rentre que ces 2 valeurs car id auto-incrémenté et money par défaut à 500€
			$req=$this->bdd->prepare($requete);
			$req->execute(array($user1, $pwd1));
		}
	
		return $msg;
	}	
	
	
	/* méthode de màj d'un joueur dans la base de données */
	public function updateMoney($m, $u){
		$requete='UPDATE p1408199.Player SET money=:t_money where name=:t_user;';
		$req=$this->bdd->prepare($requete);
		$req->execute(array(
			':t_money' => $m, 
			':t_user' => $u
			));		
	}
	
	
	
	
}