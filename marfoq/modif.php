<?php
$connStr = 'sqlite:bases/famille.db';
try {
	$conn = new PDO($connStr);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	if($_POST['type']=='conjoint'){
		
		$genre = $_POST['genre'];
		$id_conjoint = $_POST['conjoint'];
		$prenom = $_POST['prenom'];
		$nom = $_POST['nom'];
		$naissance = $_POST['jour']."-".$_POST['mois']."-".$_POST['annee'];
		$id=time();
		if($_FILES['photo']['size']>100){
			$photo = "bases/photos/".$id."".strtolower(strrchr($_FILES['icone']['name'], '.'));
			move_uploaded_file($_FILES['photo']['tmp_name'],$photo);
		}
		else{$photo="bases/photos/anonyme.jpg";}
		
		$sth=$conn->prepare('INSERT INTO 
						conjoints(id, conjoint, prenom, nom, naissance, genre,  photo) 
						VALUES(?,?,?,?,?,?,?);');
		$sth->execute(array($id, $id_conjoint, $prenom, $nom, $naissance, $genre, $photo));
		
		$sth=$conn->prepare('UPDATE marfoq SET conjoint = 1 WHERE id=?;');
		$sth->execute(array($id_conjoint));		
		
		header('Location: ./');
	}
	else if($_POST['type']=='enfant'){
		
		$genre = $_POST['genre'];
		$prenom = $_POST['prenom'];
		$nom = $_POST['nom'];
		$naissance = $_POST['jour']."-".$_POST['mois']."-".$_POST['annee'];
		$annee=$_POST['annee'];
		$id_parent=$_POST['parent'];
		$id=time();
		if($_FILES['photo']['size']>100){
			$photo = "bases/photos/".$id."".strtolower(strrchr($_FILES['icone']['name'], '.'));
			move_uploaded_file($_FILES['photo']['tmp_name'],$photo);
		}
		else{$photo="bases/photos/anonyme.jpg";}
		
		$sth=$conn->prepare('INSERT INTO 
						marfoq(id, genre, nom, prenom, parent, naissance, annee, photo) 
						VALUES(?,?,?,?,?,?,?,?);');
		$sth->execute(array($id, $genre, $nom, $prenom, $id_parent, $naissance, $annee, $photo));
		
		$sth=$conn->prepare('UPDATE marfoq SET enfants=enfants+1 WHERE id=?;');
		$sth->execute(array($id_parent));		
		
		header('Location: ./');
	}
	else if($_POST['type']=='supprimer'){
		$sth=$conn->prepare('update marfoq set parent=-1 where id=?;');
		$sth->execute(array($_POST['id']));
		
		header('Location: ./');
	}
	else if($_POST['type']=='ajout'){
	$genre = $_POST["genre"];
	$prenom = $_POST["prenom"];
	$naissance = $_POST["jour"]."-".$_POST["mois"]."-".$_POST["annee"];
	$annee = $_POST["annee"];
	$id=time();
	if(isset($_FILES['photo']['tmp_name'])){
			$photo = "bases/photos/".$id."".strtolower(strrchr($_FILES['icone']['name'], '.'));
			move_uploaded_file($_FILES['photo']['tmp_name'],$photo);
		}
		else{$photo="bases/photos/anonyme.jpg";}

	$sth=$conn->prepare('INSERT INTO 
						marfoq(id, genre, prenom, naissance, annee,  photo) 
						VALUES(?,?,?,?,?,?);');
	$sth->execute(array($id, $genre, $prenom, $naissance, $annee, $photo));
				
		header('Location: ./');
	}

}
	catch( PDOException $Exception ){
		echo $Exception->getMessage() ."\n"; }
?>
