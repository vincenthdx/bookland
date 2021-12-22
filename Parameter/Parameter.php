<?php
	session_start();
	$bdd = new PDO('mysql:host=127.0.0.1;dbname=network', 'upjv', 'upjv2021');

	if(isset($_GET['id']) AND $_GET['id'] > 0) {
   $getid = intval($_GET['id']);
   $requser = $bdd->prepare('SELECT * FROM membres WHERE id = ?');
   $requser->execute(array($getid));
   $userinfo = $requser->fetch();
	
	 if(isset($_POST['nvmp']) AND !empty($_POST['nvmp']) AND isset($_POST['mp']) AND !empty($_POST['mp']) AND $_POST['mp'] == $userinfo['mdp'])  {
      $nvmp = htmlspecialchars($_POST['nvmp']);
       if (preg_match("/^(?=.*[A-z])(?=.*[A-Z])(?=.*[0-9])/",$_POST['mp'])){
       	   
       	   $insertnvmp= $bdd->prepare("UPDATE membres SET mdp = ? WHERE id = ?");
       	   $insertnvmp->execute(array($nvmp, $_SESSION['id']));
       	   header('Location: /mysocialnetwork/Home/Home.php?id='.$_SESSION['id']);
   }else{
   	   echo"Votre mot de passe doit contenir au moins 7 caractères, une minuscule, une majuscule et un chiffre";
   	 }
   	 }else{
   	 	 echo "Vos mots de passe sont identiques";
   	 }
   	 
   	if(isset($_POST['oui'])){
   		$supprimer= $bdd->prepare("DELETE FROM membres where id = ?");
   		$supprimer->execute(array($_SESSION['id']));
   		header("Location : /mysocialnetwork/Connexion/Connexion.php");
   	}
?>

	
<HTML lang="fr">
<HEAD>
		<title>Your profil</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="Parameter.css">

<BODY >
		<div class="titre" >
			<span>MysocialNetwork</span>
		</div>
		<div class="titre2">
			<span >Paramètre</span>
		</div>
		<div class="sousbody">
			<form method="POST">
				<div align="center">

					<span>Modifier le mot de passe</span><br>
					<span>Mot de passe actuelle</span>
					<span><input type="text" name="mp"></span><br>
					<span>Nouveau mot de passe</span>
					<span><input type="text" name="nvmp"></span><br>
					
				</div>
				<br><br><br><br>
				
				<div align="center">
				
					<span>Compte</span><br>
					<span>Supprimer le compte</span>
					<span><input type="radio" name="oui">Oui</span>
				

				
				</div>
				<br><br><br>
				<div align="center">
					<span><input class="bouton" type="submit"value="Confirmer"></span>
				</div>
			</form>
		</div>
		<?php
	}
	?>
		
</BODY>
</HTML> 
