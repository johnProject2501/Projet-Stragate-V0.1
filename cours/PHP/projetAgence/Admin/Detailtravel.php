
<?php
session_start();

if(isset($_SESSION['travel'])){
    require_once('../connectmysqli.php');
    require_once('fonction.php');
}
else{
    header('location:index.php');
}




?>

<?php
if(!empty($_GET['id'])&& is_numeric($_GET['id'])){
    $myid=$_GET['id'];


    $requete="SELECT * FROM travel WHERE id='$myid'";

    $result=mysqli_query($bdd,$requete);

    $donnees= mysqli_fetch_assoc($result);


}
else{
    header('location: ListeTravelMysqli.php');
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php $donnees['titre']?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
            /* Set height of the grid so .sidenav can be 100% (adjust if needed) */
        .row.content {height: 1500px}

            /* Set gray background color and 100% height */
        .sidenav {
            background-color: #f1f1f1;
            height: 100%;
        }

            /* Set black background color, white text and some padding */
        footer {
            background-color: #555;
            color: white;
            padding: 15px;
        }

            /* On small screens, set height to 'auto' for sidenav and grid */
        @media screen and (max-width: 767px) {
            .sidenav {
                height: auto;
                padding: 15px;
            }
            .row.content {height: auto;}
        }
    </style>
</head>
<body>


<div class="container-fluid">
    <ul class="nav nav-tabs">
        <li role="Index" class="active" ><a href="ListTravelMysqli.php" class="btn btn-primary"">Home</a></li>
        <li role="Index"><a href="sendtravelmysqli.php" class="btn btn-info">Ajouter un Voyage</a></li>
        <li role="Index"><a href="updatetitre.php" class="btn btn-info">Modifier Titre</a></li>
        <li role="Deconnexion" ><a href="Destroy.php" class="btn btn-danger"><span class="glyphicon glyphicon-off" aria-hidden="true">Deconnexion</span></a></li>
    </ul>


    <div class="row content">
        <div class="col-sm-3 sidenav">
            <?php
            $image=str_replace('upload','thumb',$donnees['photo1']);
            ?>
            <img src="../<?php echo $image ?>">
        </div>

        <div class="col-sm-9">
            <div class="col-sm-9" style="text-align: center">
                <h1 class="jumbotron">Titre: <?php
                echo $donnees['titre']
                ?></h1>
                <hr>
            </div>

            <div class="col-sm-9" style="text-align: ">
                <p>Description: <?php
                echo $donnees['description']
                ?></p>
                <hr>
            </div>
            <div class="col-sm-9" style="text-align: ">
                <p>Prix: <?php echo $donnees['prix']?>€</p>
                <hr>
            </div>


            <div class="col-sm-9" style="text-align: ">
                <p>Date de Départ: <?php
                    $requeteHeure = "SELECT date_depart FROM travel";
                    $result = mysqli_query($bdd, $requeteHeure);
                    $row = mysqli_fetch_row($result);
                    $date = date_create($row[0]);
                    echo date_format($date, 'd/m/y');
                    ?></p>
                <hr>
            </div>

            <div class="col-sm-9" style="text-align: ">
                <p>Date d'arriver: <?php
                    $requeteHeure = "SELECT date_fin FROM travel";
                    $result = mysqli_query($bdd, $requeteHeure);
                    $row = mysqli_fetch_row($result);
                    $date = date_create($row[0]);
                    echo date_format($date, 'd/m/y');
                    ?>
                    </p>
                <hr>
            </div>



            <div class="col-sm-9" style="text-align: ">
                <p>Nombre de Voyageur: <?php
                    echo $donnees['nb_voyageur']
                    ?></p>
                <hr>
            </div>

            <div class="col-sm-9" style="text-align: ">
                <p>
                    <?php
                    if($donnees['vaccin'] == 1)
                    {
                        echo 'Vaccin requis';
                    }
                    else
                    {
                        echo 'Vaccin non requis';
                    }
                    ?>
                <hr>
            </div>
            <div class="col-sm-9" style="text-align: ">
                <p>
                    <?php
                    if($donnees['age_mini'] == 1)
                    {
                        echo 'Enfant de 14 ans minimum ';
                    }
                    else
                    {
                        echo 'Aucun age minimum requis';
                    }
                    ?>
                <hr>
            </div>
            <div class="col-sm-9" style="text-align: ">
                <p>
                    <?php
                    if($donnees['animaux'] == 1)
                    {
                        echo 'Animaux interdit';
                    }
                    else
                    {
                        echo 'Animaux autoriser';
                    }
                    ?>
                <hr>
            </div>
            <div class="col-sm-9" style="text-align: ">
                <p>
                    <?php
                    if($donnees['assurance'] == 1)
                    {
                        echo 'Assurance obligatoire';
                    }
                    else
                    {
                        echo 'Assurance non obligatoire';
                    }
                    ?>
                <hr>
            </div>
            <div class="col-sm-9" style="text-align: ">
                <p>
                    <?php
                    if($donnees['permis'] == 1)
                    {
                        echo 'Permis obligatoire';
                    }
                    else
                    {
                        echo 'Permis non requis';
                    }
                    ?>
                <hr>
            </div>


        </div>
    </div>
</div>



</body>
</html>
