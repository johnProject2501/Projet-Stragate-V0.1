
<?php
session_start();
	
						// On commence par récupérer les champs 
						if(isset($_POST['Pseudo']))      $pseudo=$_POST['Pseudo'];
						else      $pseudo="";


						if(isset($_POST['startyear']) )     $age=$_POST['startyear'].'-'.$_POST['startmonth'].'-'.$_POST['startday'];
						else      $age="";

						if(isset($_POST['Numero_de_telephone']))      {
							
							$Numero_de_telephone=$_POST['Numero_de_telephone'];
						}
						else      $Numero_de_telephone="";

						if(isset($_POST['email']))      $email=$_POST['email'];
						else      $email="";
						
						if(isset($_POST['pass']))      $pass=sha1($_POST['pass']);
						else      $pass="";
						
						if(isset($_POST['Nom']))      $nom=$_POST['Nom'];
						else      $nom="";
			
						if(isset($_POST['Prenom']))      $prenom=$_POST['Prenom'];
						else      $prenom="";
	
						
	
						

						
							try
							{
								// On se connecte à MySQL
								$bdd = new PDO('mysql:host=mysql.hostinger.fr;dbname=u713664171_pro;charset=utf8','u713664171_john','XHHq2NOGfEscW27chN');
								
							}
							catch(Exception $e)
							{
								// En cas d'erreur, on affiche un message et on arrête tout
									die('Erreur : '.$e->getMessage());
							}
						// sélection de la base  

							//mysql_select_db('projet', $bdd)  or die('Erreur de selection '.mysql_error()); 

							$req = $bdd->prepare('INSERT INTO utilisateur_connecter( age, numero_de_telephone, email, pseudo, password, nom, prenom) VALUES( :age, :numero_de_telephone, :email, :pseudo, :password, :nom, :prenom)');
							/*$tabP = array(':age' => $age,
								':numero_de_telephone' => $Numero_de_telephone,
								':email' => $email,
								':pseudo' => $Pseudo,
								':password' => $pass,
								':nom' => $nom,
								':prenom'=> $prenom	);
							var_dump($tabP);*/
							if ($req->execute(array(':age' => $age,
								':numero_de_telephone' => $Numero_de_telephone,
								':email' => $email,
								':pseudo' => $pseudo,
								':password' => $pass,
								':nom' => $nom,
								':prenom'=> $prenom	))) {
								echo 'compte crée'; 
								$_SESSION['password'] = $pass;
                                $_SESSION["pseudo"] = $pseudo;
								header('Location: http://projet2501.esy.es/Projet/HTML/succes.php');
							} else {
								echo 'Erreur' . $req->errorInfo()[2]; 								
							}

                            //email:

$mail = $email; // Déclaration de l'adresse de destination.
if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)) // On filtre les serveurs qui rencontrent des bogues.
{
    $passage_ligne = "\r\n";
}
else
{
    $passage_ligne = "\n";
}
//=====Déclaration des messages au format texte et au format HTML.
$message_txt = "Bonjour ".$pseudo." ,votre inscription sur Projet2501.esy.es est confirmer";
$message_html = '<html><head></head><body>Bonjour, '. $pseudo .' votre inscription sur Projet2501.esy.es est confirmer.</body></html>';

//==========

//=====Création de la boundary
$boundary = "-----=".md5(rand());
//==========

//=====Définition du sujet.
$sujet = "Inscription sur Projet2501.easy.es";
//=========

//=====Création du header de l'e-mail.
$header = "From: \"Projet Stargate\"<projetstargate@projet2501.esy.es>".$passage_ligne;
$header.= "Reply-to: \"Projet Stargate\" <projetstargate@projet2501.esy.es>".$passage_ligne;
$header.= "MIME-Version: 1.0".$passage_ligne;
$header.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
//==========

//=====Création du message.
$message = $passage_ligne."--".$boundary.$passage_ligne;
//=====Ajout du message au format texte.
$message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;
$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
$message.= $passage_ligne.$message_txt.$passage_ligne;
//==========
$message.= $passage_ligne."--".$boundary.$passage_ligne;
//=====Ajout du message au format HTML
$message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;
$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
$message.= $passage_ligne.$message_html.$passage_ligne;
//==========
$message.= $passage_ligne."--".$boundary."--".$passage_ligne;
$message.= $passage_ligne."--".$boundary."--".$passage_ligne;
//==========

//=====Envoi de l'e-mail.
mail($mail,$sujet,$message,$header);
//==========

							  
						?>

