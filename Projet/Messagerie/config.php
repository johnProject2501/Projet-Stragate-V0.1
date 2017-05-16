<?php
//On demarre les sessions
session_start();

/******************************************************
----------------Configuration Obligatoire--------------
Veuillez modifier les variables ci-dessous pour que l'
espace membre puisse fonctionner correctement.
******************************************************/

//On se connecte a la base de donnee
mysql_connect('mysql.hostinger.fr', 'u713664171_john', 'XHHq2NOGfEscW27chN');
mysql_select_db('u713664171_pro');

//Email du webmaster
$mail_webmaster = 'projetstargate@projet2501.esy.es';

//Adresse du dossier de la top site
$url_root = 'http://www.example.com/';

/******************************************************
----------------Configuration Optionelle---------------
******************************************************/

//Nom du fichier de laccueil
$url_home = 'http://projet2501.esy.es/Projet/HTML/index.php';

//Nom du design
$design = 'default';
?>