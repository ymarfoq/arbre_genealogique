<?php

session_start();

if($_POST['mdp']=='marfoq'){
	$_SESSION['mdp']='marfoq';
	header('Location: marfoq/');
}
else{header('Location: ./');}
?>
