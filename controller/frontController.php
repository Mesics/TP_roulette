<?php 
/* MACCAGNO Coralie - TP Roulette : Controller principal */

/* rôle du controller -> vérifier que les infos soient bonnes (isset $_POST , etc...) */


session_name('p1408199');
session_start();
require_once('../model/PlayerDAO.php');
require_once('../model/GameDAO.php');
require_once('GameController.php');

$result="";
$error='';
$module='';
$titlePage='';


if (isset($_GET['deco'])){
	//on vide la session si apuuie sur déco 
	unset($_SESSION['user']);
	unset($_SESSION['money']);
}

/* si le joueur est déjà connecté on le redirige
	sur la page du jeu */
if (isset($_SESSION['user']))
	$module='roulette';
else 
	$module='connexion';

if(isset($_GET['inscr']))
{
	$module='inscription';
	
} else if(isset($_POST['submitIn']))
{ // ajout user
	$module='inscription';
	
	$error='';
	
	if (isset($_POST['userIn']) && $_POST['userIn']!='')  //vérif entrée identifiant
	{
		if(isset($_POST['pwdIn']) && $_POST['pwdIn']!='') //vérif entrée mdp
		{ 
			/* on inscrit l'user */
			$playerDAO = new PlayerDAO();
			$error=$playerDAO->addUser($_POST['userIn'], $_POST['pwdIn']);
			
			/* et on ouvre sa session en se connectant*/
			if ($error=='')
			{
				$error = ($playerDAO->connect($_POST['userIn'], $_POST['pwdIn']));
				if($error=='')	$module='roulette';
			}
		}else $error='Veuillez entrer un mot de passe';
	} else $error='Veuillez entrer un identifiant';
	
} else if(isset($_POST['play'])) // **** JEU ***
{ //quand on appuie sur le bouton jouer ...
	$result="";
	$error="";

	$profit=0;
	
	$gameC = new GameController();
	$error=$gameC->verifMise($_POST['mise']);
	
	if ($error=='')
	{
		$choix='';
		
		/* on détermine quel est le mode de pari (numéro ou parité) */
		if(isset($_POST['numero']) && $_POST['numero']!="")	
		{
			$choix='numero';
			$pari=$_POST['numero'];
		}
		else 
		{
			if( isset($_POST['parite']) )
			{
				$choix='parite';
				$pari=$_POST['parite'];
			}
			else	$error='Il faut parier aussi... !'; //si pari ni sur numero ni sur parité
		}
		
		/* on lance la roulette ! *roulement de tambour* */
		if($choix!="")
		{
		$profit=$gameC->gain($_POST[$choix], $_POST['mise'], $pari);

			if($profit>0)
				$result='Bravo c\'est gagné ! <br/> Tu a gagné '. $profit;
			else
				$result='Ouuups, c\'est perdu... retente ta chance ;) <br/> Tu as perdu '.$profit;
			
			/* mise à jour de la session */
			$_SESSION['money']+=$profit;
			
			/* mise à jour de l'argent du joueur dans la bdd */
			$player = new PlayerDAO();
			$player->updateMoney($_SESSION['money'],$_SESSION['user']);
			
			/* ajout de la partie dans la base de données */
			$game = new GameDAO();
			$game->addGame($_SESSION['user'],$_POST['mise'],$profit);
		}
	}	
}



/***** CONNEXION JOUEUR *****/
if($module=='connexion')
{
	$titlePage=' - Connexion';

	/* vérification de l'identité */
	if(isset($_POST['submitCo']))
	{
		if (isset($_POST['user']) && $_POST['user']!="")
		{ //vérif entrée identifiant
			if(isset($_POST['passwd']) && $_POST['passwd']!="") //vérif entrée mdp
			{ 
				/* on connecte le player */
				$playerDAO = new PlayerDAO();
				$error = $playerDAO->connect($_POST['user'], $_POST['passwd']);
				if($error=='')	$module='roulette';
			}else $error='Veuillez entrer votre mot de passe';
		} else $error='Veuillez entrer votre identifiant';
	}
}

/**** INSCRIPTION JOUEUR ****/
else if($module=='inscription')
{
	$titlePage=' - Inscription';
}

/***** JEU *****/
else if($module=='roulette')
{
	$titlePage='';

}


include('../view/layout.php');