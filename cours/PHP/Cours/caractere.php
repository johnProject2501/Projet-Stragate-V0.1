<?php

$texte='******((*(*(*(*(*(*(*(*(*Il etait une fois, une princesse. Elle vivait dans un chateau en chocolat, mais celui-ci fondait avec la chaleur du jour. Pour sauver la princesse, le chevalier mangea le chocolat.********)*)*)*)*)*)*)**)*)*)*)*)*)*';
    
   /* echo strlen($texte);
echo('<hr>');
    echo strtolower($texte);
echo('<hr>');
    echo strtoupper($texte);
echo('<hr>');
    echo mb_strtoupper($texte,'UTF-8');
echo('<hr>');
    echo ucfirst($texte);
echo('<hr>');
    echo ucwords($texte);
echo('<hr>');
    echo lcfirst($texte);
echo('<hr>');
    echo ucfirst(strtolower($texte));
echo('<hr>');
    echo ltrim($texte,'*()');
echo('<hr>');
    echo rtrim($texte,'*()');
echo('<hr>');
    echo trim($texte,'*()');
echo('<hr>');



$nom='Jéan Pierre.pdf';
//echo substr($nom,0,-4);



$accent= array('é','à','è','ù','û',' ');
$remplace= array('e','a','e','u','u','_');
$NomFormat= str_replace($accent,$remplace,$nom);

echo $NomFormat;
*/


$number= (1567.896*6)-4/(78.13+(-12));

echo number_format($number,2,',',' ').'€';







?>