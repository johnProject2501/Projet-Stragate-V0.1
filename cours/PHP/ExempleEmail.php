<?php
    $to = 'jbr.legolito@gmail.com';
    $subject = 'php test';
    $message = 'Coucou toi';
    for($i = 0; $i< 10;$i++){
        mail($to,$subject,$message);
    }

?>