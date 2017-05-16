<?php
require_once('connectmysqli2.php');


$requete="SELECT * FROM travel ORDER BY id DESC LIMIT 3";

$result=mysqli_query($bdd,$requete);







?>


<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

    <div class="container-fluid">
            <nav class="navbar navbar-inverse">


                    <div class="navbar-header">
                        <a class="navbar-brand" href="#">VoyageLand</a>
                    </div>
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="index.php">Accueil</a></li>
                        <li><a href="ListTravelMysqli.php">Liste Voyages</a></li>
                        <li><a href="admin/Contact.php">Contacts</a></li>
                    </ul>
                <ul class="nav navbar-nav navbar-right">
                   <li><a href="admin/index.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                </ul>


            </nav>

        <div class="jumbotron"> <?php
            $requete="SELECT * FROM message ORDER BY id DESC LIMIT 1";


            $result=mysqli_query($bdd,$requete);

            while($donnees= mysqli_fetch_assoc($result)){

                echo '<h1>'.$donnees['message'].'</h1>';
            }
            ?></div>

            <div class="col-md-6">
                <a href="index.php?tri=prix">Tri prix decroissant</a>
            </div>
        <div class="col-md-6">
            <a href="index.php?tri=prixasc">Tri prix decroissant</a>
        </div>

                <ul class="row" style="list-style:none">
                    <?php
                    if(isset($_GET['tri']) AND $_GET['tri']=='prix'){
                        $requete='SELECT * FROM travel ORDER BY prix DESC LIMIT 3';
                    }
                    elseif(isset($_GET['tri']) AND $_GET['tri']=='prixasc'){
                        $requete='SELECT * FROM travel ORDER BY prix ASC LIMIT 3';
                    }
                    else{
                        $requete="SELECT * FROM travel ORDER BY id DESC LIMIT 3";
                    }


                    $result=mysqli_query($bdd,$requete);

                    while($donnees= mysqli_fetch_assoc($result)){


                            $image=str_replace('../upload','thumb',$donnees['photo1']);

                            $image2=str_replace('../img/noimage.jpg','img/noimage.jpg',$donnees['photo1']);

                        $str= '<li class="col-lg-2 col-md-2 col-sm-3 col-xs-4">
                            <h4> '.$donnees['titre'].'</h4>';
                            if ($donnees['photo1'] == '../img/noimage.jpg'){
                                $str.= '<img src='.$image2.'>';
                            }
                            else $str.= '<img src='.$image.'>';



                        $str.= '<div class=" col-md-6"><p> '.$donnees['prix'].'€</p></div>
                            <div class="col-md-6"><a href="Detailtravel.php?id='.$donnees['id'].'" class="btn btn-primary">Detail</a></div>

                    </li>';
                        echo $str;
                    }
                   ?>
                </ul>








            </div>


</body>
</html>

