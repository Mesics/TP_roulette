<!--- MACCAGNO Coralie - TP Roulette : page inscription --->


<h2>Inscription</h2>
<form method="post" action="../controller/frontController.php">
	<input type="text" name="userIn" placeholder="Identifiant" autofocus /><br/>
	<input type="password" name="pwdIn" placeholder="Mot de passe" /><br/>
	<?php
		if($error!='') 
			echo "<p id='error'> " . $error . "</p>";
	?>
	<input type="submit" value="Envoyer" name="submitIn" />
	<input type="reset" value="Effacer" name="reset" />
</form>

<p id='link'>Déjà membre de notre super jeu ? <a href="../index.php">Connecte toi</a> </p>
