<?php
//FONCTION VERIFICATION NUMBER
function VerifNum($param)
{
	$nospace = str_replace(' ','',$param);
	$num = str_replace(',','.',$nospace);
	if(is_numeric($num))
	{
		return $num;
	}
	else
	{
		echo 'Ceci n\'est pas un nombre';
	}
}

//FONCTION LISTE DEROULANTE DATE
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

function CreateVignetteJpeg($source,$name)
{
    // IMAGE SOURCE
    $img = imagecreatefromjpeg($source);

    // INFORMATIONS TAILLE IMAGE SOURCE
    $size = getimagesize($source);

    // CREATION IMAGE DESTINATION
    $img_dest = imagecreatetruecolor(200,200);
    
    //CREATION COULEUR ET REMPLISSAGE DE LA ZONE EN BLANC
    $img_background = imagecolorallocate($img_dest,255,255,255);
    imagefill($img_dest,0,0,$img_background);

    if($size[0] > $size[1])
    {
        $long = 200;
        $larg = $size[0]*200/$size[1];
        imagecopyresized($img_dest,$img,0,0,$larg/2,0,$larg,$long,$size[0],$size[1]);
    }
    else
    {
        $larg = 200;
        $long = $size[1]*200/$size[0];
        imagecopyresized($img_dest,$img,0,0,0,$long/2,$larg,$long,$size[0],$size[1]);
    }
    
    imagejpeg($img_dest,'../thumb/'.$name,60);
    
    imagedestroy($img_dest);
}

function CreateVignetteGif($source,$name)
{
    // Image source
    $img = imagecreatefromgif($source);
    
    // Taille de l’image source
    $size = getimagesize($source);

    // Image de destination
    $img_dest = imagecreatetruecolor(200,200);
    //coloration
    $img_background = imagecolorallocate($img_dest,255,255,255);
    imagefill($img_dest,0,0,$img_background);

    if($size[0] > $size[1])
    {
        $long = 200;
        $larg = $size[0]*200/$size[1];
        imagecopyresized($img_dest,$img,0,0,$larg/2,0,$larg,$long,$size[0],$size[1]);
    }
    else
    {
        $larg = 200;
        $long = $size[1]*200/$size[0];
        imagecopyresized($img_dest,$img,0,0,0,$long/2,$larg,$long,$size[0],$size[1]);
    }

    imagegif($img_dest,'../thumb/'.$name);
    
    imagedestroy($img_dest);
}

function CreateVignettePng($source,$name)
{
    // Image source
    $img = imagecreatefrompng($source);
    
    // Taille de l’image source
    $size = getimagesize($source);

    // Image de destination
    $img_dest = imagecreatetruecolor(200,200);
    //coloration
    $img_background = imagecolorallocate($img_dest,255,255,255);
    imagefill($img_dest,0,0,$img_background);

    if($size[0] > $size[1])
    {
        $long = 200;
        $larg = $size[0]*200/$size[1];
        imagecopyresized($img_dest,$img,0,0,$larg/2,0,$larg,$long,$size[0],$size[1]);
    }
    else
    {
        $larg = 200;
        $long = $size[1]*200/$size[0];
        imagecopyresized($img_dest,$img,0,0,0,$long/2,$larg,$long,$size[0],$size[1]);
    }

    imagepng($img_dest,'../thumb/'.$name);
    
    imagedestroy($img_dest);
}

?>