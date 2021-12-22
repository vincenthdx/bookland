	<?php
	
$bdd = new PDO('mysql:host=127.0.0.1;dbname=network', 'upjv', 'upjv2021');
$mode_edition = 0;
 	 
if(isset($_GET['edit']) AND !empty($_GET['edit'])) {
   $mode_edition = 1;
   $edit_id = htmlspecialchars($_GET['edit']);
   $edit_article = $bdd->prepare('SELECT * FROM publications WHERE id = ?');
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
         $ins = $bdd->prepare('INSERT INTO publications (titre, contenus,id_auteur, date_publication) VALUES (?, ?, NOW())');
         $ins->execute(array($article_titre, $article_contenu, $_SESSION['id']));
         $message = 'Votre article a bien été posté';
         
      header('Location: /mysocialnetwork/Home/Home.php?id='.$_SESSION['id']);
      
      } else {
         $update = $bdd->prepare('UPDATE publications SET titre = ?, contenus = ?, date_publication = NOW() WHERE id = ?');
         $update->execute(array($article_titre, $article_contenu, $edit_id));
         header('Location: /mysocialnetwork/publications/publications.php?id='.$edit_id);
         $message = 'Votre article a bien été mis à jour !';
      }
   } else {
      $message = 'Veuillez remplir tous les champs';
   }
}
	 
?>


<!DOCTYPE html>
<html>
<head>
   <title>Accueil</title>
   <meta charset="utf-8">
   <link rel="stylesheet" href="/mysocialnetwork/Home/Home.css">
</head>
<body>
<div class="titre" >

			<span>MysocialNetwork</span>
		
 
</div>

<div align="center">

	
	 <form method="POST" enctype="multipart/form-data">
      <input type="text" name="article_titre" placeholder="Titre"<?php if($mode_edition == 1) { ?> value="<?= 
      $edit_article['titre'] ?>"<?php } ?> /><br />
      <textarea name="article_contenu" placeholder="Contenu de l'article"><?php if($mode_edition == 1) { ?><?= 
      $edit_article['contenus'] ?><?php } ?></textarea><br />
  
      <input type="submit" value="Envoyer l'article" />
      
   </form>
   <br />
   <?php if(isset($message)) { echo $message; } ?>
</body>
</html>
 
 


