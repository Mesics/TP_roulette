<!--- MACCAGNO Coralie - TP Roulette : page roulette --->

	
<main>			
	<?php
		if($result!="")
			echo "<p>" . $result ."</p>";
	?>
	
	<h2><?= $_SESSION['user'] ?></h2>
	<p><?= $_SESSION['money'] ?>€<php>

	
	<form method="post" action="roulette.php">
		<input type="number" name="mise" min="1" placeholder="Votre mise" autofocus /><br.>
		<div id="conteneur_form">
			<label>Mise sur un nombre<br/>
				<input type="number" id='mise' name="numero" min="1" max="36" step="1" />
			</label>
			<p>ou</p>
			<label>Mise sur la parité<br/>
				<label><input type="radio" name="parite" value="pair">Pair</label><br>
				<label><input type="radio" name="parite" value="impair">Impair</label><br>
			<label>
		</div>
		<?php
			if($jeu!="")
			echo "<p id='error'>" . $jeu . "</p>";
		?>
		<input type="submit" id='jouer' value="Jouer" name="play" />
	</form>
	
	<p id='link'><a href="../index.php?deco">Deconnexion</a></p>
</main>	