<?php
	session_start();
$bdd = new PDO('mysql:host=localhost;dbname=network', 'upjv', 'upjv2021');
function verifage($datetime1,$datetime2)
{
	$interval = $datetime1->diff($datetime2);
	$nb=$interval->format('%y années');
	if ($nb>=12) {
		return true;
	}
	else
	{
		return false;
	}
}



   

   



if (isset($_POST['inscrip']))
{
	if ((!empty($_POST['Prenom'])) && (!empty($_POST['Nom'])) && (!empty($_POST['email'])) && (!empty($_POST['telephone'])) && (!empty($_POST['mp'])) && (!empty($_POST['cmp'])) && !empty($_POST['pseudo']) AND !empty($_POST['naissance']) AND !empty($_POST['pays']) AND (!empty($_POST['sexe1']) OR !empty($_POST['sexe2'])) AND !empty($_POST['copo']))
	{
		   $nom = htmlspecialchars($_POST['Nom']);
		   $prenom = htmlspecialchars($_POST['Prenom']);
		   $email = htmlspecialchars($_POST['email']);
		  
		   $telephone = htmlspecialchars($_POST['telephone']);
		   $mp = ($_POST['mp']);
		   $cmp = ($_POST['cmp']);
		  
		   $pseudo = htmlspecialchars($_POST['pseudo']);
		   $naissance = htmlspecialchars($_POST['naissance']);
		   $pays = htmlspecialchars($_POST['pays']);
		   $copo = htmlspecialchars($_POST['copo']);
		   $pseudolength = strlen($pseudo);
		   $copolength=strlen($copo);

		if (preg_match("/[a-zA-Z]{2}/",$_POST['Prenom'])==1)
		{
			/*echo "ok";*/
				if (preg_match("/[a-zA-Z]{2}/",$_POST['Nom'])==1)
				{
					/*echo "ok";*/
						if (preg_match("/[a-z]+@(([[:alnum:]]+[.])+)+[a-z]{2,3}/",$_POST['email'])==1)
						{
							/*echo "ok";*/
								if (preg_match("/([06]|[07])[0-9]{8}$/",$_POST['telephone'])==1)
								{
									/*echo "ok";*/
										if (preg_match("/^(?=.*[A-z])(?=.*[A-Z])(?=.*[0-9])/",$_POST['mp']))
										{
											/*echo "ok";*/
										
												if ($_POST['mp']==$_POST['cmp'])
												{
													if($pseudolength <= 255) {
														if($copolength ==5) {
															if(preg_match("/[^a-z]/",$copo)==1){
																if(preg_match("/[^A-Z]/",$copo)==1){
																	if(preg_match("/[^0-9]/",$pays)==1){

																		$datetime1 = new DateTime($naissance); 
																		$datetime2 = new DateTime(date("Y-m-d H:i:s"));   
																		$valideAge=verifage($datetime1,$datetime2);
																		if ($valideAge==true)
																		{
																			$insertmbr = $bdd->prepare("INSERT INTO membres(nom, prenom, mail, mdp, pseudo, pays, codepostal,naissance) VALUES(?, ?, ?, ?,?,?,?,?)");
																			$insertmbr->execute(array($nom,$prenom, $email, $mp,$pseudo,$pays,$copo,$naissance));
																			header('Location:  /mysocialnetwork/Connexion/Connexion.php');
																			
																		}else{
																			$erreur="Nous sommes désolé mais vous devez avoir 12 ans minimun";
																		}
                 
                  
                  
                     
              
																	}else {
																		$erreur="Le nom du pays ne peux pas contenir de chiffres";
																	}
																}else{
																	$erreur="Votre code postal ne ne doit contenir que des chiffres";
																}
															}else{
																$erreur="Votre code postal ne ne doit contenir que des chiffres";
															}
														}else{
															$erreur="Votre code postal doit être égale a 5 chiffres";
														}
                      
                      
													} else {
														$erreur = "Votre Nom D'utilisateur ne doit pas dépasser 255 caractères !";
													}
												
												}else{
													echo "<font color='red'>Mot de passe de confirmation non identique";
												}
										}
										else
										{
											echo "<font color='red'>Le mot de passe doit contenir au moins 7 caractère,dont une majuscule,une minuscule et un chiffre";
										}
								}
								else
								{
									echo "<font color='red'>Numéro de téléphone non conforme";
								}
						}
						else
						{
							echo "<font color='red'>Email non conforme";
						}
				}
				else
				{
					echo "<font color='red'>Nom non conforme";
				}
		}
		else
		{
			echo "<font color='red'>Prénom non conforme";
		}
	}
	else
	{
		echo "<font color='red'>Veuillez renseignez tout les champs";

	}
}

if (isset($_POST['dinscrp']))
{
	header("Location: /mysocialnetwork/Connexion/Connexion.php");
}
?>
