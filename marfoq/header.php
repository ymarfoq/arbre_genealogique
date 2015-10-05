<header>
	<?php
	
	$connStr = 'sqlite:bases/famille.db';
	try {
		$conn = new PDO($connStr);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$conn->query('CREATE TABLE IF NOT EXISTS marfoq (
							incr INTEGER PRIMARY KEY, 
							id INTEGER, 
							genre TEXT, 
							nom TEXT DEFAULT "Marfoq", 
							prenom TEXT, 
							parent INTEGER DEFAULT 0, 
							enfants INTEGER DEFAULT 0, 
							conjoint INTEGER DEFAULT 0, 
							naissance TEXT,
							annee INTEGER,
							photo TEXT);');
	
	$conn->query('CREATE TABLE IF NOT EXISTS conjoints(
							incr INTEGER PRIMARY KEY, 
							id INTEGER, 
							conjoint INTEGER, 
							prenom TEXT, 
							nom TEXT, 
							naissance TEXT, 
							genre TEXT, 
							photo TEXT);');
	}
	catch( PDOException $Exception ){
		echo $Exception->getMessage() ."\n"; }
	
	?>
	<!--
	<nav>
		<form action='modif.php' method='post' enctype='multipart/form-data'>
			<h2>Ajouter un ancètre Marfoq: </h2>
				<input type='hidden' name='type' value='ajout'>
				<label for='genre'>Genre : </label>
				<input type='radio' name='genre' value='homme' required checked>&#9794;
				<input type='radio' name='genre' value='femme' required>&#9792;
				<label for='prenom'> | Prénom : </label>
				<input type='text' name='prenom' size='13' required>
				<label for='photo'> | Photo : </label><input type='file' name='photo'>
				<label for='birthday'> | Date de naissance : </label>
				<select name='jour'>
					<option selected>jour</option>
					<?php for($d=1;$d<=31;$d++){echo "<option value=".$d.">".$d."</option>";}?>
				</select> 
				<select name='mois'>
					<option selected>mois</option>
					<?php for($m=1;$m<=12;$m++){echo "<option value=".$m.">".$m."</option>";}?>
				</select> 
				<select name='annee'>
					<option selected >année</option>
					<?php for($y=date('Y');$y>=1900;$y--){echo "<option value=".$y.">".$y."</option>";}?>
				</select>
			<label for='ajouter'>-></label>	
			<input type='submit' value='ajouter'>
		</form>
	</nav>
	-->
	<h1>La Famille Marfoq</h1>	
</header>
