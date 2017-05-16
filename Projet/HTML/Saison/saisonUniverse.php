<?php session_start(); ?>
<!doctype html>
<html>
<head>
            <link rel="stylesheet" type="text/css" href="../../CSS/CssStargate.css">

            <link rel="stylesheet" type="text/css" href="../../CSS/CssMobile.css">

            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


			<link rel="stylesheet" href="../../CSS/Saison.css">
			<meta charset= 'utf-8'/>
			<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1"  />
			

<title>Saison Universe</title>
</head>

<body>
<div id="Site">
<h1><img  src="../../CSS/photo/Banniere-Stargate.png" alt="logo" style="width: 100%;height: auto;"></h1>
                <div>
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
                </div>


    <div class="siteSG1">
                <div class="container-fluid bg-3 text-center">
                    <h3>Saison Stargate Universe</h3><br>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="col-sm-12" style="margin-bottom: 20px">
                                <a href="">
                                    <img src="Universe/photo/universe_s1.jpg" class="img-responsive" style="float: left" alt="Image">
                                    <div class="col-sm-4" style="float: left"><h4>Saison 1</h4></div>
                                    <div class="col-sm-8"></div>

                                    <div class="col-sm-12" style="margin-top: 20px; clear: both"><p>Les survivants de la base Icarus se retrouvent bloqué à bord du
                                            vaisseau ancien 'Destiny' qui les emmene aux confins de l'univers.</p></div>
                                </a>

                            </div>
                            <hr>

                        </div>



                        <div class="col-sm-6">
                            <div class="col-sm-12" style="margin-bottom: 20px">
                                <a href="">
                                    <img src="Universe/photo/universe_s2.jpg" class="img-responsive" style="float: left" alt="Image">
                                    <div class="col-sm-4" style="float: left"><h4>Saison 2</h4></div>
                                    <div class="col-sm-8"></div>

                                    <div class="col-sm-12" style="margin-top: 20px; clear: both"><p>L'équipage du Destiny continue de lutter pour sa survie
                                            alors qu'il découvre que le vaisseau a une mission...</p></div>
                                </a>

                            </div>
                            <hr>
                        </div>

                    </div>
                </div>
    </div>
</div>
</body>


</html>