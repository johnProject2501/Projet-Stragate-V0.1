<?php session_start();
      require_once('fonction.php');


if(!empty($_SESSION['id_ut'])&& is_numeric($_SESSION['id_ut'])){
    $myid=$_SESSION['id_ut'];

    $servername= 'mysql.hostinger.fr';
    $username= 'u713664171_john';
    $password='XHHq2NOGfEscW27chN';
    $dbname= 'u713664171_pro';


//creation connection

    $bdd=mysqli_connect($servername,$username,$password,$dbname);

    $requete="SELECT * FROM utilisateur_connecter WHERE id_ut='$myid'";

    $result=mysqli_query($bdd,$requete);

    $donnees= mysqli_fetch_assoc($result);
}
else{
    header('location: http://projet2501.esy.es/Projet/HTML/');
}






?>

<?php
if(isset($_POST['send']))
{

//CONTROLE FICHIER
    $pseudo=htmlentities($_POST['Pseudo'],ENT_QUOTES);
    $Nom=htmlentities($_POST['nom'],ENT_QUOTES);
    $prenom=$_POST['Prenom'];
    $email=$_POST['email'];
    $tel=$_POST['tel'];
    $age=$_POST['startyear'].'-'.$_POST['startmonth'].'-'.$_POST['startday'];





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






    $requete= "UPDATE utilisateur_connecter SET pseudo='$pseudo',nom='$Nom',photo1='$updateimage',prenom='$prenom',email='$email',numero_de_telephone='$tel',age='$age'WHERE id_ut='$myid'";

    if(mysqli_query($bdd,$requete))
    {
        echo 'insertion reussi';
        header('Location:http://projet2501.esy.es/Projet/HTML/ModifProfil/Moncompte.php');
    }
    else{
        echo 'Erreur: '.$requete.'<br>'.mysqli_error($bdd);
    }
}







?>


<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../../CSS/CssStargate.css">
    <link rel="stylesheet" type="text/css" href="../../CSS/CssMobile.css">
    <link rel="stylesheet" type="text/css" href="../../CSS/MonCompte.css">
    <meta charset= 'utf-8'/>
    <title>Update Profil</title>
</head>


<body>
<div id="Site">
    <h1><img  src="../../CSS/photo/Banniere-Stargate.png" alt="logo" style="width: 100%;height: auto;"></h1>

        <?php
        if(isset($_SESSION['pseudo'])){
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
                <div style="text-align: center"><h4>Modification du compte<hr style="background: transparent url(../img/hr.png) no-repeat; width: 350px; height: 10px; border: none;"></h4></div>
                <form method="post" class="form-horizontal" action="" enctype="multipart/form-data">

                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Photo:</label>
                        <img src="<?php echo $donnees["photo1"]?>"  style="max-width: 10em ;height: auto; ">

                        <input type="file" name="picture" >

                    </div>

                    <div class="form-group">
                        <?php if($donnees['photo1'] != '../img/noimage.jpg'){
                            echo '<label>Supprimer Image</label>
                            <input type="checkbox" name="deleteimg">';
                        }

                        ?>

                    </div>
                </div>


                    <div class="col-sm-8" style="text-align: center">
                        <div class="form-group">
                            <label class="control-label col-sm-6" >Pseudo:</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="Pseudo" id="pseudo" value="<?php echo $donnees["pseudo"]?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-6" >Nom:</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="nom" id="nom" value="<?php echo $donnees["nom"]?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-6" >prenom:</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="Prenom" id="prenom" value="<?php echo $donnees["prenom"]?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-6" >Email:</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="email" id="email" value="<?php echo $donnees["email"]?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-6" >Telephone:</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="tel" id="tel" value="<?php echo $donnees["numero_de_telephone"]?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-6" >Année de Naissance:</label>
                            <div class="col-sm-6">
                                <?php
                                //fonction explode() creer un tableau numeric
                                $dateexplode= explode('-',$donnees['age']);

                                //liste deroulante update jour
                                echo '<select name="startday">';
                                for ($i=1; $i <= 31; $i++) {
                                    if ($dateexplode[2] == sprintf('%02d',$i)) {
                                        echo '<option value="' .sprintf('%02d',$i). '"selected>' .sprintf('%02d',$i) . '</option>'. PHP_EOL;
                                    }
                                    else{
                                        echo '<option value="' .sprintf('%02d',$i). '">' .sprintf('%02d',$i) . '</option>'. PHP_EOL;
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
                                for($i= $year ; $i>=($year-70);$i--){
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
                        </div>

                            <input type="submit" name="send" class="btn btn-primary">

                    </div>

                </form>

                <div class="col-sm-2">
                    <div class="btn-group">
                        <a class="btn dropdown-toggle btn-info" data-toggle="dropdown" href="#">
                            Option
                            <span class="icon-cog icon-white"></span><span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
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