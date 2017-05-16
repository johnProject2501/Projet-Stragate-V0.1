<?php
session_start();

if(isset($_SESSION['travel'])){
    require_once('../connectmysqli2.php');
}
else{
    header('location:index.php');
}




?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title></title>
</head>
<body>
<div class="container-fluid">
    <ul class="nav nav-tabs">
        <li role="Index" class="active" ><a href="ListTravelMysqli.php" class="btn btn-primary"">Home</a></li>
        <li role="Index"><a href="sendtravelmysqli.php" class="btn btn-info">Ajouter un Voyage</a></li>
        <li role="Index"><a href="updatetitre.php" class="btn btn-info">Modifier Titre</a></li>
        <li role="Deconnexion" ><a href="Destroy.php" class="btn btn-danger"><span class="glyphicon glyphicon-off" aria-hidden="true">Deconnexion</span></a></li>
    </ul>

    <table class="table" >
        <caption>Liste des Voyages</caption>
        <TR>
            <TH> Titre </TH>
            <TH> Date de Départ </TH>
            <TH> Date de Fin </TH>
            <TH> Prix </TH>
            <TH> Detail </TH>
            <TH> Supprimer </TH>
            <TH> Mise à Jour </TH>
        </TR>
        <?php

        //creation de la requete
        $requete="SELECT*FROM travel ORDER BY id DESC";

        //execution de la requete
        $result=mysqli_query($bdd,$requete);

        //construction des ligne en boucle
        while($donnees= mysqli_fetch_assoc($result)){
            echo'<tr>
                <td>'.$donnees['titre'].'</td>
                <td>'.$donnees['date_depart'].'</td>
                <td>'.$donnees['date_fin'].'</td>
                <td>'.$donnees['prix'].'</td>
                <td><a href="Detailtravel.php?id='.$donnees['id'].'" class="btn btn-primary">Detail</a></td>
                <td><a href="DeleteMysqli.php?id='.$donnees['id'].'" class="btn btn-danger">Supprimer</a></td>
                <td><a href="UpdateTravelMysqli.php?id='.$donnees['id'].'" class="btn btn-warning">Mettre à jour </a></td>
            </tr>';
        }

        ?>
    </table>
</div>
</body>
</html>
