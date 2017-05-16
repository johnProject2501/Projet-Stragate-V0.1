<?php session_start();
require_once ('portion/connectmysqli.php');
?>


<!DOCTYPE html>
<html>
<head>
    <title>Forum</title>
    <link rel="stylesheet" type="text/css" href="../CSS/CssStargate.css">

    <link rel="stylesheet" type="text/css" href="../CSS/CssMobile.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


    <link rel="stylesheet" href="../CSS/forum.css">
    <meta charset= 'utf-8'/>
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1"  />

</head>
<body>
    <div id="Site">
        <h1><img  src="../CSS/photo/Banniere-Stargate.png" alt="logo" style="width: 100%;height: auto;"></h1>
        <div>
            <?php
            if(isset($_SESSION['pseudo'])){
                ?>
                <?php include('portion/menuco.php') ?>
            <?php
            }else{
                ?>
                <?php include('portion/menudeco.html') ?>
            <?php
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
                                    $requete="SELECT * FROM forum ORDER BY ID_f DESC limit 7";

                                    $result=mysqli_query($bdd,$requete);


                                   if(session_id() && $_SESSION['status']==2){



                                        while($donnees=mysqli_fetch_assoc($result)){

                                            $picture=$donnees['picture'];
                                            $photo= str_replace("../","","$picture");

                                            $nextWeek = $donnees['date'];
                                            echo ('
                                           
                                                
                                            
                                            
                                            <li class="right clearfix">
                                            <div class="col-md-12">
                                                <div class="col-md-10"></div>
                                                <div class="col-md-1">
                                                    <a href="ad2501/forum/deleteMessage.php?msg='.$donnees['ID_f'].'" class="text-danger">
                                                        <span aria-hidden="true"> &times; </span>
                                                    </a>
                                                </div>
                                                
                                                <div class="col-md-1">
                                                    <a href="ad2501/forum/updateMessage.php?msg='.$donnees['ID_f'].'">
                                                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"> </span>
                                                    </a>
                                                </div>
                                                
                                                
                                                
                                                
                                                
                                                     
                                            </div>
                                                    <span class="chat-img pull-right">
                                                        <img src="'.$photo.'" alt="User Avatar"  style="width: 50px">
                                                    </span>
                                                    
                                                    <div class="chat-body clearfix">
                                                    <div class="header">
                                                        
                                                    
                                                        <small class=" text-muted"><span class="glyphicon glyphicon-time"></span>'.date("d/m/Y", $nextWeek) .' &agrave; '. date("H:i", $nextWeek).'</small>
                                                        <strong class="pull-right primary-font">'.$donnees['pseudo'].'</strong>
                                                    </div>
                                                    <p>
                                                    '.$donnees['message'].'
                                                    </p>
                                                     
                                                </div>
                                                    
                                            
                                            </li>
                                        
                            
                                         ');
                                        }

                                    }

                                   else{

                                        while($donnees=mysqli_fetch_assoc($result)){

                                            $picture=$donnees['picture'];
                                            $photo= str_replace("../","","$picture");

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
                                                    <p>
                                                    '.$donnees['message'].'
                                                    </p>
                                                </div>
                                            </li>
                                            
                            
                                         ');
                                        }
                                    }







                                    ?>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



    </div>

</body>
</html>