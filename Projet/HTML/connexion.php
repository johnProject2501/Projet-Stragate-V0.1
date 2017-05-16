<?php session_start(); ?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Connexion</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="../CSS/CssStargate.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="../CSS/CssMobile.css">

		<meta charset= 'utf-8'/>
	</head>
	<body>
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
			</br></br></br>
<div align="center">
            <div class="container">


                <form action="connexion2.php" method="post" class="form-inline" style="background-color: lightgray;"">
                    <legend style="color: rgba(45,172,214,1);">Connexion</legend>
                    <div class="form-group">
                        <label for="email">Login</label>
                        <input type="login" name="login" class="form-control" style="width: 200px;" required="required" id="login" placeholder="Entrer Login">
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" id="password" name="password" style="width: 200px;" required="required" placeholder="Entrer password">

                    </div>


                    <button type="submit" class="btn btn-primary">Connexion</button>
                <br><br><br>
                </form>
            </div>
</div>


<div>
            <div class="container">


                <form action="portion/formulaire.php" method="post" id="form" style="background-color: lightgray;">
                    <legend style="color: rgba(45,172,214,1); text-align: center">Inscription</legend>

                    <div id="pseudocheck" class="form-group" style="margin-left: 35%;">
                        <label for="Pseudo">Login</label>
                        <input type="Pseudo" name="Pseudo" class="form-control" style="width: 50%;"  id="Pseudo" required="required" placeholder="Pseudo">
                        <div id="messagePseudo"></div>
                     </div>

                    <div class="form-group" style="margin-left: 35%;">
                        <label for="Nom">Nom</label>
                        <input type="text" name="Nom" class="form-control" style="width: 50%;"  id="Nom" placeholder="Nom">
                    </div>

                    <div class="form-group" style="margin-left: 35%;">
                        <label for="Prenom">Prenom:</label>
                         <input type="text" class="form-control" id="Prenom" style="width: 50%;" name="Prenom" placeholder="Prenom">
                    </div>

                    <!--<div class="form-group" style="margin-left: 35%;">
                        <label for="Annee de Naissance">Date de Naissance:</label>
                        <input type="date" class="form-control" id="Annee de Naissance" style="width: 50%;" name="Annee de Naissance" placeholder="Annee de Naissance">
                    </div>-->

                    <div class="form-group" style="margin-left: 35%;">
                        <label for="Annee de Naissance">Date de Naissance:</label>
                        <?php
                        //liste deroulante update jour
                        echo '<select name="startday">';
                        for ($i=1; $i <= 31; $i++) {
                            echo '<option value="' .sprintf('%02d',$i). '">' .sprintf('%02d',$i) . '</option>'. PHP_EOL;
                        }
                        echo '</select>';

                        //liste deroulante update Mois


                        $tabmoi = array('01' => 'Janvier','02' => 'Février','03' => 'Mars','04' => 'Avril', '05' => 'Mai','06' => 'Juin','07' => 'Juillet',
                            '08' => 'Aout','09' => 'Septembre','10' => 'Octobre','11' => 'Novembre','12' => 'Décembre');

                        echo '<select name="startmonth">';
                        foreach($tabmoi as $cle=>$val){
                            echo'<option value="'.$cle.'">'.$val.'</option>'.PHP_EOL;
                        }


                        echo '</select>';

                        //liste deroulante update An
                        echo '<select name="startyear">';
                        $year= date('Y');
                        for($i= $year ; $i>=($year-70);$i--){

                            echo '<option value="'.$i.'">'.$i .'</option>';
                        }
                        echo '</select>';

                        ?>
                    </div>


                    <div class="form-group" style="margin-left: 35%;">
                        <label for="Numero de telephone">Numéro de Téléphone</label>
                        <input type="number" class="form-control" style="width: 50%;" name="Numero de telephone" id="Numero de telephone" placeholder="0656587811" pattern="^0[1-9][0-9]{8}" />
                    </div>

                    <div id="emailcheck" class="form-group" style="margin-left: 35%;">
                        <label for="Adresse email">Adresse Email</label>
                           <input type="email"  class="form-control" style="width: 50%;" name="email" id="email" required="required" placeholder="johnrambo@Rambo.com" pattern="^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$" />
                           <div id="checkemail"></div>
                    </div>

                    <div class="form-group" style="margin-left: 35%;">
                        <label for="mot de Passe">Mot de Passe</label>
                        <input type="password" class="form-control" style="width: 50%;" name="pass" required="required" id="pass" placeholder="**************"  />
                    </div>

                    <div class="form-group" style="margin-left: 35%;">
                        <label for="Confirmation mot de passe">Confirmation mot de passe</label>
                            <input type="password" class="form-control" style="width: 50%;" name="checkpass" id="checkpass" required="required"  placeholder="***************"  /> <br><br>
                            <div id="message"></div>
                    </div>

                    <div style="text-align: center">
                        <button id="OK" type="submit" class="btn btn-primary">Inscription</button>
                    </div>
                </form>
            </div>



</div>
		</div>
        <script src="Js/checkpass.js"></script>


	</body>
</html>