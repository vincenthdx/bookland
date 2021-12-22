<?php
 if (isset($_POST['validerdirection']))
 {
	if(isset($_POST['choixoption']))
	{
	    $select1 = $_POST['choixoption'];
	    switch ($select1) 
	    {
	        case 'myprofil':
				header('Location: /mysocialnetwork/Profil/Profil.php?id='.$_SESSION['id']);
	            break;
	        case 'parameter':
	            header('Location: /mysocialnetwork/Parameter/Parameter.php?id='.$_SESSION['id']);
	            break;
	        case 'deconnect':
	        	
	        	session_start();
	        	$_SESSION = array();
	        	session_destroy();
	        	

	            header('Location: /mysocialnetwork/Connexion/Connexion.php');
	            break;
	        default:
	            # code...
	            break;
   		}
	}
 }
?>
