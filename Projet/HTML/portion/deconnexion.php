<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Document sans titre</title>
</head>

<body>

<?php
session_start();
session_destroy();
?>
<?php  header('Location: http://projet2501.esy.es/Projet/HTML/index.php'); ?>
</body>
</html>