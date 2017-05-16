<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Document sans titre</title>
</head>

<body>

<form method="post" action="" enctype="application/x-www-form-urlencoded">
    <fieldset>
        <legend>Calculez votre IMC</legend> 
        <label for="Poids">Poids: </label><input type="text" name="weight" id="Poids" placeholder="50kg" pattern="^[1-9][0-9]{0,2}(\.[0-9]{1,2})?$" /> <br>
        <label for="Taille">Taille: </label><input type="text" name="height" id="Taille" placeholder="1.80m" pattern="^[0-2](\.[0-9]{0,2})?$" /> <br>
        <label for="numero">Tel: </label><input type="text" name="telephone" id="Telephone" placeholder="0505050505" pattern="^0[1-9][0-9]{8}" /> <br>
        <label for="mail">email: </label><input type="text" name="mail" id="email" placeholder="rambo@john.com" pattern="^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$" /> <br>
        <input type="submit" name="send" value="valider"/>
        <input type="reset" name="reset" value="Reset"/>
    </fieldset>
    

</form>
<?php
    
        
    
   
    
    if(isset($_POST['weight']))   {
        $poid=$_POST['weight'];
        $taille=$_POST['height'];
        
        if($taille != 0){
            
$imc= (($poid)/($taille*$taille));
$resultatvalid= number_format($imc,1,","," ");
            
echo('<p>votre imc est de '.$resultatvalid. '</p>');
            
if($imc<16.5){
    echo('<p>dénutrition ou famine</p>');    
}
elseif($imc>=16.5 AND $imc<18.5){
    echo('<p>maigreur</p>');
}
elseif($imc>=18.5 AND $imc<25){
    echo('<p>corpulence normal</p>');
}
elseif($imc>=25 AND $imc<30){
    echo('<p>surpoids</p>');
}
elseif($imc>=30 AND $imc<35){
    echo('<p>obisité modéré</p>');
}
elseif($imc>=35 AND $imc<40){
    echo('<p>obisité severe</p>');
}
elseif($imc>=40 ){
    echo('<p>obésité morbide ou massive</p>');
}

else{
    echo('<p>erreur</p>');
}
            
            
        }
    }
   
					
    
    echo('<hr>');
    ?>







<?php

$poid=80.5;
$taille=1.80;


$imc= (($poid)/($taille*$taille));

echo('<p> imc: ');
echo number_format($imc,1,","," " .'</p>');

echo('<hr>');

if($imc<16.5){
    echo('<p>dénutrition ou famine</p>');    
}
elseif($imc>=16.5 AND $imc<18.5){
    echo('<p>maigreur</p>');
}
elseif($imc>=18.5 AND $imc<25){
    echo('<p>corpulence normal</p>');
}
elseif($imc>=25 AND $imc<30){
    echo('<p>surpoids</p>');
}
elseif($imc>=30 AND $imc<35){
    echo('<p>obisité modéré</p>');
}
elseif($imc>=35 AND $imc<40){
    echo('<p>obisité severe</p>');
}
elseif($imc>=40 ){
    echo('<p>obésité morbide ou massive</p>');
}

else{
    echo('<p>erreur</p>');
}


?>
</body>
</html>