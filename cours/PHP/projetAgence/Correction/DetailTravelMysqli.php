<?php
require_once('../connectmysqli.php');
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Voyage, Voyage...</title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
</head>

<body>
<div class="container">
<div class="row">
<ul class="nav nav-tabs">
  <li role="presentation"><a href="ListTravelMysqli.php">Accueil</a></li>
  <li role="presentation"><a href="SendTravelMysqli.php">Ajouter un Voyage</a></li>
   <li><a href="Destroy.php" class="btn btn-primary">Deconnexion</a></li>
</ul>
</div>
<div class="row">
<?php
if(!empty($_GET['id']) && is_numeric($_GET['id']))
{

	$myid = $_GET['id'];
	
	//CREATION DE LA REQUTE
  $requete = "SELECT * FROM travel WHERE id = '$myid'";
  
  //EXECUTION DE LA REQUETE
  $result = mysqli_query($bdd, $requete);

	$donnees = mysqli_fetch_assoc($result);
	
	
  $datesql = $donnees['date_depart'];
  
	$detail = '<h1 class="jumbotron">';
	$detail .= $donnees['id'] . '<br> ' . $donnees['titre'] . ' <hr> Départ le : ' . date('d-m-Y', strtotime($datesql)) . '<hr> A partir de : ' . $donnees['prix'] . ' €';
	$detail .= '</h1>';
	$detail .= '<p>';
	$detail .= $donnees['description'];
	$detail .= '</p>';
	$detail .= '<figure>';
    
    //Changment chemin vers vignette
    $vignette = str_replace('upload','thumb',$donnees['photo1']);
    
	$detail .= '<img src="' . $vignette . '">';
	$detail .= '</figure>';
	$detail .= '<hr>';
	
	if($donnees['vaccin'] == 1)
	{
		$detail .= '<p>';
		$detail .= 'Vaccin obligatoire';
		$detail .= '</p>';
	}
	if($donnees['age_mini'] == 1)
	{
		$detail .= '<p>';
		$detail .= 'Age minimum requis est de 14 ans';
		$detail .= '</p>';
	}
	if($donnees['animaux'] == 1)
	{
		$detail .= '<p>';
		$detail .= 'Les animaux sont interdits';
		$detail .= '</p>';
	}
	if($donnees['assurance'] == 1)
	{
		$detail .= '<p>';
		$detail .= 'Assurance obligatoire';
		$detail .= '</p>';
	}
	if($donnees['permis'] == 1)
	{
		$detail .= '<p>';
		$detail .= 'Permis de conduire requis';
		$detail .= '</p>';
	}
	
	echo $detail;

}
else
{
	header('Location:ListTravel.php');
}
?>

<a href="ListTravelMysqli.php" class="btn btn-primary">Retour</a>
</div>
</div>
</body>
</html>