
<?php
session_start();

if(isset($_SESSION['travel'])){
    require_once('../connectmysqli2.php');
    require_once('fonction.php');
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

<h1>Inscription</h1>
<form method="post"  action="sendtravelmysqli.php" enctype="multipart/form-data">
    <fieldset>

    <div class="form-group">
        <label>Titre:</label>
        <input type="text" class="form-control" id="title" name="title">
    </div>
    <div class="form-group">
        <label>Description:</label>
        <textarea name="description" class="form-control" ></textarea>
    </div>
    <div class="form-group">
        <label>Photo:</label>
        <input type="file" name="picture">
    </span>
    </div>
    <div class="form-group">
            <label>Date de depart:</label>
                <?php  DateCreate('start')?>
        </div>
    <div class="form-group">
            <label>Date de fin:</label>
            <?php  DateCreate('end')?>
        </div>
    <div class="form-group">
        <label>Prix:</label>
        <input type="text" name="price" maxlength="5" value="0" pattern="^[1-9][0-9]{0,4}$" class="form-control" >
    </div>
    <div class="form-group">
        <label>Nombre de voyageur:</label>
        <select name="listevoyage">
            <option value="10">10</option>
            <option value="15">15</option>
            <option value="20">20</option>

        </select>
    </div>
    <div class="form-group">
        <input type="checkbox" name="vaccine" value="1">Vaccin Obligatoire<br>
    </div>
    <div class="form-group">
        <input type="checkbox" name="minage" >Enfant de 14 ans minimum<br>
    </div>
    <div class="form-group">
        <input type="checkbox" name="animal" >Animaux interdit<br>
    </div>
    <div class="form-group">
        <input type="checkbox" name="insurance" >Assurance Obligatoire<br>
    </div>
    <div class="form-group">
        <input type="checkbox" name="license" >Permis de conduire obligatoire<br>
    </div>
    <div class=""form-group">
    <input type="submit" name="send" class="btn btn-primary">
    <input type="reset" class="btn btn-primary">
    </div>
    </fieldset>
</form>
</div>
<?php
if(isset($_POST['send']))
{
    //CONTROLE FICHIER
    if($_FILES['picture']['error'] !=0){
        switch($_FILES['picture']['error']){
            case 1:
                echo 'Le fichier est trop lourd';
                break;
            case 3:
                echo 'Le fichier a été chargé partiellement';
                break;
            /*case 4:
                echo 'Aucun fichier saisi';
                break;*/
            case 6:
                echo 'Pas de répertoire temporaire';
                break;
        }
        $nom='../img/noimage.jpg';
    }
    else{
        //str_replace supprime espace nom fichier
        $namenospace= str_replace(' ','',$_FILES['picture']['name']);

        //strlower nom du fichier en minus
        $namelower= strtolower($namenospace);

        //pathinfo recupere extension fichier
        $extension= pathinfo($namelower,PATHINFO_EXTENSION);

        //tableau avec extension valide
        $extensionOK= array('jpg','jpeg','gif','png');


        //in_array verifie existence extension dans nom fichier
        if(in_array($extension,$extensionOK)){
            $destination='../upload/';
            $nom=$destination.$namelower;
            //transfert fichier dans un repertoire
            move_uploaded_file($_FILES['picture']['tmp_name'],$nom);


            //creation de vignette
            if($extension == 'jpg' || $extension== 'jpeg'){
                CreateVignetteJpeg($nom,$namelower);
            }
            elseif($extension == 'gif'){
                CreateVignetteGif($nom,$namelower);
            }
            else{
                CreateVignettePng($nom,$namelower);
            }

        }
        else{
            echo'fichier non valide';
            exit();
        }
    }




    //FIN CONTROLE FICHIER
    $titre=htmlentities($_POST['title'],ENT_QUOTES);
    $description=htmlentities($_POST['description'],ENT_QUOTES);
    //test insertion photo
    // Test echo print_r($_FILES['picture']);
    //$nom='photo';
    $datestart= $_POST['startyear'].'-'.$_POST['startmonth'].'-'.$_POST['startday'];
    $dateend= $_POST['endyear'].'-'.$_POST['endmonth'].'-'.$_POST['endday'];
    $goodprice=$_POST['price'];
    $voyage=$_POST['listevoyage'];
    //vaccine
    if(isset($_POST['vaccine']))
    {
        $vaccine=1;
    }
    else{
        $vaccine=0;
    }
    //minage
    if(isset($_POST['minage']))
    {
        $minage=1;
    }
    else{
        $minage=0;
    }
    //animal
    if(isset($_POST['animal']))
    {
        $animal=1;
    }
    else{
        $animal=0;
    }
    //insurance
    if(isset($_POST['insurance']))
    {
        $insurance=1;
    }
    else{
        $insurance=0;
    }
    //license
    if(isset($_POST['license']))
    {
        $license=1;
    }
    else{
        $license=0;
    }




    if(!$bdd)
    {
        die("connection echoué: ".mysqli_connect_error());
    }

    $requete= "INSERT INTO travel (titre,description,photo1,prix,date_depart,date_fin,nb_voyageur,vaccin,age_mini,animaux,assurance,permis)VALUES ('$titre','$description','$nom','$goodprice','$datestart','$dateend',
    '$voyage','$vaccine','$minage','$animal','$insurance','$license')";

    if(mysqli_query($bdd,$requete))
    {
        echo 'insertion reussi';
    }
    else{
        echo 'Erreur: '.$requete.'<br>'.mysqli_error($bdd);
    }
}





?>

</body>
</html>