<?php
session_start();
require_once('../../portion/connectmysqli.php');


if(!empty($_GET['msg'])&& is_numeric($_GET['msg'])){


    $myid=$_GET['msg'];




    //SUPRESSION LIGNE
    $requete="DELETE FROM forum WHERE  ID_f='$myid'";
    mysqli_query($bdd,$requete);
    mysqli_close($bdd);

    header('location:http://projet2501.esy.es/Projet/HTML/Forum.php');







}

else{
    header('location:http://projet2501.esy.es/Projet/HTML/index.php');
}