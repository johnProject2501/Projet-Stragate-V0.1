<?php



    require_once('connectmysqli2.php');

$requete="SELECT * FROM travel ORDER BY id DESC";

$result=mysqli_query($bdd,$requete);







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
    <nav class="navbar navbar-inverse">


        <div class="navbar-header">
            <a class="navbar-brand"href="#">VoyageLand</a>
        </div>
        <ul class="nav navbar-nav">
            <li ><a href="index.php">Accueil</a></li>
            <li><a href="ListTravelMysqli.php">Liste Voyages</a></li>
            <li><a href="#">Contacts</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="admin/index.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
        </ul>
    </nav>



    <div class="jumbotron">
        <h2>Liste Voyage</h2>
    </div>
    <form method="post"  action="ListTravelMysqli.php?tri=tri" enctype="multipart/form-data" class="form-inline">
        <fieldset>

            <div class="form-group">
                <label>Mot Clef:</label>
                <input type="text" class="form-control"  name="motclef">
            </div>
            <div class="form-group">
                <label>Prix Minimum:</label>
                <input type="text" class="form-control" value="0" name="prixmin">
            </div>
            <div class="form-group">
                <label>Prix Maximum:</label>
                <input type="text" class="form-control" value="9999" name="prixmax">
            </div>
            <br />
            <div class="form-group">
                <label>Vaccin Obligatoire:</label>
                <input type="checkbox" class="form-control"  name="vaccine">
            </div>
            <div class="form-group">
                <label>Enfant de 14 ans:</label>
                <input type="checkbox" class="form-control" name="minage">
            </div>
            <div class="form-group">
                <label>Animaux interdit:</label>
                <input type="checkbox" class="form-control"  name="animal">
            </div>
            <div class="form-group">
                <label>Assurance Obligatoire:</label>
                <input type="checkbox" class="form-control"  name="insurance">
            </div>
            <div class="form-group">
                <label>Permis de conduire obligatoire:</label>
                <input type="checkbox" class="form-control"  name="license">
            </div>
            <hr>
            <div class=""form-group">
            <input type="submit" name="send" class="btn btn-primary">
            <a href="ListTravelMysqli.php" class="btn btn-primary">Restart</a>
            </div>
        </fieldset>
    </form>
<hr>





    <?php

if(isset($_GET['tri']) AND $_GET['tri']=='tri'){


    if(isset($_POST['send'])){
        $motclef=$_POST['motclef'];
        $prixmax=$_POST['prixmax'];
        $prixmin=$_POST['prixmin'];


        if(empty($_POST['motclef']))
        {
            $rechercher=' ';

        }
        else{
            $rechercher='AND description LIKE "'.$motclef.'" ';
        }

        if(isset($_POST['vaccine']))
        {
            $vaccine='AND vaccin=1';
        }
        else{
            $vaccine=' ';
        }

        //minage
        if(isset($_POST['minage']))
        {
            $minage='AND age_mini=1';
        }
        else{
            $minage=' ';
        }


        //animal
        if(isset($_POST['animal']))
        {
            $animal='AND animaux=1';
        }
        else{
            $animal=' ';
        }

        //insurance
        if(isset($_POST['insurance']))
        {
            $insurance='AND assurance=1';
        }
        else{
            $insurance=' ';
        }

        //license
        if(isset($_POST['license']))
        {
            $license='AND permis=1';
        }
        else{
            $license=' ';
        }


        $requete="SELECT * FROM travel where prix > $prixmin AND prix < $prixmax $vaccine $minage $animal $insurance $license $rechercher ";

        $result=mysqli_query($bdd,$requete);

        if($result)
        {




            while($donnees= mysqli_fetch_assoc($result)){
                $image=str_replace('../upload','thumb',$donnees['photo1']);

                $image2=str_replace('../img/noimage.jpg','img/noimage.jpg',$donnees['photo1']);

            echo '<div class="col-sm-12 row content style="border-color:black">
                <div class="col-sm-3 sidenav" >';

            if ($donnees['photo1'] == '../img/noimage.jpg'){
                echo '<img style="margin: 50px" src='.$image2.'>';
            }
            else echo '<img style="margin: 50px" src='.$image.'> ';


            echo '</div>

       <div class="col-sm-9">';

            echo   '
         <div class="col-sm-6"><p>Titre du Voyage: '.$donnees['titre'].'</p></div><div class="col-sm-6"><p>Le prix est de: '.$donnees['prix'].'</p></div>
         <p>Presentation du Voyage: '.$donnees['description'].'</p>'.






                '</div>

             </div>';
        }

        }
        else{
            echo 'Erreur: '.$requete.'<br>'.mysqli_error($bdd);
        }

    }

}

else{


    while($donnees= mysqli_fetch_assoc($result)){

        $image=str_replace('../upload','thumb',$donnees['photo1']);

        $image2=str_replace('../img/noimage.jpg','img/noimage.jpg',$donnees['photo1']);

   echo '<div class="col-sm-12 row content style="border-color:black">
                <div class="col-sm-3 sidenav" >';

            if ($donnees['photo1'] == '../img/noimage.jpg'){
                echo '<img style="margin: 50px" src='.$image2.'>';
            }
            else echo '<img style="margin: 50px" src='.$image.'> ';


        echo '</div>

       <div class="col-sm-9">';

         echo   '
         <div class="col-sm-6"><p>Titre du Voyage: '.$donnees['titre'].'</p></div><div class="col-sm-6"><p>Le prix est de: '.$donnees['prix'].'</p></div>
         <p>Presentation du Voyage: '.$donnees['description'].'</p>'.






       '</div>

    </div>';
    }
}
?>

</div>





</body>
</html>
