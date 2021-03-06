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
			

<title>Saison Atlantis</title>
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
                    <h3>Saison Stargate Atlantis</h3><br>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="col-sm-12" style="margin-bottom: 20px">
                                <a href="">
                                    <img src="Atlantis/photo/atlantis_s1.jpg" class="img-responsive" style="float: left" alt="Image">
                                    <div class="col-sm-4" style="float: left"><h4>Saison 1</h4></div>
                                    <div class="col-sm-8"></div>

                                    <div class="col-sm-12" style="margin-top: 20px; clear: both"><p>Une toute nouvelle équipe voyage vers une autre galaxie pour découvrir la
                                            Cité Perdue des Anciens, un terrible nouvel ennemi et de nombreux nouveaux mondes.</p></div>
                                </a>

                            </div>
                            <hr>

                            <div class="col-sm-12" style="margin-bottom: 20px">
                                <a href="">
                                    <img src="Atlantis/photo/atlantis_s2.jpg" class="img-responsive" style="float: left" alt="Image">
                                    <div class="col-sm-4" style="float: left"><h4>Saison 2</h4></div>
                                    <div class="col-sm-8"></div>

                                    <div class="col-sm-12" style="margin-top: 20px; clear: both"><p>Ayant repoussé une attaque de la part des Wraiths et pouvant désormais communiquer avec la Terre,
                                            l’expédition Atlantis entreprend l’exploration de la galaxie de Pégase.</p></div>
                                </a>

                            </div>
                            <hr>

                            <div class="col-sm-12" style="margin-bottom: 20px">
                                <a href="">
                                    <img src="Atlantis/photo/atlantis_s3.jpg" class="img-responsive" style="float: left" alt="Image">
                                    <div class="col-sm-4" style="float: left"><h4>Saison 3</h4></div>
                                    <div class="col-sm-8"></div>

                                    <div class="col-sm-12" style="margin-top: 20px; clear: both"><p>Avec les Wraiths pouvant attaquer à tout moment, l’expédition Atlantis explore la
                                            galaxie de Pégase et fait la rencontre d’un tout nouvel ennemi.</p></div>
                                </a>

                            </div>
                            <hr>

                        </div>

                        <div class="col-sm-6">
                            <div class="col-sm-12" style="margin-bottom: 20px">
                                <a href="">
                                    <img src="Atlantis/photo/atlantis_s4.jpg" class="img-responsive" style="float: left" alt="Image">
                                    <div class="col-sm-4" style="float: left"><h4>Saison 4</h4></div>
                                    <div class="col-sm-8"></div>

                                    <div class="col-sm-12" style="margin-top: 20px; clear: both"><p>Atlantis doit non seulement faire face aux Wraiths toujours à la recherche de nourriture
                                            mais doit aussi affronter son nouvel ennemi très puissant, les Asurans.</p></div>
                                </a>

                            </div>
                            <hr>

                            <div class="col-sm-12" style="margin-bottom: 20px">
                                <a href="">
                                    <img src="Atlantis/photo/atlantis_s5.jpg" class="img-responsive" style="float: left" alt="Image">
                                    <div class="col-sm-4" style="float: left"><h4>Saison 5</h4></div>
                                    <div class="col-sm-8"></div>

                                    <div class="col-sm-12" style="margin-top: 20px; clear: both"><p>L'expédition Atlantis continue d'explorer la galaxie de Pégase tout en affrontant les Wraiths</p></div>
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