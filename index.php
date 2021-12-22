<?php
	setcookie('lang','fr',time()+3600*24*365,null,null,false,true);
?>


<HEAD>
		<title>Welcome to my social Network</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="Welcome/Inscri_Connex.css">
<BODY >

	<p class="titre">MysocialNetwork</p>

	<div class="formul">
	<fieldset align="center">
		<legend>Incrivez-vous !</legend>
		<form id="tab" method="POST">

			<table align="center">
				<tr>
					<td>
						<p>Prénom</p>
					</td>
					<td>
						<input class="champ" type="text" name="Prenom">
					</td>
					<td>
						<p>Nom</p>
					</td>
					<td>
						<input class="champ" type="text" name="Nom">
					</td>
				</tr>
				<tr>
					<td>
						<p>Email</p>
					</td>
					<td>
						<input class="champ" type="mail" name="email">
					</td>
					<td>
						<p>Téléphone</p>
					</td>
					<td>
						<input class="champ" type="text" name="telephone">
					</td>
				</tr>
				<tr>
					<td>
						<p>Mot de passe</p>
					</td>
					<td>
						<input class="champ" type="text" name="mp">
					</td>
					<td>
						<p>Confirmation mot de passe</p>
					</td>
					<td>
						<input class="champ" type="text" name="cmp">
					</td>
					<tr>
					<td> 
						<p>Pseudo</p> 
					</td>
					<td> 
						<input class="champ" type="text" name="pseudo">
					</td>
					<td>
						<p>Sexe</p>
					</td>
					<td align="center"> 
						M<input class="radio" type="radio" name="sexe1" value="M">
						F<input class="radio" type="radio" name="sexe2" value="F">
					</td>
				</tr>
				<tr>
					<td>
						<p>Date de naissance</p>
					</td>
					<td> 
						<input class="date" type="date" name="naissance" >
					</td>
					<td>
						<p>Pays</p>
					</td>
					<td> 
						<input class="champ" type="text" name="pays" >
					</td>
				</tr>
				<tr>
					<td>
						<p>Code postale</p>
					</td>
					<td> 
						<input class="champ" type="text" name="copo" >
					</td>
				</tr>
				</tr>
				<tr align="center">
					<td colspan="2" align="center">
						<input class="bouton" type="submit" name="inscrip" value="S'inscrire !">
					</td>
					<td colspan="2" align="center">
						<input class="bouton" type="submit" name="dinscrp" value="Connexion">
					</td>
				</tr>
			</table>

		</form>
	</fieldset>

	<?php
	include ("Welcome/expression_reguliere.php");
	  ?>

	</div>

	<div class="image" align="center">
		<img class="image1" src="Welcome/smartphone.png" alt="smartphone" >
		<img class="image2" src="Welcome/tt3.png" alt="personne" >
	</div>
	<p class="rejoin" >Rejoingnez nous !</p>

</BODY>
</HTML>
