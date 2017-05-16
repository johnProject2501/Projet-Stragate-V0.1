<?php
    
    function CalculTVA($prix){
        return(($prix*0.2)+$prix);
    }
echo (CalculTVA(100));

echo('<hr>');

    function CalculTVaTaux($prix,$taux){
        return($prix*$taux)/100+$prix;
    }
echo(CalculTVaTaux(100,20));



   








?>

