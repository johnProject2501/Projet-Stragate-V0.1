<?php

$pseudo=$_POST['Pseudo'];

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

$req = $bdd->prepare('SELECT * FROM  utilisateur_connecter WHERE pseudo= :pseudo');
if ($req->execute(array(':pseudo' => $pseudo,))) {
    if ($req->fetch()) {
        //doublon

        echo 'true';
    }
    else{
        echo 'false';
    }
}

?>