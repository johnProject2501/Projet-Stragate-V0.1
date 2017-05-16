<?php
require_once('../connectmysqli2.php');
?>


<!DOCTYPE html>
<html>
<head>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title></title>
</head>
    <body style="margin-left: 5%;margin-top: 5%;margin-right: 5%">

    <div class="container-fluid">

    <h1 class="jumbotron">Authentification</h1>
            <form method="post"  action="" enctype="multipart/form-data">
                <fieldset>

                    <div class="form-group">
                        <label for="email">Votre Email:</label>
                        <input type="text" class="form-control" id="email" name="log">
                    </div>
                    <div class="form-group">
                        <label for="mdp">Mot de Passe:</label>
                        <input type="password" class="form-control" id="mdp" name="mdp">
                    </div>
                    <div class="form-group">

                    <div class=""form-group">
                        <input type="submit" name="send" class="btn btn-primary">
                        <input type="reset" class="btn btn-primary">
                    </div>

            </fieldset>
        </form>
    </div>
    </body>
</html>

<?php
if(isset($_POST['send'])){

    $log=htmlentities($_POST['log'],ENT_QUOTES);
    $mdp=htmlentities($_POST['mdp'],ENT_QUOTES);

    $requete= "SELECT * FROM user WHERE '$log'= email";
    $result=mysqli_query($bdd,$requete);

    $donnees=mysqli_fetch_assoc($result);
    $hash=$donnees['password'];


    if(password_verify($mdp,$hash))
    {

        session_start();
        $idunic=uniqid();
        $_SESSION['travel']=$idunic;

        header('Location:ListTravelMysqli.php');



    }
    else{
        echo '<div class="alert alert-danger" role="alert">
              <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
              <span class="sr-only">Error:</span>
              Entrer une email valide ou un mot de passe valide.
            </div>';


    }






}
?>