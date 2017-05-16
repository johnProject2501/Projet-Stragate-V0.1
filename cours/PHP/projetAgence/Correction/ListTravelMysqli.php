<?php
require_once('../connectmysqli.php');
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Liste des Mes Voyages</title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
</head>

<body>
  <div class="container">
  <div class="row">
    <ul class="nav nav-tabs">
      <li role="presentation" class="active"><a href="#">Accueil</a></li>
      <li role="presentation"><a href="SendTravelMysqli.php">Ajouter un Voyage</a></li>
      <li><a href="Destroy.php" class="btn btn-primary">Deconnexion</a></li>
    </ul>
  </div>
  <div class="row">
    <h1 class="jumbotron">Liste des Voyages Mysqli</h1>
    <table class="table">
    <tr>
      <th>Titre</th><th>Date de départ</th><th>Date de fin</th><th>Prix</th><th>Detail</th><th>Supprimer</th><th>Mise à jour</th>
    </tr>
   
<?php
//CREATION DE LA REQUTE
$requete = "SELECT * FROM travel ORDER BY id DESC";

//EXECUTION DE LA REQUETE
$result = mysqli_query($bdd, $requete);

//CONSTRUCTION DES LIGNES PAR BOUCLE
while($donnees = mysqli_fetch_assoc($result)) {
	echo 	'<tr><td>' . $donnees['titre'] . '</td>
			<td>' . $donnees['date_depart'] . '</td>
			<td>' . $donnees['date_fin'] . '</td>
			<td>' .$donnees['prix'] . '</td>
			<td><a href="DetailTravelMysqli.php?id='. $donnees['id'] .'" class="btn btn-primary">Detail</a></td>
			<td>
			<a href="DeleteTravelMysqli.php?id='. $donnees['id'] .'" class="btn btn-danger">Supprimer</a></td>
			<td><a href="UpdateTravelMysqli.php?id='. $donnees['id'] .'" class="btn btn-default">Mettre à Jour</a></td></tr>';
}
?>
            </table>
        </div>
    </div>
</body>
</html>