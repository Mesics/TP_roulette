<?php
class BaseDeDonnees {
	
	private $bdd=null;
	private $host;
	private $user;
	private $pwd;
	private $erreur="";
	
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
			$this->bdd=new PDO('mysql:host='.$this->hote.';dname=p1408199;charset=utf8', $this->user, $this->pwd);
			//return $this->bdd;
		}catch (Exception $e){
			die('Erreur connexion : ' . $e->getMessage());
			//return false;
		}
	}
	
	/* méthode de connexin de l'utilisateur */
	public function connexionUser($user, $pwd) {
		//$this->bdd = connexionBdd();
		if($this->bdd) {
			$reponse = $this->bdd->query('SELECT * FROM p1408199.Player WHERE name = "'.$user.'";');
			$data = $reponse->fetch();
			
			if($user != '' and $pwd != '') {
				if($data['name'] == $user) {
					if($data['password'] == $pwd) {
						$_SESSION['idUser'] = $data['id'];
						$_SESSION['user'] = $data['name'];
						$_SESSION['money'] = $data['money'];
						$errorCo = 'ok';
					} else {
						$errorCo = 'Mot de passe éronné';
					}
				} else {
					$errorCo = 'Utilisateur inconnu';
				}
			} else {
				$errorCo = 'Veuillez remplir tous les champs';
			}
		}
		//$this->bdd = null;
		return $errorCo;
	}
	
	/* méthode ajout utilisateur à base de données */
	public function ajoutUser($user1, $pwd1)
	{
		$requete='INSERT INTO p1408199.Player(name, password) values(?,?)';
		$req=$this->bdd->prepare($requete);
		$req->execute(array($user1, $pwd1));
	}	
	
	/* méthode de màj d'un joueur dans la base de données */
	public function majUser($money, $user1,$pwd1){
		$requete='UPDATE Player SET money=:t_money where user=:t_user and password=:t_pwd;';
		$req=$this->bdd->prepare($requete);
		$req->execute(array(
			:t_money => $money, 
			:t_user => $user1, 
			:t_pwd => $pwd1
			));		
	}
	
	/*méthode ajout de partie dans la bdd */
	public function ajoutPartie() {
		
	}
}