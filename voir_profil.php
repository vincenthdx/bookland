<?php
session_start();
 
$bdd = new PDO('mysql:host=127.0.0.1;dbname=network', 'upjv', 'upjv2021');


 
if(isset($_GET['id']) AND $_GET['id'] > 0) {
   $getid = intval($_GET['id']);
   $requser = $bdd->prepare('SELECT * FROM membres WHERE id = ?');
   $requser->execute(array($getid));
   $userinfo = $requser->fetch();
   $user = $bdd->prepare('SELECT pseudo FROM membres WHERE id = ?');
   $user->execute(array($_SESSION['id']));
   $userpseudo = $user->fetch();
   
   	$amis = $bdd->prepare("SELECT * FROM amis WHERE id_demandeurAmis = :id_demandeurAmis OR id_receveurAmis = :id_receveurAmis");
	$amis->execute(["id_demandeurAmis" => $userpseudo['pseudo'], "id_receveurAmis" => $userpseudo['pseudo']]);
			
	$data = $amis->fetchAll();
	

  
	
	
   
	$user_check[] = $_SESSION['id'];
?>


<HTML>
<HEAD>
		<title>Your profil</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="/mysocialnetwork/Profil/Profil.css">
<BODY >
	<div class="banniere">
		<div class="photo"><?php	 
         {
          ?>
          <div align="center">
         <img src="/mysocialnetwork/Profil/photo /<?php echo $userinfo['photo']; ?>" height="200" width="200" />
         <?php
         }
         ?></div></div>
	</div>
<form method="post">
	
		<div align="right" class="Bparam">
			<span class="choix1">
				<input class="bouton" type="submit" name="ajouter" value="Ajouter en Amis">
			</span>
			<span class="choix2">
				<input class="bouton" type="submit" name="supprimer" value="Supprimer">
			</span>
			<span class="choix3">
				<input class="bouton" type="submit" name="bloquer" value="Bloquer">
			</span>
		
		</div>
		
</form>		
			
<?php

if (isset($_POST['ajouter'])) 
{ 
	$amis = $bdd->prepare("INSERT INTO amis (id_demandeurAmis, id_receveurAmis, statut) VALUES(:id_demandeurAmis, :id_receveurAmis, :statut)");
		
		$amis-> execute(["id_demandeurAmis" => $userpseudo['pseudo'], "id_receveurAmis" => $userinfo['pseudo'], "statut" => 1]);
		
?>
			
<?php  
}

?>

<?php

if (isset($_POST['supprimer'])) 
{ 
	$bdd->query("DELETE FROM amis WHERE id_receveurAmis=".$_GET['id']);
?>
			

<?php 
}

?>

<?php

if (isset($_POST['bloquer'])) 
{ 
	$amis = $bdd->prepare("INSERT INTO amis (id_demandeurAmis, id_receveurAmis, statut) VALUES(:id_demandeurAmis, :id_receveurAmis, :statut)");
		
		$amis-> execute(["id_demandeurAmis" => $_SESSION['id'], "id_receveurAmis" => $_GET['id'], "statut" => 3]);
?>
			

<?php 
}

?>
<br>
<div align='center'>

			<div>
				Pseudo : <?= $userinfo['pseudo'] ?>
			</div>

			<div>
				adresse mail : <?= $userinfo['mail'] ?>
			</div>
			
			<div>
				date de naissance : <?= $userinfo['naissance']?>
			</div>
			
			<div>
				pays : <?= $userinfo['pays']?>
			</div>
			
			</div>


<div class="description">
		
		<div class="desc1" align="center"><?php echo $userinfo['pseudo']; ?></div>
		<div class="desc2" align="center">Bio  <br> <?php echo $userinfo['bio']; ?></div>
	</div>
<?php
}
?>
		
</BODY>
</HTML> 
			

					
