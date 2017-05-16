<?php session_start();?>
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="http://projet2501.esy.es/Projet/HTML/index.php">Projet Stargate</a>
        </div>
        <ul class="nav navbar-nav">

            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Stargate SG1<span class="caret"></span></a>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu3" >
                    <li><a href="http://projet2501.esy.es/Projet/HTML/Saison/saisonsg1.php">Liste des Saisons</a></li>
                    <li><a href="#">Films</a></li>
                    <li><a href="#">Acteurs Principaux</a></li>
                    <li><a href="#">Zone Fan</a></li>
                </ul>
            </li>

            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Stargate Atlantis<span class="caret"></span></a>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu3" >
                    <li><a href="http://projet2501.esy.es/Projet/HTML/Saison/saisonAtlantis.php">Liste des Saisons</a></li>
                    <li><a href="#">Acteurs Principaux</a></li>
                    <li><a href="#">Multimedia</a></li>
                </ul>
            </li>

            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Stargate Universe<span class="caret"></span></a>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu3" >
                    <li><a href="http://projet2501.esy.es/Projet/HTML/Saison/saisonUniverse.php">Liste des Saisons</a></li>
                    <li><a href="#">Acteurs Principaux</a></li>
                    <li><a href="#">Multimedia</a></li>
                </ul>
            </li>

            <li><a href="http://projet2501.esy.es/Projet/HTML/Forum.php">Discussion</a></li>
            <li><a href="boutique.html">Boutique</a></li>

            <form class="navbar-form navbar-left">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Recherche">
                    <div class="input-group-btn">
                        <button class="btn btn-default" type="submit">
                            <i class="glyphicon glyphicon-search"></i>
                        </button>
                    </div>
                </div>
            </form>

        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">	<?php
                    if (isset($_SESSION['id_ut']))
                    {
                        echo 'Bonjour ' . $_SESSION["pseudo"];
                    }

                    ?><span class="caret"></span></a>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu3" >
                    <li><a href="http://projet2501.esy.es/Projet/HTML/ModifProfil/Moncompte.php">Mon Compte</a> </li>
                    <li><a href="http://projet2501.esy.es/Projet/HTML/portion/deconnexion.php">Déconnexion</a></li>

                </ul>
            </li>
        </ul>
    </div>
</nav>