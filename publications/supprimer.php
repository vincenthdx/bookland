<?php
session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=network', 'upjv', 'upjv2021');
if(isset($_GET['id']) AND !empty($_GET['id'])) {
   $suppr_id = htmlspecialchars($_GET['id']);
   $suppr = $bdd->prepare('DELETE FROM publications WHERE id = ?');
   $suppr->execute(array($suppr_id));
   header('Location: /mysocialnetwork/Home/Home.php?id='.$_SESSION['id']);
}
?>
