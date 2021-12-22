<?php
session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=network', 'upjv', 'upjv2021');
 
  
  

if(isset($_GET['id']) AND !empty($_GET['id'])) {
   $get_id = htmlspecialchars($_GET['id']);
   $article = $bdd->prepare('SELECT * FROM publications WHERE id = ?');
   $article->execute(array($get_id));
   if($article->rowCount() == 1) {
      $article = $article->fetch();
      $id = $article['id'];
      $titre = $article['titre'];
      $contenu = $article['contenus'];           
       $likes = $bdd->prepare('SELECT id FROM likes WHERE id_publication = ?');
      $likes->execute(array($id));
      $likes = $likes->rowCount();
      $dislikes = $bdd->prepare('SELECT id FROM dislikes WHERE id_publication = ?');
      $dislikes->execute(array($id));
      $dislikes = $dislikes->rowCount();
      
   } else {
      die('Cet publications n\'existe pas !');
   }
} else {
   die('Erreur');
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

	
	<img src="/mysocialnetwork/Profil/image/<?= $id ?>.jpg" width="250"/>
	<br>
	<br>
	
   <h1><?= $titre ?></h1>
   <p><?= $contenu ?></p>
    <a href="/mysocialnetwork/publications/action.php?t=1&id=<?= $id ?>">J'aime</a> (<?= $likes ?>)
   <br />
   <a href="/mysocialnetwork/publications/action.php?t=2&id=<?= $id ?>">Je n'aime pas</a> (<?= $dislikes ?>)
  </div>
  <br>
 
 
</body>
</html>
