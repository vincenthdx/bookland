	<?php
	session_start();
$bdd = new PDO('mysql:host=localhost;dbname=network', 'upjv', 'upjv2021');
$articles = $bdd->query('SELECT * FROM publications ORDER BY date_publication DESC');


if(isset($_SESSION['id']) AND !empty($_SESSION['id'])) {
$msg = $bdd->prepare('SELECT * FROM messagerie WHERE destinataire = ?');
$msg->execute(array($_SESSION['id']));
$msg_nbr = $msg->rowCount();



if(isset($_GET['id']) AND $_GET['id'] > 0) {
   $getid = intval($_GET['id']);
   $requser = $bdd->prepare('SELECT * FROM membres WHERE id = ?');
   $requser->execute(array($getid));
   $userinfo = $requser->fetch();
   
   
   if(isset($_SESSION['id']) AND !empty($_SESSION['id'])) {
   if(isset($_POST['envoi_message'])) {
      if(isset($_POST['destinataire'],$_POST['message']) AND !empty($_POST['destinataire']) AND !empty($_POST['message'])) {
         $destinataire = htmlspecialchars($_POST['destinataire']);
         $message = htmlspecialchars($_POST['message']);
         $id_destinataire = $bdd->prepare('SELECT id FROM membres WHERE pseudo = ?');
         $id_destinataire->execute(array($destinataire));
         $dest_exist = $id_destinataire->rowCount();
         if($dest_exist == 1) {
            $id_destinataire = $id_destinataire->fetch();
            $id_destinataire = $id_destinataire['id'];
            $ins = $bdd->prepare('INSERT INTO messagerie(expediteur,destinataire,message) VALUES (?,?,?)');
            $ins->execute(array($_SESSION['id'],$id_destinataire,$message));
            $error = "Votre message a bien été envoyé !";
         } else {
            $error = "Cet utilisateur n'existe pas...";
         }
      } else {
         $error = "Veuillez compléter tous les champs";
      }
   }
   $destinataires = $bdd->query('SELECT pseudo FROM membres ORDER BY pseudo');
   
   
   $article = $bdd->query('SELECT * FROM publications ORDER BY id DESC');
$utilisateur= $bdd->query('SELECT * FROM membres ORDER BY id DESC');
if(isset($_POST['q']) AND !empty($_POST['q'])) {
   $q = htmlspecialchars($_POST['q']);
   $utilisateur= $bdd->query('SELECT pseudo, id FROM membres WHERE pseudo LIKE "%'.$q.'%" ORDER BY id DESC');
   $article = $bdd->query('SELECT * FROM publications WHERE titre LIKE "%'.$q.'%" ORDER BY id DESC');
   if($article->rowCount() == 0) {
      $article = $bdd->query('SELECT * FROM publications WHERE CONCAT(titre, contenus) LIKE "%'.$q.'%" ORDER BY id DESC');
   }
}
   
   
   
   
   
   
   
   
   
   
   
   
?>







<HTML lang="fr">
<HEAD>
		<title>Your profil</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="Home.css">
<BODY >
	<?php
		include 'codeetfonction.php';
	 ?>
		<div class="titre" >
			<span>MysocialNetwork</span>
		<form method="post" class="tout2">	
			<span class="choixposit">	
				<select name="choixoption" id="choixoption">
				    <option value="myprofil">Mon profil</option>
				    <option value="parameter">Paramètre</option>
				    <option value="deconnect">Se déconnecter</option>
				</select>
			</span>
			<span>
				<input class="validerdirection" type="submit" name="validerdirection" value="">
			</span>
		</form>
		</div>
		<div class="barresearch" >
			<form method="POST">
				<input class="textsearch" type="search" name="q" placeholder="Recherche..." />
				<input class="bouttonsearch" type="submit" value="Rechercher">
			</form>                                                                        
			
  

		</div>
	
		


			<span class="gauche" >
			<div>
				messagerie :
				<br>
				<br>
				<form method="POST">
         <label>Destinataire:</label>
         <!-- <select name="destinataire">
            <?php while($d = $destinataires->fetch()) { ?>
            <option><?= $d['pseudo'] ?></option>
            <?php } ?>
         </select> -->
         <input type="text" name="destinataire" />
         <br /><br />
         <textarea placeholder="Votre message" name="message"></textarea>
         <br /><br />
         <input type="submit" value="Envoyer" name="envoi_message" />
         <br /><br />
         <?php if(isset($error)) { echo '<span style="color:red">'.$error.'</span>'; } ?>
      </form>
      <br />
     
      
      
      
   <h3>Votre boîte de réception:</h3>
   <?php
   if($msg_nbr == 0) { echo "Vous n'avez aucun message..."; }
   while($m = $msg->fetch()) {
      $p_exp = $bdd->prepare('SELECT pseudo FROM membres WHERE id = ?');
      $p_exp->execute(array($m['expediteur']));
      $p_exp = $p_exp->fetch();
      $p_exp = $p_exp['pseudo'];
   ?>
   <b><?= $p_exp ?></b> vous a envoyé: <br />
   <?= nl2br($m['message']) ?><br />
   -------------------------------------<br/>
   <?php } ?>
   
			</div>
			</span>
			
			
			
			<span class="centre">
				
			Fil d'actualité
				
				<div>
				<?php 
				if($article->rowCount()>0){
						while($articles=$article->fetch()){ ?>
								<div align="center"><a href="/mysocialnetwork/publications/publications.php?id=<?= $articles['id'] ?>"><?= $articles['titre'] ?></a>   | <a href="/mysocialnetwork/publications/commentaire.php?id=<?= $articles['id'] ?>">Commenter <br /></a> </div>
				<?php
				}}
				?>
     
     	
			</div>
			</span>
			
			
			<span class="droite" >
			<div>
				<?php 
					echo "Liste des utilisateurs :"  ?> <br> <br>
				<?php
					if($utilisateur->rowCount()>0){
					while($user=$utilisateur->fetch()){
					$test = "/mysocialnetwork/voir_profil.php?id=".$user['id'];
				?>
		
				<p><a href=<?php echo $test ?>><?= $user['pseudo']; ?></a></p>
		
		
		
		
				<?php
					}
	
					}else{
				?>
				<p>Aucun utilisateur trouvé</p>
				<?php
					}
					?>
			</div>
			</span>
		</div>
<?php
   }
}
}
?>
</BODY>
</HTML> 
