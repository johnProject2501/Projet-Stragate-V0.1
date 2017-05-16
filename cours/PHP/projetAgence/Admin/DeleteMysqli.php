<?php
require_once('../connectmysqli2.php');


if(!empty($_GET['id'])&& is_numeric($_GET['id'])){


    $myid=$_GET['id'];

    //Supression de fichier
    $requete="SELECT photo1 FROM travel WHERE id='$myid'";

    $result=mysqli_query($bdd,$requete);
    $donnees=mysqli_fetch_assoc($result);
    //RECUPERATION CHEMIN DU FICHIER
    $photo=$donnees['photo1'];
    //CHANGEMENT CHEMIN DU FICHIER POUR LES VIGNETTES
    $vignette=str_replace('upload','thumb',$donnees['photo1']);

    // DESTRUCTION DE FICHIER

    if($photo !='../img/noimage.jpg'){
    unlink($photo);
    unlink($vignette);
    }

    //SUPRESSION LIGNE
    $requete="DELETE FROM travel WHERE  id='$myid'";
    mysqli_query($bdd,$requete);
    mysqli_close($bdd);

   header('location:ListTravelMysqli.php');







}
















?>