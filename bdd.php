<?php
class BaseDeDonnees {
	
	private $bdd=null;
	private $host;
	private $user;
	private $pwd;
	
	/*constructeur de la classe bdd */
	public function __construct($hote, $user, $pwd)
	{
		$this->hote=$hote;
		$this->user=$user;
		$this->pwd=$pwd;		
	}
	
	/* Getters */
	public function getHote(){ return $this->hote;}
	public function getUser() {return $this->user;}
	public function getPwd() {return $this->pwd;}
	
	/* Setters */
	public function setHote($hote1) { $this->hote = $hote1; }
	public function setUser($user1) { $this->user = $user1; }
	public function setPwd($pwd1) { $this->pwd = $pwd1; }
	
	/* méthode d'initialisation du PDO */
	public function connexionBdd(){
		try{
			$this->bdd=new PDO('mysql:host='.$this->hote.';dname=p1408199;charset=utf8', $this->user, $this->pwd,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		}catch (Exception $e){
			die('Erreur connexion : ' . $e->getMessage());
		}
	}
	
	/* méthode de connexin de l'utilisateur */
	public function connexionUser($user, $pwd) {
		
		/* on sélectionne les données de l'user */
		$reponse = $this->bdd->query('SELECT * FROM p1408199.Player WHERE name = "'.$user.'";');
		$data = $reponse->fetch();
		
		
		if($user != '' and $pwd != '') {
		/* on vérifie que les champs aient été remplis*/
			
			if($data['name'] == $user) {
			/* on vérifie qu'on a bien une donnée corespondant au nom 
			rentré par l'utilisateur */
			
				if($data['password'] == $pwd) {
				/*on vérifie que le mdp soit bien celui associé à l'user */
				/*on rentre ensuite les données dans les sessions*/
					$_SESSION['idUser'] = $data['id'];
					$_SESSION['user'] = $data['name'];
					$_SESSION['money'] = $data['money'];
					$errorCo = 'ok';
				} else { $errorCo = 'Mot de passe éronné'; }
				
			} else { $errorCo = 'Utilisateur inconnu'; }
		
		} else { $errorCo = 'Veuillez remplir tous les champs'; }
		
		return $errorCo; //on retourne à quelle étape s'est arrêté la méthode
	}
	
	
	/* méthode ajout utilisateur à base de données */
	public function ajoutUser($user1, $pwd1)
	{
		$msg=''; 
		
		$reqUser = 'SELECT * FROM p1408199.Player WHERE name = ? ';
		$reponse=$this->bdd->prepare($reqUser);
		$reponse->execute(array($user1));
			
		if($reponse->fetch())
		{
			$msg='Identifiant déjà utilisé';	
		}
		else
		{
			$requete='INSERT INTO p1408199.Player(name, password) values(?,?)';
			$req=$this->bdd->prepare($requete);
			$req->execute(array($user1, $pwd1));
		}
		
		return $msg;
	}	
	
	
	/* méthode de màj d'un joueur dans la base de données */
	public function majUser($money1, $user1){
		$requete='UPDATE p1408199.Player SET money=:t_money where name=:t_user;';
		$req=$this->bdd->prepare($requete);
		$req->execute(array(
			':t_money' => $money1, 
			':t_user' => $user1
			));		
	}
	
	
	/*méthode ajout de partie dans la bdd */
	public function ajoutPartie($user, $bet, $profit) 
	{
		/* on, récupère l'id du joueur */
		//$reqId='SELECT id FROM P1408199.Player where name="'.$user.'";';
		$rep=$this->bdd->query('SELECT id FROM p1408199.Player where name="'.$user.'";');
		$data=$rep->fetch();

		
		/* on récupère la date courante */
		$datetime=date("Y-m-d H:i:s");

		/* on ajout le tout dans la base de données */
		$requete= 'INSERT INTO p1408199.Game(Player, date, bet, profit) 
			VALUES(:t_player, :t_date, :t_bet, :t_profit);';
		$req=$this->bdd->prepare($requete);
		$req->execute(array(
			':t_player' => $data['id'],
			':t_date' => $datetime,
			':t_bet' => $bet,
			':t_profit' => $profit ));
	}
}