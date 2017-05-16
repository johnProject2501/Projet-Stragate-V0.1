<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Document sans titre</title>
</head>

<body>


<form method="post" action="#" enctype="application/x-www-form-urlencoded">
    <fieldset>
        <legend>Calculez votre IMC</legend> 
        <label for="element">element </label><input type="text" name="element" id="Poids" placeholder="50kg"  /> <br>
        <input type="submit" name="send" value="valider"/>
        <input type="reset" name="reset" value="Reset"/>
    </fieldset>
</form>
    
    <select>
    <?php

 $ville=$_POST['element'].PHP_EOL;
    
    $f=fopen('info.txt','a');
    fwrite($f,'<option>'.$ville.'</option>');
    fclose($f);
        
        
    if(file_exists('info.txt')){
         $texte=file_get_contents('info.txt');
    echo($texte);
    }
   
    
    ?>  
    </select>
<a href="info.txt">lire le fichier <a>

</body>
</html>