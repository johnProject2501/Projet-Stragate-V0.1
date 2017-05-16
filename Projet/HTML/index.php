    <?php session_start(); ?>


<!DOCTYPE HTML>
<html>
		
		<head>
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

			<link rel="stylesheet" type="text/css" href="../CSS/CssStargate.css">
			<link rel="stylesheet" type="text/css" href="../CSS/CssMobile.css">
			<link rel="stylesheet" href="../CSS/font/css/font-awesome.min.css">
			<meta charset= 'utf-8'/>
			<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1"  />
			<title>Projet Stargate </title>
		</head>

		<body><div id="tout">
			<div id="Site">
				<h1><img  src="../CSS/photo/Banniere-Stargate.png" alt="logo" style="width: 100%;height: auto;"></h1>


				
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
					
			
				<br><br><br>


                <div class="container-fluid bg-3 text-center">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="col-sm-12">
                                <p><span class="flotte"><img src="../CSS/photo/devenuesportesetoiles.jpg" alt="porte"></span>
                                <a href="news1.html">Que sont devenues les portes des étoiles ?
                                31 octobre 2016     (Générale)
                                La rédaction vous propose de découvrir ce que sont devenues les portes des étoiles ...</a>
                                 </p>
                            </div>
                            <div class="col-sm-12">
                                 <p>news 2</p>
                            </div>
                        </div>



                        <div class="col-sm-6">
                            <div class="col-sm-12">
						        <figure><a href="concours1.html"><img src="../CSS/photo/concours-sgu-s1-hp.jpg" alt="Concours"></a>
						        </figure></div>
				        </div>
		</div>
		
		</body>
		
	

</html>