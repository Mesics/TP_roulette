<!--- MACCAGNO Coralie - TP Roulette : page connexion --->


<h2>Connexion</h2>

<form method="post" action="../controller/frontController.php">
	<input type="text" name="user" placeholder="Identifiant" autofocus /><br/>
	<input type="password" name="passwd" placeholder="Mot de passe" /><br/>
	
	<?php if($error!=''): ?>
		<p id='error'> <?= $error ?> </p>
	<?php endif ?>
	
	<input type="submit" value="Envoyer" name="submitCo" />
	<input type="reset" value="Effacer" name="reset" />
</form>


<p id='link'>Pas encore membre ? Viens t'<a href="../controller/frontController.php?inscr">inscrire</a>... </p>