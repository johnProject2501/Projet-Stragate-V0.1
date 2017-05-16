
            <?php
session_start();


            $pass = $_SESSION['password'];

            $pseudo = $_SESSION['pseudo'];
            try {
                $bdd = new PDO('mysql:host=mysql.hostinger.fr;dbname=u713664171_pro;charset=utf8','u713664171_john','XHHq2NOGfEscW27chN');
            } catch ( Exception $e ) {
                die( 'Erreur : ' . $e->getMessage() );
            }

            $req = $bdd->prepare( 'SELECT * FROM utilisateur_connecter WHERE pseudo = :pseudo AND password = :pass' );

            if (!$req->execute(array(
                ':pseudo' => $pseudo,
                ':pass' => $pass))) {
                echo "Erreur sql : " . $req->errorInfo()[2];
            }

            $resultat = $req->fetch();

            if (!$resultat)
            {
                echo 'Mauvais identifiant ou mot de passe !';
            }
            else
            {
                session_start();
                $_SESSION['id_ut'] = $resultat['id_ut'];
                $_SESSION['pseudo'] = $pseudo;
                $_SESSION['nom']= $resultat['nom'];
                $_SESSION['prenom']= $resultat['prenom'];
                $_SESSION['age']= $resultat['age'];
                $_SESSION['numero_de_telephone']= $resultat['numero_de_telephone'];
                $_SESSION['email']= $resultat['email'];
                $_SESSION['photo1']=$resultat['photo1'];
                $_SESSION['status']=$resultat['status'];
                header( "Location: index.php" );


            }



            /*if ($req->execute(array(
                ':pseudo' => $pseudo,
                ':pass' => $pass,))) {
                if ( $info = $req->fetch() ) {
                    $_SESSION['id_ut'] = $info["id_ut"];
                    $_SESSION["pseudo"]= $info["pseudo"];
                    header( "Location: index.php" );
                }

            }*/
            ?>
            <title>Projet Stargate <?php echo $_SESSION["pseudo"]; ?></title>