	<?php
session_start();
 
$bdd = new PDO('mysql:host=127.0.0.1;dbname=network', 'upjv', 'upjv2021');
 
if(isset($_POST['dinscrp'])) {
   $email = htmlspecialchars($_POST['email']);
   $mp = ($_POST['mp']);
   if(!empty($email) AND !empty($mp)) {
      $requser = $bdd->prepare("SELECT * FROM membres WHERE mail = ? AND mdp = ?");
      $requser->execute(array($email, $mp));
      $userexist = $requser->rowCount();
      if($userexist == 1) {
         $userinfo = $requser->fetch();
         $_SESSION['id'] = $userinfo['id'];
         $_SESSION['nom'] = $userinfo['nom'];
         $_SESSION['email'] = $userinfo['email'];
         header("Location: /mysocialnetwork/Home/Home.php?id=".$_SESSION['id']);
      } else {
         $erreur = "Mauvais mail ou mot de passe !";
      }
   } else {
      $erreur = "Tous les champs doivent être complétés !";
   }
}

if(isset($_POST['inscrip'])) {
	header("Location: /mysocialnetwork/index.php");
}
?>




<HTML>
<HEAD>
		<title>Connexion</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="Connexion.css">
<BODY >
	<p class="titre">MysocialNetwork</p>

	<div class="formul">
	<fieldset align="center">
		<legend>Connectez-vous !</legend>
		<form id="tab" method="POST">

			<table align="center">
				<tr>
					<td>
						<p>Email</p>
					</td>
					<td>
						<input class="champ" type="mail" name="email">
					</td>
					<td>
						<p>Mot de passe</p>
					</td>
					<td>
						<input class="champ" type="text" name="mp">
					</td>
				</tr>
				<tr align="center">
					<td colspan="2" align="center">
						<input class="bouton" type="submit" name="inscrip" value="S'inscrire !" href="/site4/Welcome/Welcome.php">
					</td>
					<td colspan="2" align="center">
						<input class="bouton" type="submit" name="dinscrp" value="Se connecter">
					</td>
				</tr>
			</table>

		</form>
	</fieldset>
	
	<?php
         if(isset($erreur)) {
            echo '<font color="red">'.$erreur."</font>";
         }
         ?>
	</div>
	</div>

	<div class="image" align="center">
		<img class="image1" src="smartphone.png" alt="smartphone" >
		<img class="image2" src="tt3.png" alt="personne" >
	</div>
	<p class="rejoin" >Rejoingnez nous !</p>
</BODY>
</HTML>
