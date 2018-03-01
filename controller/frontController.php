<!--- MACCAGNO Coralie - TP Roulette : Controller principal --->


<?php 
session_start();
require_once('../model/UserDAO.php');
require_once('../model/GameDAO.php');


$error='';
$module='connexion';

/* Quand on appuie sur le bouton déconnexion de la page du 
jeu :  on vide toutes les sessions */
if (isset($_GET['deco'])){
	##on vide la session
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

if($module=='connexion')
{
	//include('../view/connexion.php');
	/* vérification de l'identité */
	if(isset($_POST['submitCo']))
	{
		$username=$_POST['user'];
		$error = $bdd->connexionUser($_POST['user'], $_POST['passwd']);
		if($error=='')	$module='roulette';
	}

else if($module='inscription')
	if(isset($_POST['submitIn']))
	{		
		/* on inscrit l'user */
		$error=$bdd->ajoutUser($_POST['user'], $_POST['passwd']);
		/* et on ouvre sa session */
		if ($error=='')
		{
			$error = ($bdd->connexionUser($_POST['user'], $_POST['passwd']));
			if($error=='')	$module='roulette';
		}
	}
}

else { if($module=='roulette')
{

	$jeu="";
	$result="";
	$tirageR=0;
	$gain=0;

	if(isset($_POST['play']))
	{ //quand on appuie sur le bouton jouer ...

		$error=$bdd->verifMise($_POST['mise']);
		if ($error=='')
		{
			$choix='';
			if(isset($_POST['numero']) && $_POST['numero']!="")	$choix='numero';
			else 
			{
				if( isset($_POST['parite']) )	$choix='parite';
				else	$error='Il faut parier aussi... !'; //si pari ni sur numero ni sur parité
			}
			
			if($choix!='')
			{		
				$gain=$bdd->gain($_POST[$choix]);
				if($gain>0)
					$result='Bravo c\'est gagné !';
				else
					$result='Ouuups, c\'est perdu... retente ta chance ;)';
				/* mise à jour de la session */
				$_SESSION['money']+=$gain;
				/* mise à jour de l'argent du joueur dans la bdd */
				$bdd->majUser($_SESSION['money'],$_SESSION['user']);
				/* ajout de la partie dans la base de données */
				$bdd->ajoutPartie($_SESSION['user'],$_POST['mise'],$gain);
			}
		}	

	}
}}



include('../view/layout.php');