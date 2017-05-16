<?php
session_start();
require_once ('connectmysqli.php');


$message=htmlentities($_POST['message'],ENT_QUOTES);
$nextWeek = time() + (2 * 60 * 60);

if(empty($_SESSION )){
    $pseudo='Visiteur';
    $picture='../img/noimage.jpg';
}
else{

    $idS=$_SESSION['id_ut'];
    $requete= "SELECT * FROM utilisateur_connecter WHERE id_ut='$idS'";
    $result=mysqli_query($bdd,$requete);

    $donnees=mysqli_fetch_assoc($result);

    $pseudo=$_SESSION['pseudo'];
    $picture=$donnees['photo1'];
}



$requete= "INSERT INTO `forum`(`pseudo`, `message`, `date`, `picture`) VALUES ('$pseudo','$message','$nextWeek','$picture')";

if(mysqli_query($bdd,$requete)){
    header('Location: http://projet2501.esy.es/Projet/HTML/Forum.php');
}
else{
    echo ('Critical Error!!!!');
}

