<?php
session_start();
 
$bdd = new PDO('mysql:host=127.0.0.1;dbname=network', 'upjv', 'upjv2021');


 
if(isset($_GET['id']) AND $_GET['id'] > 0) {
   $getid = intval($_GET['id']);
   $requser = $bdd->prepare('SELECT * FROM membres WHERE id = ?');
   $requser->execute(array($getid));
   $userinfo = $requser->fetch();

	 if(isset($_POST['pseudo']) AND !empty($_POST['pseudo']) AND $_POST['pseudo'] != $user['pseudo']) {
      $pseudo = htmlspecialchars($_POST['pseudo']);
      $insertpseudo = $bdd->prepare("UPDATE membres SET pseudo = ? WHERE id = ?");
      $insertpseudo->execute(array($pseudo, $_SESSION['id']));
      header('Location: /mysocialnetwork/Profil/Profil.php?id='.$_SESSION['id']);
   }

   
   
   if(isset($_POST['bio']) AND !empty($_POST['bio']) AND $_POST['bio'] != $user['bio']) {
      $bio = htmlspecialchars($_POST['bio']);
      $insertbio = $bdd->prepare("UPDATE membres SET bio = ? WHERE id = ?");
      $insertbio->execute(array($bio, $_SESSION['id']));
      header('Location: /mysocialnetwork/Profil/Profil.php?id='.$_SESSION['id']);
   }
   
    if(isset($_FILES['photo']) AND !empty($_FILES['photo']['name'])) {
   $tailleMax = 2097152;
   $extensionsValides = array('jpg', 'jpeg', 'gif', 'png');
   if($_FILES['photo']['size'] <= $tailleMax) {
      $extensionUpload = strtolower(substr(strrchr($_FILES['photo']['name'], '.'), 1));
      if(in_array($extensionUpload, $extensionsValides)) {
         $chemin = "photo/".$_SESSION['id'].".".$extensionUpload;
         $resultat = move_uploaded_file($_FILES['photo']['tmp_name'], $chemin);
         if($resultat) {
            $updateavatar = $bdd->prepare('UPDATE membres SET photo = :photo WHERE id = :id');
            $updateavatar->execute(array(
               'photo' => $_SESSION['id'].".".$extensionUpload,
               'id' => $_SESSION['id']
               ));
            header('Location: /mysocialnetwork/Profil/Profil.php?id='.$_SESSION['id']);
         } else {
            $msg = "Erreur durant l'importation de votre photo de profil";
         }
      } else {
         $msg = "Votre photo de profil doit être au format jpg, jpeg, gif ou png";
      }
   } else {
      $msg = "Votre photo de profil ne doit pas dépasser 2Mo";
   }
}





$mode_edition = 0;
 	 
if(isset($_GET['edit']) AND !empty($_GET['edit'])) {
   $mode_edition = 1;
   $edit_id = htmlspecialchars($_GET['edit']);
   $edit_article = $bdd->prepare('SELECT * FROM articles WHERE id = ?');
   $edit_article->execute(array($edit_id));
   if($edit_article->rowCount() == 1) {
      $edit_article = $edit_article->fetch();
   } else {
      die('Erreur : l\'article n\'existe pas...');
   }
}

 

if(isset($_POST['article_titre'], $_POST['article_contenu'])) {
   if(!empty($_POST['article_titre']) AND !empty($_POST['article_contenu'])) {
      
      $article_titre = htmlspecialchars($_POST['article_titre']);
      $article_contenu = htmlspecialchars($_POST['article_contenu']);
      if($mode_edition == 0) {
         $ins = $bdd->prepare('INSERT INTO publications (titre, contenus,id_auteur, date_publication) VALUES (?, ?,?, NOW())');
         $ins->execute(array($article_titre, $article_contenu,$_SESSION['id']));
         $lastid = $bdd->lastInsertId();
          if(isset($_FILES['image']) AND !empty($_FILES['image']['name'])) {
            if(exif_imagetype($_FILES['image']['tmp_name']) == 2) {
               $chemin = 'image/'.$lastid.'.jpg';
               move_uploaded_file($_FILES['image']['tmp_name'], $chemin);
            } else {
               $message = 'Votre image doit être au format jpg';
            }
          }
         $message = 'Votre article a bien été posté';
      
      
      } else {
         $update = $bdd->prepare('UPDATE publications SET titre = ?, contenus = ?, date_edition = NOW() WHERE id = ?');
         $update->execute(array($article_titre, $article_contenu, $edit_id));
         header('Location:/mysocialnetwork/publications/publications.php='.$edit_id);
         $message = 'Votre article a bien été mis à jour !';
      }
   } else {
      $message = 'Veuillez remplir tous les champs';
   }
}
$articles = $bdd->prepare('SELECT * FROM publications WHERE id_auteur= ? ORDER BY date_publication DESC');
$articles->execute(array($_SESSION['id']));


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
		<link rel="stylesheet" href="Profil.css">
<BODY >
	<div class="banniere">
		<div class="photo">
	<?php	 
         {
          ?>
          <div align="center">
         <img src="photo /<?php echo $userinfo['photo']; ?>" height="200" width="200" />
         <?php
         }
         ?></div></div>
	</div>
<?php

$v=0;
 ?>
<form method="post">
	<span class="menu">
		<div align="right" class="Bparam">
			
			<span class="choix2">
				<input class="bouton" type="submit" name="publication" value="Publier">
			</span>
			<span class="choix3">
				<input class="bouton" type="submit" name="media" value="Mes Publications">
			</span>
			<span class="choix4">
				<input class="bouton" type="submit" name="amis" value="Amis">
			</span>
			<span class="choix5">
				<input class="bouton" type="submit" name="accueil" value="Accueil">
			</span>
			<span class="choix6">
				<input class="bouton" type="submit" name="editprofil" value="Editer le profil">
			</span>
		</div>
</form>		

<?php

if (isset($_POST['accueil'])) 
{ 

	header("Location: /mysocialnetwork/Home/Home.php?id=".$_SESSION['id']);
	


}

?>
	
<?php

if (isset($_POST['poster'])) 
{ 
?>
			<div class="mypblic">
				<textarea type="textaera" name="textpublic">Ecrire...</textarea>
			<div>
				<input class="boutonposter" type="submit" name="poster1" value="🖊">
			</div>	


<?php  
}

?>

<?php

if (isset($_POST['publication'])) 
{ 
?>
			<div class="public">
				<div>
					
					<span class="blocPublic">
						<img class="imgP" src="profil.jpg">
					</span>
					<span class="desc3"><?php echo $userinfo['pseudo']; ?></span>

				</div>
				<div class="contenu">
					 <form method="POST" enctype="multipart/form-data">
      <input type="text" name="article_titre" placeholder="Titre"<?php if($mode_edition == 1) { ?> value="<?= 
      $edit_article['titre'] ?>"<?php } ?> /><br />
      <textarea name="article_contenu" placeholder="Contenu de l'article"><?php if($mode_edition == 1) { ?><br><?= 
      $edit_article['contenu'] ?><?php } ?></textarea><br />
      <?php if($mode_edition == 0) { ?>
      <input type="file" name="image" /><br />
      <?php } ?>
  
      <input type="submit" value="Envoyer l'article" />
      
   </form>
   <br />
   <?php if(isset($message)) { echo $message; } ?>
				</div>
			</div>

<?php 
}

?>

<?php

if (isset($_POST['media'])) 
{ 
?>
			<div class="imgvideo" align="center">
				 <?php while($a = $articles->fetch()) { ?>
       <div align="center"><a href="/mysocialnetwork/publications/publications.php?id=<?= $a['id'] ?>"><?= $a['titre'] ?></a>   | <a href="/mysocialnetwork/publications/redaction.php?edit=<?= $a['id'] ?>">Modifier</a> | <a href="/mysocialnetwork/publications/supprimer.php?id=<?= $a['id'] ?>">Supprimer</a> | <a href="commentaire.php?id=<?= $a['id'] ?>">Commenter <br /></a> 
     </div> <?php } ?>
			</div>

<?php 
}

?>

<?php

if (isset($_POST['editprofil'])) 
{ 
?>
			<div class="edit" align="center">
				Editer le profil
				<div>
				 <form method="POST" action="" enctype="multipart/form-data">
					<span>Modifier le pseudo</span>
					<span>
						<input type="text" name="pseudo">
					</span><br>
					<span>Modifier la bio</span>
					<span>
						<input type="text" name="bio">
					</span><br>
					<span>Changer la photo de profil</span>
					<input type="file" name="photo" /><br>
					
				<span>	<input type="submit" value="Mettre à jour mon profil !" /></span>
				</form>
				</div>
				<?php if(isset($msg)) { echo $msg; } ?>
			</div>
<?php 
}

?>

<?php

if (isset($_POST['amis'])) 
{ 
?>
			<div class="like" align="center">
				Mes amis
			
			<h2> Liste d'amis : </h2>

<?php
	for($i=0;$i <sizeof($data);$i++){
		if($data[$i]['id_demandeurAmis']== $userpseudo['pseudo']){
			echo $data[$i]['id_receveurAmis'];
			$user_check[] = $data[$i]['id_receveurAmis'];  
			if ($data[$i]['statut'] ==true)
				echo "(en attente d'être accepté)";  
		
	
			
			
		
		echo'<br />';
	}
	}
		?>

<h2> Demande d'amis : </h2>

<?php
	for ($i=0; $i<sizeof($data);$i++){
		if ($data[$i]['statut'] ==true && $data[$i]['id_receveurAmis']== $userpseudo['pseudo']){
			echo $data[$i]['id_demandeurAmis']. "<a href='/mysocialnetwork/actionAmis.php?action=accept&id=". $data[$i]['id'] ."'>Accepté</a> <a href='/mysocialnetwork/actionAmis.php?action=delete&id=". $data[$i]['id'] ."'>Refusé</a>";
			$user_check[] = $data[$i]['id_demandeurAmis']; 
		}
	}
?>

			</div>
<?php 
}

?>



		
			</div>
		</div>
	</span>

	<div class="description">
		<div class="desc1" align="center"><?php echo $userinfo['pseudo']; ?></div>
		<div class="desc2" align="center">Bio  <br> <?php echo $userinfo['bio']; ?></div>
	</div>
<?php
}
?>
</BODY>
</HTML> 
