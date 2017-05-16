<?php session_start();
$servername= 'mysql.hostinger.fr';
$username= 'u713664171_john';
$password='XHHq2NOGfEscW27chN';
$dbname= 'u713664171_pro';


//creation connection

$bdd=mysqli_connect($servername,$username,$password,$dbname);
$myid=$_SESSION['id_ut'];
$requete="SELECT * FROM utilisateur_connecter WHERE id_ut='$myid'";

$result=mysqli_query($bdd,$requete);

$donnees= mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <title>Mon Compte <?php echo $donnees["pseudo"];?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../../CSS/CssStargate.css">
    <link rel="stylesheet" type="text/css" href="../../CSS/CssMobile.css">
    <link rel="stylesheet" type="text/css" href="../../CSS/MonCompte.css">


    <meta charset= 'utf-8'/>


</head>
<body>

<div id="Site">
        <h1><img  src="../../CSS/photo/Banniere-Stargate.png" alt="logo" style="width: 100%;height: auto;"></h1>

    <?php
    if(isset($donnees['pseudo'])){
        ?>
        <?php include('../portion/menuco.php') ?>
    <?php
    }else{
        ?>
        <?php include('../portion/menudeco.html') ?>
    <?php
    }
    ?>


    <div class="siteSG1 ">

        <div class="container-fluid well span6 ">
            <div class="row-fluid">
            <div style="text-align: center"><h4>Détail du compte<hr style="background: transparent url(../img/hr.png) no-repeat; width: 350px; height: 10px; border: none;"></h4></div>
                <div class="col-sm-2">
                    <img src="<?php echo $donnees["photo1"]?>" style="max-width: 10em ;height: auto; ">
                </div>

                <div class="col-sm-8" style="text-align: center">
                    <h5>Pseudo:<?php echo $donnees["pseudo"]?></h5>
                    <h6>Nom: <?php echo $donnees["nom"]?></br></h6>
                    <h6>Prenom:  <?php echo $donnees["prenom"]?></h6>
                    <h6>Email: <?php echo $donnees["email"]?></h6>
                    <h6>Tel: <?php echo $donnees["numero_de_telephone"]?></h6>
                    <h6>Année de naissance: <?php

                        $requeteHeure = "SELECT age FROM utilisateur_connecter WHERE id_ut='$myid'";
                        $result = mysqli_query($bdd, $requeteHeure);
                        $row = mysqli_fetch_row($result);
                        $date = date_create($row[0]);
                        echo date_format($date, 'd/m/Y');
                        ?>

                        </h6>

                </div>

                <div class="col-sm-2">
                    <div class="btn-group">
                        <a class="btn dropdown-toggle btn-info" data-toggle="dropdown" href="#">
                            Option
                            <span class="icon-cog icon-white"></span><span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="Update.php"><span class="icon-wrench"></span> Modifier le Compte</a></li>
                            <li><a href="Suppresion.php"><span class="icon-trash"></span> Supprimer le Compte</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



</body>
</html>