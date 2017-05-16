<?php
session_start();

$bdd = new PDO('mysql:host=mysql.hostinger.fr;dbname=u713664171_pro;charset=utf8','u713664171_john','XHHq2NOGfEscW27chN');





    $myid=$_SESSION['id_ut'];

    echo "<p>".$myid."</p>";


    //SUPRESSION LIGNE



if ( isset($myid) ) {
    $req = $bdd->exec('DELETE FROM utilisateur_connecter WHERE id_ut ='.$myid);



    if ( !$req ) {
        echo 'Erreur de suppression';
    } else {
        echo 'Entrée '.$myid.' supprimée';
    }
}



   session_destroy();

   header('location:../index.php');
