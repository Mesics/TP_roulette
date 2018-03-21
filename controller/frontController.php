<?php 
/* MACCAGNO Coralie - TP Roulette : Controller principal */

/* rôle du controller -> vérifier que les infos soient bonnes (isset $_POST , etc...) */



session_start();
require_once('../model/PlayerDAO.php');
require_once('../model/GameDAO.php');


$error='';
$module='connexion';

if($module=='connexion')
	$titlePage=' - Connexion';
else if ($module=='inscription')
	$titlePage=' - Inscription';
else 
	$titlePage='';


/* Quand on appuie sur le bouton déconnexion de la page du 
jeu :  on vide toutes les sessions */
if (isset($_GET['deco'])){
	//on vide la session
	unset($_SESSION['user']);
	unset($_SESSION['money']);
}


/* si le joueur est déjà connecté on le redirige
	sur la page du jeu */
if (isset($_SESSION['user']))
	$module='roulette';
/* si il n'y a pas de session ouverte on redirige vers l'acceuil */
else
	$module='connexion';



/***** CONNEXION JOUEUR *****/
if($module=='connexion')
{
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
	if(isset($_POST['submitIn']))
	{	
		$error='';
		
		if (isset($_POST['user']) && $_POST['user']!="")  //vérif entrée identifiant
		{
			if(isset($POST['passwd']) && $_POST['passwd']!="") //vérif entrée mdp
			{ 
				/* on inscrit l'user */
				$playerDAO = new PlayerDAO();
				$error=$playerDAO->addUser($_POST['user'], $_POST['passwd']);
				
				/* et on ouvre sa session en se connectant*/
				if ($error=='')
				{
					$error = ($playerDAO->connect($_POST['user'], $_POST['passwd']));
					if($error=='')	$module='roulette';
				}
			}else $error='Veuillez entre votre mot de passe';
		} else $error='Veuillez entrer votre identifiant';
	}
}

/***** JEU *****/
else if($module=='roulette')
{

	$error='';
	$result='';
	//$tirageR=0;
	$gain=0;

	if(isset($_POST['play']))
	{ //quand on appuie sur le bouton jouer ...
		
		$gameC = new GameController();
		$error=$gameC->verifMise($_POST['mise']);
		
		if ($error=='')
		{
			$choix='';
			
			/* on détermine quel est le mode de pari (numéro ou parité) */
			if(isset($_POST['numero']) && $_POST['numero']!="")	$choix='numero';
			else 
			{
				if( isset($_POST['parite']) )	$choix='parite';
				else	$error='Il faut parier aussi... !'; //si pari ni sur numero ni sur parité
			}
			
			/* on lance la roulette ! *roulement de tambour* */
			if($choix!='')
			{
				$gain=$gameC->gain($_POST[$choix]);
				
				if($gain>0)
					$result='Bravo c\'est gagné !';
				else
					$result='Ouuups, c\'est perdu... retente ta chance ;)';
				
				/* mise à jour de la session */
				$_SESSION['money']+=$gain;
				
				/* mise à jour de l'argent du joueur dans la bdd */
				$player = new PlayerDAO();
				$player->updateMoney($_SESSION['money'],$_SESSION['user']);
				
				/* ajout de la partie dans la base de données */
				$game = new GameDAO();
				$game->addGame($_SESSION['user'],$_POST['mise'],$gain);
			}
		}	

	}
}


include('../view/layout.php');