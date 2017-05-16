<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Document sans titre</title>
</head>

<body>

<select>
<?php
$year= date('Y');

    for($i= 1900 ; $i<=$year;$i++){
        echo '<option>'.$i .'</option>';
    }
    
    ?>
    </select>
    
    
<?php
    echo('<hr>');
    echo date('<p>Y-m-d</p>');
    echo date('<p>H:i</p>');
    echo('<hr>');
    
    $tableau = array('Toulouse','Albi','Paris','Auch');
    foreach($tableau as $val){
        echo($val.PHP_EOL);
    }
    
    ?>
</body>
</html>