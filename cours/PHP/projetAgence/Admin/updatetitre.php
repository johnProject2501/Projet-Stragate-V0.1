<?php
require_once('../connectmysqli2.php');

$requete="SELECT * FROM message";

$result=mysqli_query($bdd,$requete);

$donnees= mysqli_fetch_assoc($result);
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



            <ul class="nav nav-tabs">
                <li role="Index" class="active" ><a href="ListTravelMysqli.php" class="btn btn-primary"">Home</a></li>
                <li role="Index"><a href="sendtravelmysqli.php" class="btn btn-info">Ajouter un Voyage</a></li>
                <li role="Index"><a href="updatetitre.php" class="btn btn-info">Modifier Titre</a></li>
                <li role="Deconnexion" ><a href="Destroy.php" class="btn btn-danger"><span class="glyphicon glyphicon-off" aria-hidden="true">Deconnexion</span></a></li>
            </ul>

        </nav>
        <div class="jumbotron"> <?php

                echo '<h1>'.$donnees['message'].'</h1>';

            ?></div>

        <form method="post"  action="" enctype="multipart/form-data">
            <fieldset>

                <div class="form-group">
                    <label>Titre:</label>
                    <textarea name="description" class="form-control" ><?php echo $donnees['message'] ?></textarea>
                </div>
            </fieldset>
            <input type="submit" name="send" class="btn btn-primary">
        </form>
    </div>
</body>
</html>

<?php

if(isset($_POST['send']))
{


$description=$_POST['description'];

    $requete= "UPDATE message SET message='$description' ";


    if(mysqli_query($bdd,$requete))
    {
        header('Location:Updatetitre.php');

    }
    else{
        echo 'Erreur: '.$requete.'<br>'.mysqli_error($bdd);

    }
}

?>

