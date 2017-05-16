<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Document sans nom</title>
</head>

<body>


	<?php 
if (isset($_SESSION['id_ut']) AND isset($_SESSION['pseudo']))
{
    echo 'Bonjour ' . $_SESSION['pseudo'];
}
	
	?>
</body>
</html>
