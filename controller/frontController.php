<!--- MACCAGNO Coralie - TP Roulette : Controller principal --->


<?php 
	session_start();
	require_once('bdd.php');
	
	/* connexion à la base de données */
	$basedonnee = new BaseDeDonnees('localhost','p1408199','216169');
	$basedonnee->connexionBdd();

	$error="";
	$module='connexion';
	
	
	/* Quand on appuie sur le bouton déconnexion de la page du 
	jeu :  on vide toutes les sessions */
	if (isset($_GET['deco'])){
		##on vide la session
		unset($_SESSION['user']);
		unset($_SESSION['money']);
	}
	
	
	/* si le joueur est déjà connecté on le redirige directement
		sur la page du jeu */
	if (isset($_SESSION['user']))
		$module='roulette';
	
	
	/* vérification de l'identité */
	if(isset($_POST['submit']))
	{
		$msg = $basedonnee->connexionUser($_POST['user'], $_POST['passwd']);
		if ($msg!='ok')
			$error=$msg;
		else 
			header('Location: roulette.php');
	}
	
	
	
	include('../view/layout.php');