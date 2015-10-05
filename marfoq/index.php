<?php

session_start();

if($_SESSION['mdp']=='marfoq'){
	?>

<html>
	<head>
		<meta content="text/html; charset=utf-8" http-equiv="Content-Type"></meta>
		<link href="style.css" type="text/css" rel="stylesheet"></link>
		<link href="arbre.css" type="text/css" rel="stylesheet"></link>

<?php include 'affichage_famille.php' ?>

<script>
function revelation(id){
	var fiche=document.getElementById(id);
	var allelem=document.getElementsByClassName('fiche')
	for (var i = 0; i < allelem.length; ++i) {
		var autrefiche = allelem[i];  
		autrefiche.style.display='none';
	}
	fiche.style.display='block';
}

function cachage(id){
	var elem=document.getElementById(id);
	elem.style.display='none';
}

</script>
	</head>
<body>
	
<?php include 'header.php'; ?>

<section>
<aside id='regle'>
	<?php
	$generation=0;
	while ($generation < 10){
		$height = 84+$generation*97;
		echo "<span class='grad' style='top:".$height."px;'>génération ".$generation."</span>";
		$generation++;
	}
	?>
</aside>
<article>
	<div class="tree">
	<?php
    $o = $conn->query('SELECT * FROM marfoq WHERE parent==0');
	$origine = $o->fetchAll();
	
	echo "<ul>";
	foreach ($origine as $o_entry) {
		affichage_famille($o_entry['id'],$conn);		
		}
	echo "</ul>";
	?>
	</div>
</article>
</section>
</body>
</html>
<?php
}
else{header('Location: ../');}
	?>
