<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Document sans nom</title>
</head>

<body>
<?php 
// Hachage du mot de passe
$pass_hache = sha1($_POST['pass']);
$bdd = new PDO('mysql:host=mysql.hostinger.fr;dbname=u713664171_pro;charset=utf8','u713664171_john','XHHq2NOGfEscW27chN');
// Vérification des identifiants
$req = $bdd->prepare('SELECT id FROM utilisateur_connecter WHERE pseudo = :pseudo AND password = :password');
$req->execute(array(
    'pseudo' => $pseudo,
    'password' => $pass_hache));

$resultat = $req->fetch();

if (!$resultat)
{
    echo 'Mauvais identifiant ou mot de passe !';
}
else
{
    session_start();
    $_SESSION['id'] = $resultat['id'];
    $_SESSION['pseudo'] = $pseudo;
    echo 'Vous êtes connecté !';
}
	
	?>
	
	
	<?php 
if (isset($_SESSION['id']) AND isset($_SESSION['pseudo']))
{
    echo 'Bonjour ' . $_SESSION['pseudo'];
}
	
	?>


</body>
</html>
