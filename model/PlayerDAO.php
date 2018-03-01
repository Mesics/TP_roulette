<!--- MACCAGNO Coralie - TP Roulette : Class Player DAO --->

<!-- DAO = INTERFACE ENTRE PHP ET BASE DE DONNEES -->
<?php
class PlayerDAO {
	private $bdd // objet PDO
	
	public function __construct() {
		try{
			$this->bdd=new PDO('mysql:host=localhost;dname=p1408199;charset=utf8', 'p1408199', '216169',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		}catch (Exception $e){
			die('Erreur connexion : ' . $e->getMessage());
		}
		
	}
	
	public function getByName($n) {
		$sql='SELECT * from p1408199.Player WHERE name=?';
		$rep=$this->bdd->prepare($sql);
		$rep->execute(array($n));
		$data=$rep->fetch();
		$player = new playerDTO($data['id'], $data['name'], $data['money']);
		
		return $player ; 
	}
	
	
	/* fonction updateMoney .... */
	
	
}