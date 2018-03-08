<!--- MACCAGNO Coralie - TP Roulette : Class Game DAO --->

<?php

/* REVOIR CETTE PAGE !!!*/

Class GameDAO {
	private $bdd; // objet PDO
	
	public function __construct() {
		try{
			$this->bdd=new PDO('mysql:host=localhost;dname=p1408199;charset=utf8', 'p1408199', '216169',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		}catch (Exception $e){
			die('Erreur connexion : ' . $e->getMessage());
		}
		
	}

	public function getByName($n)
	{
		
		//blabla
	}

	
	/*méthode ajout de partie dans la bdd */
	public function addGame($user, $bet, $profit) 
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