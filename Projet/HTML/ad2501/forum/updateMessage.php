<?php
session_start();
require_once('../../portion/connectmysqli.php');


if(!empty($_GET['msg'])&& is_numeric($_GET['msg'])){


    $myid=$_GET['msg'];
    $requete="SELECT * FROM forum where ID_f='$myid'";

    $result=mysqli_query($bdd,$requete);
    $donnees=mysqli_fetch_assoc($result);












}

else{
    header('location:http://projet2501.esy.es/Projet/HTML/index.php');
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>ForumUpdate</title>
    <link rel="stylesheet" type="text/css" href="../../../CSS/CssStargate.css">

    <link rel="stylesheet" type="text/css" href="../../../CSS/CssMobile.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


    <link rel="stylesheet" href="../../../CSS/forum.css">
    <meta charset= 'utf-8'/>
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1"  />

</head>
<body>
<div id="Site">
    <h1><img src="../../../CSS/photo/Banniere-Stargate.png" alt="logo" style="width: 100%;height: auto;"></h1>
    <div>
        <?php
        if(isset($_SESSION['pseudo'])){

             include('../../portion/menuco.php');

        }else{

             include('../../portion/menudeco.html');

        }
        ?>
    </div>

    <div class="row">
        <div class="col-md-offset-3 col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading" id="accordion">
                    <div class="input-group">
                        <form method="post" action="portion/discussion.php">
                            <div class="col-md-10">
                                <input id="btn-input" name="message" type="text" class="form-control input-sm" placeholder="Type your message here..."   />
                            </div>
                            <div class="col-md-2">
                                <button id="OK" type="submit" name="send" class="btn btn-primary ">OK</button>
                            </div>
                        </form>

                    </div>
                </div>
                <div class="panel-collapse collapse in" id="collapseOne">
                    <div class="panel-body">
                        <ul class="chat">
                            <?php

                            $picture=$donnees['picture'];
                            $photo= str_replace("../","../../","$picture");


                            $nextWeek = $donnees['date'];
                            echo ('
                                            <li class="right clearfix">
                                                    <span class="chat-img pull-right">
                                                        <img src="'.$photo.'" alt="User Avatar"  style="width: 50px">
                                                    </span>
                                                    
                                                    <div class="chat-body clearfix">
                                                    <div class="header">
                                                        
                                                    
                                                        <small class=" text-muted"><span class="glyphicon glyphicon-time"></span>'.date("d/m/Y", $nextWeek) .' &agrave; '. date("H:i", $nextWeek).'</small>
                                                        <strong class="pull-right primary-font">'.$donnees['pseudo'].'</strong>
                                                    </div>
                                                    <form action="#" method="post">
                                                    <textarea type="texte" name="msg" style="width: 50%;">'.$donnees['message'].'</textarea>
                                                    <input type="submit" name="send" value="OK">
                                                    </form>
                                                   
                                                </div>
                                            </li>
                                            
                            
                                         ');


                            if(isset($_POST['send'])){
                                $message=$_POST['msg'];

                                $requete= "UPDATE forum SET message='$message' WHERE ID_f='$myid'";

                                if(mysqli_query($bdd,$requete))
                                {

                                    header('Location:http://projet2501.esy.es/Projet/HTML/Forum.php');
                                }
                                else{
                                    echo 'Erreur: '.$requete.'<br>'.mysqli_error($bdd);
                                }
                            }
                            ?>



