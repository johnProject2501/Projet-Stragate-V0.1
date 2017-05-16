<?php

function DateCreate($pardate)
{
//LISTE de JOUR
echo '<select name="' . $pardate . 'day">';
    for($i = 1; $i <= 31 ; $i++)
    {
    echo '<option value="'. sprintf('%02d',$i) . '">'. sprintf('%02d',$i) . '</option>'. PHP_EOL;
    }
    echo '</select>';

//LISTE des MOIS
$moi = array('01' => 'Janvier','02' => 'Février','03' => 'Mars','04' => 'Avril', '05' => 'Mai','06' => 'Juin','07' => 'Juillet','08' => 'Aout','09' => 'Septembre','10' => 'Octobre','11' => 'Novembre','12' => 'Décembre');
echo '<select name="' . $pardate . 'month">';
    foreach($moi as $key => $val)
    {
    echo '<option value="' . $key . '">' . $val . '</option>' . PHP_EOL;
    }
    echo '</select>';

//LISTE des ANNEES
$year = date('Y');
echo '<select name="' . $pardate . 'year">';
    for($i = $year;$i <= ($year + 10); $i++)
    {
    echo '<option value="' . $i . '">' . $i . '</option>'. PHP_EOL;
    }
    echo '</select>';
}



?>