<!DOCTYPE HTML>
<html>
	<head>
		<title>Connexion</title>

		<link rel="stylesheet" type="text/css" href="../CSS/CssStargate.css">
		<link rel="stylesheet" type="text/css" href="../CSS/CssInscription.css">
		<link rel="stylesheet" type="text/css" href="../CSS/CssMobile.css">
		<link rel="stylesheet" type="text/css" href="../CSS/CssMenu.css">
		<link rel="stylesheet" href="../CSS/font/css/font-awesome.min.css">
		<meta charset= 'utf-8'/>
	</head>
	<body>
		<div id="Site">
			<h1><img src="../CSS/photo/logo-stargate.jpg" alt="logo"></h1>
			<?php include('portion/menudeco.html') ?>
			
			<?php 
// Hachage du mot de passe
$pass_hache = sha1($_POST['password']);
			//echo $pass_hache;
$pseudo = $_POST['login'];
$bdd = new PDO('mysql:host=mysql.hostinger.fr;dbname=u713664171_pro;charset=utf8','u713664171_john','XHHq2NOGfEscW27chN');
// Vérification des identifiants
$req = $bdd->prepare('SELECT * FROM utilisateur_connecter WHERE pseudo = :pseudo AND password = :password');
if (!$req->execute(array(
    ':pseudo' => $pseudo,
    ':password' => $pass_hache))) {
echo "Erreur sql : " . $req->errorInfo()[2];
}

$resultat = $req->fetch();

if (!$resultat)
{
    echo 'Mauvais identifiant ou mot de passe !';
}
else
{
    session_start();
    $_SESSION['id_ut'] = $resultat['id_ut'];
    $_SESSION['pseudo'] = $pseudo;
    $_SESSION['nom']= $resultat['nom'];
    $_SESSION['prenom']= $resultat['prenom'];
    $_SESSION['age']= $resultat['age'];
    $_SESSION['numero_de_telephone']= $resultat['numero_de_telephone'];
    $_SESSION['email']= $resultat['email'];
    $_SESSION['photo1']=$resultat['photo1'];
    $_SESSION['status']=$resultat['status'];


    echo 'Vous êtes connecté !';
	
	
}
	
	?>
	<?php include('portion/utilisateur.php') ?>
	<?php  header('Location: http://projet2501.esy.es/Projet/HTML/index.php'); ?>
		</div>

</body>
</html>
