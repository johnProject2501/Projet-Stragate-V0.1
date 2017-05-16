
<?php
session_start();

if(isset($_SESSION['travel'])){
    require_once('../connectmysqli2.php');
    require_once('fonction.php');
}
else{
    header('location:../index.php');
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

<?php
if(isset($_POST['send']))
{

    //CONTROLE FICHIER
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


    //CAS PAS INSERTION IMG
    $image=str_replace('upload','thumb',$donnees['photo1']);
    if($_FILES['picture']['error'] ==4 && $_POST['deleteimg']!='on'){
        $updateimage=$image;
    }
    elseif($_FILES['picture']['error'] !=4 && $_FILES['picture']['error'] !=0){
        //CONTROLE FICHIER
        switch($_FILES['picture']['error']){
                case 1:
                    echo 'Le fichier est trop lourd';
                    break;
                case 3:
                    echo 'Le fichier a été chargé partiellement';
                    break;
                case 6:
                    echo 'Pas de répertoire temporaire';
                    break;
            }

        }
    elseif($_FILES['picture']['error'] ==0){
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
            $updateimage=$destination.$namelower;
            //transfert fichier dans un repertoire
            move_uploaded_file($_FILES['picture']['tmp_name'],$updateimage);


            //creation de vignette
            if($extension == 'jpg' || $extension== 'jpeg'){
               CreateVignetteJpeg($updateimage,$namelower);
            }
            elseif($extension == 'gif'){
                CreateVignetteGif($updateimage,$namelower);
            }
            else{
                CreateVignettePng($updateimage,$namelower);
            }

        }
        else{
            echo'fichier non valide';
            exit();
        }
    }

    elseif($_POST['deleteimg']=='on'&& $image != '../thumb/noimage.jpg'){
     unlink($donnees['photo1']);
     unlink($image);
     $updateimage='../img/noimage.jpg';
}






    $requete= "UPDATE travel SET titre='$titre' ,description='$description' ,photo1='$updateimage',prix='$goodprice',date_depart='$datestart',
    date_fin='$dateend',nb_voyageur='$voyage',vaccin='$vaccine',age_mini='$minage',animaux='$animal',assurance='$insurance',permis='$license' WHERE id='$myid'";

    if(mysqli_query($bdd,$requete))
    {
        echo 'insertion reussi';
        header('Location:ListTravelMysqli.php');
    }
    else{
        echo 'Erreur: '.$requete.'<br>'.mysqli_error($bdd);
    }
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

    <h1>Update</h1>

    <form method="post"  action="" enctype="multipart/form-data">
    <fieldset>

    <div class="form-group">
        <label>Titre:</label>
        <input type="text" class="form-control" id="title" name="title" value="<?php echo $donnees['titre'] ?>">
    </div>
    <div class="form-group">
        <label>Description:</label>
        <textarea name="description" class="form-control"><?php echo $donnees['description'] ?></textarea>
    </div>
    <div class="form-group">

        <label>Photo:</label>
        <?php

        $image=str_replace('upload','thumb',$donnees['photo1']);
        ?>
        <img src="<?php echo $image ?>">



        <input type="file" name="picture" >
        </span>
    </div>
    <div class="form-group">
        <?php if($donnees['photo1'] != '../img/noimage.jpg'){
            echo '<label>Supprimer Image</label>
                 <input type="checkbox" name="deleteimg">';
        }

        ?>

    </div>
    <div class="form-group">
        <label>Date de depart:</label>
        <?php
        //fonction explode() creer un tableau numeric
        $dateexplode= explode('-',$donnees['date_depart']);

        //liste deroulante update jour
        echo '<select name="startday">';
        for ($i=1; $i <= 31; $i++) {
            if ($dateexplode[2] == sprintf('%02d',$i)) {
                echo '<option value="' .sprintf('%02d',$i). '"selected>' .sprintf('%02d',$i) . '</option>'. PHP_EOL;
            }
            else{
                echo '<option value="' .sprintf('%02d',$i). '">' .sprintf('%02d',$i) . '</option>'. PHP_EOL;;
            }
        }
        echo '</select>';


        //liste deroulante update Mois


        $tabmoi = array('01' => 'Janvier','02' => 'Février','03' => 'Mars','04' => 'Avril', '05' => 'Mai','06' => 'Juin','07' => 'Juillet',
            '08' => 'Aout','09' => 'Septembre','10' => 'Octobre','11' => 'Novembre','12' => 'Décembre');

        echo '<select name="startmonth">';

        foreach($tabmoi as $cle=>$val){
            if($cle==$dateexplode[1]){
                echo'<option value="'.$cle.'"selected>'.$val.'</option>'.PHP_EOL;

            }
            else{
                echo'<option value="'.$cle.'">'.$val.'</option>'.PHP_EOL;
            }
        }

        echo '</select>';


        //liste deroulante update An
        echo '<select name="startyear">';
        $year= date('Y');
        for($i= $year ; $i<=($year+10);$i++){
            if ($dateexplode[0] == sprintf('%02d',$i)) {
                echo '<option value="' .sprintf('%02d',$i). '"selected>' .sprintf('%02d',$i) . '</option>'. PHP_EOL;
            }

            else{

                echo '<option value="'.$i.'">'.$i .'</option>';
            }
        }

        echo '</select>';



        ?>

    </div>
    <div class="form-group">
        <label>Date de fin:</label>
        <?php
        //fonction explode() creer un tableau numeric
        $dateexplode= explode('-',$donnees['date_fin']);

        //liste deroulante update jour
        echo '<select name="endday">';
        for ($i=1; $i <= 31; $i++) {
            if ($dateexplode[2] == sprintf('%02d',$i)) {
                echo '<option value="' .sprintf('%02d',$i). '"selected>' .sprintf('%02d',$i) . '</option>'. PHP_EOL;
            }
            else{
                echo '<option value="' .sprintf('%02d',$i). '">' .sprintf('%02d',$i) . '</option>'. PHP_EOL;;
            }
        }
        echo '</select>';


        //liste deroulante update Mois
        $tabmoi = array('01' => 'Janvier','02' => 'Février','03' => 'Mars','04' => 'Avril', '05' => 'Mai','06' => 'Juin','07' => 'Juillet',
            '08' => 'Aout','09' => 'Septembre','10' => 'Octobre','11' => 'Novembre','12' => 'Décembre');

        echo '<select name="endmonth">';

        foreach($tabmoi as $cle=>$val){
            if($cle==$dateexplode[1]){
                echo'<option value="'.$cle.'"selected>'.$val.'</option>'.PHP_EOL;

            }
            else{
                echo'<option value="'.$cle.'">'.$val.'</option>'.PHP_EOL;
            }
        }

        echo '</select>';



        //liste deroulante update An
        echo '<select name="endyear">';
        $year= date('Y');
        for($i= $year ; $i<=($year+10);$i++){
            if ($dateexplode[0] == sprintf('%02d',$i)) {
                echo '<option value="' .sprintf('%02d',$i). '"selected>' .sprintf('%02d',$i) . '</option>'. PHP_EOL;
            }

            else{

                echo '<option value="'.$i.'">'.$i .'</option>';
            }
        }

        echo '</select>';



        ?>
        </div>
        <div class="form-group">
            <label>Prix:</label>
            <input type="text" name="price" maxlength="5" value="<?php echo $donnees['prix']?>" pattern="^[1-9][0-9]{0,4}$" class="form-control" ]>
        </div>
        <div class="form-group">
            <label>Nombre de voyageur:</label>
            <?php
            echo '<select name="listevoyage">';
            for($i=10; $i <=30; $i+=5)
            {
                if($donnees['nb_voyageur'] == $i)
                {
                    echo '<option value="' . $i . '" selected>' . $i . '</option>' . PHP_EOL;
                }
                else
                {
                    echo '<option value="' . $i . '">' . $i . '</option>' . PHP_EOL;
                }
            }
            echo '</select>';
            ?>

        </div>
        <div class="form-group">
            <label>Vaccin obligatoire : </label>
            <?php
            if($donnees['vaccin'] == 1)
            {
                echo '<input type="checkbox" name="vaccine" checked>';
            }
            else
            {
                echo '<input type="checkbox" name="vaccine">';
            }
            ?>
        </div>
        <div class="form-group">
            <label>Enfant de 14 ans minimum : </label>
            <?php
            if($donnees['age_mini'] == 1)
            {
                echo '<input type="checkbox" name="minage" checked>';
            }
            else
            {
                echo '<input type="checkbox" name="minage">';
            }
            ?>

        </div>
        <div class="form-group">
            <label>Animaux interdits : </label>
            <?php
            if($donnees['animaux'] == 1)
            {
                echo '<input type="checkbox" name="animal" checked>';
            }
            else
            {
                echo '<input type="checkbox" name="animal">';
            }
            ?>
        </div>
        <div class="form-group">
            <label>Assurance obligatoire : </label>
            <?php
            if($donnees['assurance'] == 1)
            {
                echo '<input type="checkbox" name="insurance" checked>';
            }
            else
            {
                echo '<input type="checkbox" name="insurance">';
            }
            ?>
        </div>
        <div class="form-group">
            <label>Permis de conduire obligatoire : </label>
            <?php
            if($donnees['permis'] == 1)
            {
                echo '<input type="checkbox" name="license" checked>';
            }
            else
            {
                echo '<input type="checkbox" name="license">';
            }
            ?>
        </div>
    <div class=""form-group">
    <input type="submit" name="send" class="btn btn-primary">

    </div>
    </fieldset>
    </form>
</div>
</body>
</html>

