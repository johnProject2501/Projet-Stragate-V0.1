<?php
require_once('../connectmysqli2.php');


$requete="SELECT * FROM travel ORDER BY id DESC LIMIT 3";

$result=mysqli_query($bdd,$requete);
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Formulaire de contact</title>
    <!-- call bootstrap -->
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet">

</head>
<nav class="navbar navbar-inverse">


    <div class="navbar-header">
        <a class="navbar-brand" href="#">VoyageLand</a>
    </div>
    <ul class="nav navbar-nav">
        <li class="active"><a href="index.php">Accueil</a></li>
        <li><a href="ListTravelMysqli.php">Liste Voyages</a></li>
        <li><a href="#">Contacts</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
        <li><a href="admin/index.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
    </ul>


</nav>
<body style="padding:100px 0 200px 0">
<div style="padding-bottom:100px" class="container">
    <div class="jumbotron"><h1>Contactez-nous</h1></div>
</div>
<!-- CONTENT -->
<div class="container">
    <form action="Contact.php" method="post">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="inputname">Votre nom</label>
                    <input required type="text" name="name" class="form-control" id="inputname" value="">
                </div><!--/*.form-group-->
            </div><!--/*.col-md-6-->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="inputemail">Votre email</label>
                    <input required type="email" name="email" class="form-control" id="inputemail" value="">
                </div><!--/*.form-group-->
            </div><!--/*.col-md-6-->
            <div class="col-md-12">
                <div class="form-group">
                    <label for="inputmessage">Votre message</label>
                    <textarea required id="inputmessage" name="message" class="form-control"></textarea>
                </div><!--/*.form-group-->
            </div><!--/*.col-md-12-->
            <div class="col-md-12">
                <div class="checkbox">

                </div>
            </div><!--/*.col-md-12-->
            <div class="col-md-12">
                <button type='submit' name="send" class='btn btn-primary'>Envoyer</button>
            </div><!--/*.col-md-12-->
        </div><!--/*.row-->
    </form>
</div><!--/*.container-->
<!-- END CONTENT -->
</body>


<?php
if(isset($_POST['send']))
{

$nom=$_POST['name'];
$email=$_POST['email'];
$message=$_POST['message'];


    $to      = $email;
    $subject = 'ExoPHP';
    $headers = 'From:'.$email . "\r\n" .
        'Reply-To: webmaster@example.com' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

    mail($to, $subject, $message, $headers);

    echo "Email Envoyer";
}
?>
</html>