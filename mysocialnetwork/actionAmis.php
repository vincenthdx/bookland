<?php
	session_start();
	
	
	$bdd = new PDO('mysql:host=127.0.0.1;dbname=network', 'upjv', 'upjv2021');
	
	 $user = $bdd->prepare('SELECT pseudo FROM membres WHERE id = ?');
   $user->execute(array($_SESSION['id']));
   $userpseudo = $user->fetch();
	if($_GET['action'] == 'delete' || $_GET['action'] == 'deny'){
		$bdd->query("DELETE FROM amis WHERE id=".$_GET['id']);
		header('Location:/mysocialnetwork/Profil/Profil.php?id='.$_SESSION['id']);
	}
	
	if($_GET['action'] == 'accept'){
		$bdd->query("UPDATE amis SET statut = 0 WHERE id= ". $_GET['id']);
		header('Location:/mysocialnetwork/Profil/Profil.php?id='.$_SESSION['id']);
	}
			
	if($_GET['action'] == 'add'){
		$amis = $bdd->prepare("INSERT INTO amis (id_demandeurAmis, id_receveurAmis, statut) VALUES(:id_demandeurAmis, :id_receveurAmis, :statut)");
		
		$amis-> execute(["id_demandeurAmis" => $userpseudo['pseudo'], "id_receveurAmis" => $_GET['pseudo'], "statut" => 1]);
		header('Location:/mysocialnetwork/Profil/Profil.php?id='.$_SESSION['id']);
	}
?>
