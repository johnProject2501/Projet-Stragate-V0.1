<?php

$pass='admin';

$passwordhash=password_hash($pass,PASSWORD_DEFAULT);

echo $passwordhash;

echo '<hr>';
if(password_verify($pass,$passwordhash)){
    echo 'mot de passe valide';
}
    else{
        echo'mot de passe invalide';
    }



