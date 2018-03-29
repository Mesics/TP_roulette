<!--- MACCAGNO Coralie - TP Roulette : Class de Control Game --->

<?php

class GameController {
	private $bdd;
	
	/* constructeur */
	public function __construct(){
		try{
			$this->bdd=new PDO('mysql:host=localhost;dname=p1408199;charset=utf8', 'p1408199', '216169',
				array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		}catch (Exception $e){
			die('Erreur connexion : ' . $e->getMessage());
		}
	}
	
	
	/* getters */
	
	
	/* setters */
	
	
	/* méthode de vérification formulaire (mises correctes) */
	public function verifMise($mise){
		$msg="";
		
		if($mise=='' || $mise==0)
			$msg="Veuillez rentrer une mise valide";
		else if  ($mise>$_SESSION['money'])
			$msg="T'as pas assez de fric, dommage...";		
	
		return $msg;
	}
	
	/* méthode de gestion des gains */
	public function gain($mode, $bet, $pari){
		/* tirage au sort */
		$tirageR=rand(1,36);
		
		if($mode=="numero")
		{
			/* on vérifie si le numéro misé correspond au numéro tiré */
			if($pari==$tirageR)
				$gain=$bet*35;
			else
				$gain=-$bet;	
		}
		else 
		{
			/* on vérifie si le numéro misé correspond à la parité tirée */
			if( ($pari=='pair' && $tirageR%2==0) || ($pari=='impair' && $tirageR%2==1))
				$gain=$bet*2;
			else
				$gain=-$bet;				
		}
		
		return $gain;
	}
	
}