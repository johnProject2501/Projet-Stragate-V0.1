<?php
require_once('fonction.php');

//recuperer les infos de la table travel suivant id

if(!empty($_GET['id']) && is_numeric($_GET['id']))
{
	$myid = $_GET['id'];
	
  require_once('../connectmysqli.php');
  
  $requete = "SELECT * FROM travel WHERE id = '$myid' ";
  
  $result = mysqli_query($bdd, $requete);
  
  $donnees = mysqli_fetch_assoc($result);
}
else
{
	header('Location:ListTravelMysqli.php');
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Mettre à Jour un Voyage</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

</head>
<body>
<div class="container">
<div class="row">
	<ul class="nav nav-tabs">
  		<li role="presentation"><a href="ListTravelMysqli.php">Accueil</a></li>
  		<li role="presentation" class="active"><a href="SendTravelMysqli.php">Ajouter un Voyage</a></li>
      <li><a href="Destroy.php" class="btn btn-primary">Deconnexion</a></li>
	</ul>
</div>
  <div class="row">
  <h1 class="jumbotron">Mettre à jour</h1>
    <form method="post" action="" enctype="multipart/form-data">
      <fieldset>
        <div class="form-group">
          <label>Titre : </label>
          <input type="text" name="title" class="form-control" value="<?php echo $donnees['titre'] ?>">
        </div>
        <div class="form-group">
          <label>Description : </label>
          <br>
          <textarea name="description" class="form-control"><?php echo $donnees['description'] ?></textarea>
        </div>
        <div class="form-group">
          <?php
            //AFFICHAGE DE LA VIGNETTE DE LA PHOTO
            $image = str_replace('upload','thumb',$donnees['photo1']);
          ?>
            <img src="<?php echo $image; ?>">
        </div>
        <div class="form-group">
          <label>Supprimer image</label>
          <input type="checkbox" name="deleteimg">
        </div>
        <div class="form-group">
          <label>Photo : </label>
          <input type="file" name="picture">
        </div>
        <div class="form-group">
          <label>Date de depart : </label>
          <?php
		      //FONCTION explode() CREER UN TABLEAU NUMERIC
		      $dateexplode = explode('-',$donnees['date_depart']);
		  
		      //LISTE DEROULANTE UPDATE JOUR
    		  echo '<select name="startday">';
    			for($i = 1; $i <= 31 ; $i++)
    			{
    				if($dateexplode[2] == sprintf('%02d',$i))
    				{
    					echo '<option value="'. sprintf('%02d',$i) . '" selected>'. sprintf('%02d',$i) . '</option>'. PHP_EOL;
    				}
    				else
    				{
    					echo '<option value="'. sprintf('%02d',$i) . '">'. sprintf('%02d',$i) . '</option>'. PHP_EOL;
    				}
    			}
    	    echo '</select>';

          //LISTE DEROULANTE UPDATE MOIS
      	  $tabmoi = array('01' => 'Janvier','02' => 'Février','03' => 'Mars','04' => 'Avril','05' => 'Juin','06' => 'Juin','07' => 'Juillet','08' => 'Août','09' => 'Septembre','10' => 'Octobre','11' => 'Novembre','12' => 'Décembre');
      	
      		echo '<select name="startmonth">';
      		foreach($tabmoi as $cle => $val)
      		{
      			if($cle == $dateexplode[1] )
      			{
      				echo '<option value="' . $cle . '" selected>' . $val . '</option>'. PHP_EOL;
      			}
      			else
      			{
      				echo '<option value="'.$toto.'">'.$toto.'</option>';
      			}
      		}
      		echo '</select>';
      		
      		//LISTE DEROULANTE UPDATE ANNEE
      		$year = date('Y');
      		echo '<select name="startyear">';
      		for($i = $year;$i <= ($year + 10); $i++)
      		 {
      			 if($dateexplode[0] == $i)
      			 {
      				 echo '<option value="' . $i . '" selected>' . $i . '</option>'. PHP_EOL;
      			 }
      			 else
      			 {
      				echo '<option value="' . $i . '">' . $i . '</option>'. PHP_EOL;
      			 }
      		 }
      		echo '</select>';
      		//FIN LISTE DEROULANTE UPDATE ANNEE
      		?>
        </div>
        <div class="form-group">
          <label>Date de fin : </label>
            <?php
      		  //FONCTION explode() CREER UN TABLEAU NUMERIC
      		  $dateexplode_end = explode('-',$donnees['date_fin']);
      		  //LISTE DEROULANTE2 UPDATE JOUR
      		  echo '<select name="endday">';
      			for($i = 1; $i <= 31 ; $i++)
      			{
      				if($dateexplode_end[2] == sprintf('%02d',$i))
      				{
      					echo '<option value="'. sprintf('%02d',$i) . '" selected>'. sprintf('%02d',$i) . '</option>'. PHP_EOL;
      				}
      				else
      				{
      					echo '<option value="'. sprintf('%02d',$i) . '">'. sprintf('%02d',$i) . '</option>'. PHP_EOL;
      				}
      			}
      	    echo '</select>';
      	    
	          //LISTE DEROULANTE2 UPDATE MOIS
        		echo '<select name="endmonth">';
        		foreach($tabmoi as $cle => $val)
        		{
        			if($cle == $dateexplode_end[1] )
        			{
        				echo '<option value="' . $cle . '" selected>' . $val . '</option>'. PHP_EOL;
        			}
        			else
        			{
        				echo '<option value="' . $cle . '">' . $val . '</option>'. PHP_EOL;
        			}
        		}
        		echo '</select>';
		
        		//LISTE DEROULANTE2 UPDATE ANNEE
        		echo '<select name="endyear">';
        		for($i = $year;$i <= ($year + 10); $i++)
        		 {
        			 if($dateexplode[0] == $i)
        			 {
        				 echo '<option value="' . $i . '" selected>' . $i . '</option>'. PHP_EOL;
        			 }
        			 else
        			 {
        				echo '<option value="' . $i . '">' . $i . '</option>'. PHP_EOL;
        			 }
        		 }
        		echo '</select>';
        		//FIN LISTE DEROULANTE2 UPDATE ANNEE
		  
		        ?>
        </div>
        <div class="form-group">
          <label>Prix : </label>
          <input type="text" name="price" class="form-control" value="<?php echo $donnees['prix'] ?>">
        </div>
        <div class="form-group">
          <label>Nombre de voyageurs : </label>
          <?php
		  	  echo '<select name="listevoyage">';
    			for($i=10; $i <=30; $i+=5)
    			{
    				if($donnees['nb_voyageur'] == $i)
    				{
    					echo '<option value="' . $i . '" selected>' . $i . '</option>' . PHP_EOL;
    				}
    				else
    				{
    					echo '<option value="' . $i . '">' . $i . '</option>' . PHP_EOL;
    				}
    			}
    			echo '</select>';
    		  ?>
        </div>
        <div class="form-group">
          <label>Vaccin obligatoire : </label>
          <?php
			    if($donnees['vaccin'] == 1)
			    {
				    echo '<input type="checkbox" name="vaccine" checked>';
  			  }
  			    else
  			  {
  				  echo '<input type="checkbox" name="vaccine">';
  			  }
		      ?>
        </div>
        <div class="form-group">
          <label>Enfant de 14 ans minimum : </label>
          <?php
  			  if($donnees['age_mini'] == 1)
  			  {
  				  echo '<input type="checkbox" name="minage" checked>';
  			  }
  			  else
  			  {
  				  echo '<input type="checkbox" name="minage">';
  			  }
  		    ?>
          
        </div>
        <div class="form-group">
          <label>Animaux interdits : </label>
          <?php
  			  if($donnees['animaux'] == 1)
  			  {
  				  echo '<input type="checkbox" name="animal" checked>';
  			  }
  			  else
  			  {
  				  echo '<input type="checkbox" name="animal">';
  			  }
		      ?>
        </div>
        <div class="form-group">
          <label>Assurance obligatoire : </label>
          <?php
  			  if($donnees['assurance'] == 1)
  			  {
  				  echo '<input type="checkbox" name="insurance" checked>';
  			  }
  			  else
  			  {
  				  echo '<input type="checkbox" name="insurance">';
  			  }
		      ?>
        </div>
        <div class="form-group">
          <label>Permis de conduire obligatoire : </label>
          <?php
  			  if($donnees['permis'] == 1)
  			  {
  				  echo '<input type="checkbox" name="license" checked>';
  			  }
  			  else
  			  {
  				  echo '<input type="checkbox" name="license">';
  			  }
  		    ?>
        </div>
        <div class="form-group">
          <input type="submit" name="send" class="btn btn-primary btn-lg">
          <input type="reset" class="btn btn-primary btn-lg">
        </div>
      </fieldset>
    </form>
      <?php
      if(isset($_POST['send']))
      {
      	$titre =  htmlentities($_POST['title'],ENT_QUOTES);
      	$description =  htmlentities($_POST['description'],ENT_QUOTES);
      	
      	$datestart = $_POST['startyear'] .'-'. $_POST['startmonth'] .'-'. $_POST['startday'];
      	$dateend = $_POST['endyear'] .'-'. $_POST['endmonth'] .'-'. $_POST['endday'];
      	
      	$goodprice = VerifNum($_POST['price']);
      	
      	////////////////////VACCINE/////////////////////////
      	if(isset($_POST['vaccine']))
      	{
      		$vaccine = 1;
      	}
      	else
      	{
      		$vaccine = 0;
      	}
      	///////////////MINAGE////////////////
      	if(isset($_POST['minage']))
      	{
      		$minage = 1;
      	}
      	else
      	{
      		$minage = 0;
      	}
      	///////////////ANIMAL////////////////
      	if(isset($_POST['animal']))
      	{
      		$animal = 1;
      	}
      	else
      	{
      		$animal = 0;
      	}
      	///////////////INSURANCE////////////////
      	if(isset($_POST['insurance']))
      	{
      		$insurance = 1;
      	}
      	else
      	{
      		$insurance = 0;
      	}
      	///////////////LICENSE////////////////
      	if(isset($_POST['license']))
      	{
      		$license = 1;
      	}
      	else
      	{
      		$license = 0;
      	}
          
        $voyage = $_POST['listevoyage'];
        
        //CAS INSERTION IMAGE AU DEPART
        if($_FILES['picture']['error'] == 4 && $_POST['deleteimg'] != 'on')
        {
          $updateimage = $image;
        }
        elseif($_FILES['picture']['error'] !=4 && $_FILES['picture']['error'] !=0)
        {
          //CONTROLE ERREUR
      		switch($_FILES['picture']['error'])
      		{
      		  case 1 :
      			echo 'Le fichier est trop lourd';
      			break;
      			
      			case 3 :
      			echo 'le fichier a été chargé partiellement';
      			break;
      			
      			case 6 :
      			echo 'pas de répertoire temporaire';
      			break;
      			
      		}
        }
        elseif($_FILES['picture']['error'] == 0)
        {
          //TRAITEMENT
          //str_replace supprime espace nom fichier
      		$namenospace = str_replace(' ','',$_FILES['picture']['name']);
      	
      		//strtolower nom du fichier en minus
      		$namelower = strtolower($namenospace);
      		
      		//pathinfo recupere extension fichier
      		$extension = pathinfo($namelower,PATHINFO_EXTENSION);
      		
      		//tableau avec extension valide
      		$extensionOK = array('jpg','jpeg','gif','png');
      		
      		//in_array verifie existence extension dans nom fichier
      		if(in_array($extension,$extensionOK))
      		{
      			$destination = '../upload/';
      			$updateimage = $destination.$namelower;
      			//transfert fichier dans un repertoire
      			move_uploaded_file($_FILES['picture']['tmp_name'],$updateimage);
      
            //Fonction de creation vignette
            
            if($extension == 'jpg' || $extension == 'jpeg')
            {
                CreateVignetteJpeg($updateimage,$namelower);
            }
            elseif($extension == 'gif')
            {
                CreateVignetteGif($updateimage,$namelower);
            }
            else
            {
                CreateVignettePng($updateimage,$namelower);
            }
                  
      		}
      		else
      		{
      			echo 'Extension non valide';
      			exit();
      		}
        }
        elseif($_POST['deleteimg'] == 'on' && $image != '../thumb/noimage.png')
        {
          unlink($donnees['photo1']);
          unlink($image);
          
          $updateimage = '../img/noimage.png';
        }
        
      	
      	$requeteUp = "UPDATE travel SET titre='$titre',description='$description',photo1 = '$updateimage',date_depart='$datestart',date_fin='$dateend',prix='$goodprice',nb_voyageur= '$voyage',vaccin='$vaccine',age_mini='$minage',animaux='$animal',assurance='$insurance',permis='$license' WHERE id='$myid'";
          
        if (mysqli_query($bdd, $requeteUp))
        {
            echo "Record updated successfully";
        } else
        {
            echo "Erreur updating record: " . mysqli_error($bdd);
        }
    
        mysqli_close($bdd);
      
      	/*NOTIFICATION POUR SIMONE*/
      	
      	//$message = 'Simone, le fichier excel est à jour';
      	
      	//mail('simone@travelfree.com','Mise à jour information',$message);
      	
      	//header('Location:ListTravelMysqli.php');
      			
      }
      ?>
    </div>
    </div>
</body>
</html>