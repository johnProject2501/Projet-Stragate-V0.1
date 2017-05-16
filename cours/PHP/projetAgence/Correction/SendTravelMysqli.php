<?php
require_once('../connectmysqli.php');
require_once('fonction.php');
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Document sans titre</title>
<!-- Latest compiled and minified CSS -->
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
  <h1 class="jumbotron">Ajouter un voyage</h1>
    <form method="post" action="SendTravelMysqli.php" enctype="multipart/form-data" >
      
      
      <fieldset>
        <div class="form-group">
          <label>Titre : </label>
          <input type="text" name="title" class="form-control" required>
        </div>
        <div class="form-group">
          <label>Description : </label>
          <br>
          <textarea name="description" class="form-control"></textarea>
        </div>
        <div class="form-group">
          <label>Photo : </label>
          <input type="file" name="picture">
        </div>
        <div class="form-group">
          <label>Date de depart : </label>
          <?php DateCreate('start'); ?>
        </div>
        <div class="form-group">
          <label>Date de fin : </label>
          <?php DateCreate('end'); ?>
        </div>
        <div class="form-group">
          <label>Prix : </label>
          <input type="text" name="price" maxlenght="5" class="form-control" value="0" pattern="^[1-9][0-9]{0,4}$">
        </div>
        <div class="form-group">
          <label>Nombre de voyageurs : </label>
          <select name="listevoyage">
            <option value="10">10</option>
            <option value="15">15</option>
            <option value="20">20</option>
            <option value="25">25</option>
          </select>
        </div>
        <div class="form-group">
          <label>Vaccin obligatoire : </label>
          <input type="checkbox" name="vaccine" >
        </div>
        <div class="form-group">
          <label>Enfant de 14 ans minimum : </label>
          <input type="checkbox" name="minage">
        </div>
        <div class="form-group">
          <label>Animaux interdits : </label>
          <input type="checkbox" name="animal">
        </div>
        <div class="form-group">
          <label>Assurance obligatoire : </label>
          <input type="checkbox" name="insurance">
        </div>
        <div class="form-group">
          <label>Permis de conduire obligatoire : </label>
          <input type="checkbox" name="license">
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
	
	//CONTROLE FICHIER//
	if($_FILES['picture']['error'] != 0)
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
			
			/*case 4 :
			echo 'aucun fichier saisi';
			break;*/
			
			case 6 :
			echo 'pas de répertoire temporaire';
			break;
		}
		
		$nom = '../img/noimage.png';
	}
	else
	{
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
			$nom = $destination.$namelower;
			//transfert fichier dans un repertoire
			move_uploaded_file($_FILES['picture']['tmp_name'],$nom);

      //Fonction de creation vignette
      
      if($extension == 'jpg' || $extension == 'jpeg')
      {
          CreateVignetteJpeg($nom,$namelower);
      }
      elseif($extension == 'gif')
      {
          CreateVignetteGif($nom,$namelower);
      }
      else
      {
          CreateVignettePng($nom,$namelower);
      }
            
		}
		else
		{
			echo 'Extension non valide';
			exit();
		}
	}
	
	//FIN CONTROLE FICHIER
	
	$titre =  htmlentities($_POST['title'],ENT_QUOTES);
	$description =  htmlentities($_POST['description'],ENT_QUOTES);
	
	//TEST INSERTION PHOTO
	//echo print_r($_FILES['picture']);
	$nom = 'photo';
	
	$datestart = $_POST['startyear'] .'-'. $_POST['startmonth'] .'-'. $_POST['startday'];

	$dateend = $_POST['endyear'] .'-'. $_POST['endmonth'] .'-'. $_POST['endday'];
	
	//$goodprice = VerifNum($_POST['price']);
	
	$goodprice = $_POST['price'];
	
	$voyage = $_POST['listevoyage'];


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


  // Controle connection
  if (!$bdd)
  {
      die('Connection echoué: ' . mysqli_connect_error());
  }
  
  $requete = "INSERT INTO travel (titre,description,photo1,date_depart,date_fin,prix,nb_voyageur,vaccin,age_mini,animaux,assurance,permis)  VALUES ('$titre','$description','$nom','$datestart','$dateend','$goodprice','$voyage','$vaccine','$minage','$animal','$insurance','$license')";

  if(mysqli_query($bdd, $requete))
  {
    echo 'Insertion réussi';
  }
  else
  {
    echo 'Erreur: ' . $requete . '<br>' . mysqli_error($bdd);
  }
	
}
?>
  </div>
</div>
</body>
</html>