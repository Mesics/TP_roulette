<!--- MACCAGNO Coralie - TP Roulette : page roulette --->

	
<main>			
	<?php
		if($result!="")
			echo "<p>" . $result ."</p>";
	?>
	
	<h2><?= $_SESSION['user'] ?></h2>
	<p><?= $_SESSION['money'] ?>€<p>

	
	<form method="post" action="frontController.php">
		<input type="number" name="mise" min="1" placeholder="Votre mise" autofocus /><br.>
		<div id="conteneur_form">
			<label>Mise sur un nombre<br/>
				<input type="number" id='mise' name="numero" min="1" max="36" step="1" />
			</label>
			<p>ou</p>
			<label>Mise sur la parité<br/>
				<table>
					<tr>
						<td>
							<label><input type="radio" name="parite" value="pair">Pair</label><br>
						</td>
					</tr>
					<tr>
						<td>
							<label><input type="radio" name="parite" value="impair">Impair</label><br>
						</td>
					</tr>
				</table>
			<label>
		</div>
		<?php
			if($error!='')
			echo "<p id='error'>" . $error . "</p>";
		?>
		<input type="submit" id='jouer' value="Jouer" name="play" />
	</form>
	
	<p id='link'><a href="../controller/frontController.php?deco">Deconnexion</a></p>
</main>	
