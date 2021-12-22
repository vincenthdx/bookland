	<?php
	session_start();
$bdd = new PDO('mysql:host=localhost;dbname=network', 'upjv', 'upjv2021');
if(isset($_GET['t'],$_GET['id']) AND !empty($_GET['t']) AND !empty($_GET['id'])) {
   $getid =$_GET['id'];
   $gett =$_GET['t'];
   $sessionid = $_SESSION['id'];
   $check = $bdd->prepare('SELECT id FROM publications WHERE id = ?');
   $check->execute(array($getid));
   if($check->rowCount() == 1) {
      if($gett == 1) {
         $check_like = $bdd->prepare('SELECT id FROM likes WHERE id_publication = ? AND id_utilisateur = ?');
         $check_like->execute(array($getid,$sessionid));
         $del = $bdd->prepare('DELETE FROM dislikes WHERE id_publication = ? AND id_utilisateur = ?');
         $del->execute(array($getid,$sessionid));
         if($check_like->rowCount() == 1) {
            $del = $bdd->prepare('DELETE FROM likes WHERE id_publication = ? AND id_utilisateur = ?');
            $del->execute(array($getid,$sessionid));
         } else {
            $ins = $bdd->prepare('INSERT INTO likes (id_publication, id_utilisateur) VALUES (?, ?)');
            $ins->execute(array($getid, $sessionid));
         }
         
      } elseif($gett == 2) {
         $check_like = $bdd->prepare('SELECT id FROM dislikes WHERE id_publication = ? AND id_utilisateur = ?');
         $check_like->execute(array($getid,$sessionid));
         $del = $bdd->prepare('DELETE FROM likes WHERE id_publication = ? AND id_utilisateur = ?');
         $del->execute(array($getid,$sessionid));
         if($check_like->rowCount() == 1) {
            $del = $bdd->prepare('DELETE FROM dislikes WHERE id_publication = ? AND id_utilisateur = ?');
            $del->execute(array($getid,$sessionid));
         } else {
            $ins = $bdd->prepare('INSERT INTO dislikes (id_publication, id_utilisateur) VALUES (?, ?)');
            $ins->execute(array($getid, $sessionid));
         }
      }
      header("Location: /mysocialnetwork/publications/publications.php?id=".$getid);
   } else {
      exit('Erreur fatale. <a href="/mysocialnetwork/index.php">Revenir à l\'accueil</a>');
   }
} else {
   exit('Erreur fatale. <a href="/mysocialnetwork/index.php">Revenir à l\'accueil</a>');
}
