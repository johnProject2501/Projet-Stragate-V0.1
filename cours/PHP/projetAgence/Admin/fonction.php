<?php



function DateCreate($param){



    echo '<select name="'.$param.'day">';
    $nbjour=31;
    for($i=1;$i<=$nbjour;$i++){

        echo '<option value="'.$i.'">'.sprintf("%02d", $i).'</option>';
    }
    echo '</select>';


    echo '<select name="'.$param.'month">';
    $mois=12;
    for($i=1;$i<=$mois;$i++){
        switch($i){
            case 1:
                echo '<option value="'.$i.'">Janvier</option>';
                break;
            case 2:
                echo '<option value="'.$i.'">Fevrier</option>';
                break;
            case 3:
                echo '<option value="'.$i.'">Mars</option>';
                break;
            case 4:
                echo '<option value="'.$i.'">Avril</option>';
                break;
            case 5:
                echo '<option value="'.$i.'">Mai</option>';
                break;
            case 6:
                echo '<option value="'.$i.'">Juin</option>';
                break;
            case 7:
                echo '<option value="'.$i.'">Juillet</option>';
                break;
            case 8:
                echo '<option value="'.$i.'">Août</option>';
                break;
            case 9:
                echo '<option value="'.$i.'">Septembre</option>';
                break;
            case 10:
                echo '<option value="'.$i.'">Octobre</option>';
                break;
            case 11:
                echo '<option value="'.$i.'">Novembre</option>';
                break;
            case 12:
                echo '<option value="'.$i.'">Décembre</option>';
                break;

        }

    }
    echo '</select>';



    $year= date('Y');
    echo '<select name="'.$param.'year">';
    for($i= $year ; $i<=($year+10);$i++){
        echo '<option value="'.$i.'">'.$i .'</option>';
    }
    echo '</select>';





}



function CreateVignetteJpeg($source,$name){
    //image source
    $img= imagecreatefromjpeg($source);

    //taille de l'image
    $size= getimagesize($source);

    //image de destination
    $img_dest= imagecreatetruecolor(200,200);

    //creation couleur et remplissage de la zone en blanc
    $img_background=imagecolorallocate($img_dest,255,255,255);
    imagefill($img_dest,0,0,$img_background);

    if($size[0]>$size[1]){
        $long=200;
        $larg=$size[0]*200/$size[1];
        imagecopyresized($img_dest,$img,0,0,$larg/2,0,$larg,$long,$size[0],$size[1]);
    }
    else{
        $larg=200;
        $long=$size[1]*200/$size[0];
        imagecopyresized($img_dest,$img,0,0,0,$long/2,$larg,$long,$size[0],$size[1]);
    }
    imagejpeg($img_dest,'../thumb/'.$name,60);

    imagedestroy($img_dest);
}

function CreateVignetteGif($source,$name){
    //image source
    $img= imagecreatefromgif($source);

    //taille de l'image
    $size= getimagesize($source);

    //image de destination
    $img_dest= imagecreatetruecolor(200,200);

    //creation couleur et remplissage de la zone en blanc
    $img_background=imagecolorallocate($img_dest,255,255,255);
    imagefill($img_dest,0,0,$img_background);

    if($size[0]>$size[1]){
        $long=200;
        $larg=$size[0]*200/$size[1];
        imagecopyresized($img_dest,$img,0,0,$larg/2,0,$larg,$long,$size[0],$size[1]);
    }
    else{
        $larg=200;
        $long=$size[1]*200/$size[0];
        imagecopyresized($img_dest,$img,0,0,0,$long/2,$larg,$long,$size[0],$size[1]);
    }
    imagegif($img_dest,'../thumb/'.$name);

    imagedestroy($img_dest);
}

function CreateVignettePng($source,$name){
    //image source
    $img= imagecreatefrompng($source);

    //taille de l'image
    $size= getimagesize($source);

    //image de destination
    $img_dest= imagecreatetruecolor(200,200);

    //creation couleur et remplissage de la zone en blanc
    $img_background=imagecolorallocate($img_dest,255,255,255);
    imagefill($img_dest,0,0,$img_background);

    if($size[0]>$size[1]){
        $long=200;
        $larg=$size[0]*200/$size[1];
        imagecopyresized($img_dest,$img,0,0,$larg/2,0,$larg,$long,$size[0],$size[1]);
    }
    else{
        $larg=200;
        $long=$size[1]*200/$size[0];
        imagecopyresized($img_dest,$img,0,0,0,$long/2,$larg,$long,$size[0],$size[1]);
    }
    imagepng($img_dest,'../thumb/'.$name);

    imagedestroy($img_dest);
}

?>