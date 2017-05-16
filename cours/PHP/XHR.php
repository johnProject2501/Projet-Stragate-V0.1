<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>

<?php
$fruit='pommes,kiwis,orange';
$liquides="eau,vin,biere";
if(isset($_GET['param'])){
    if($_GET['param']=='fruits'){
        echo $fruit;

    }
    if($_GET['param']=='liquides'){
        echo $liquides;
    }

}
?>
<button type="button" data-cat="fruits">fruit</button>
<button type="button" data-cat="liquides">liquides</button>
<div id="result"></div>


<script>
    var btns =document.querySelectorAll('.btnForCat');

    for (var i= 0; i=btns.length;i++){
        btns[i].addEventListener('click',function(evt){
            getData(evt.target.getAttribute('data-cat'));
        })
        for(var prop in evt){
            console.log(prop);
        }
    }

    function getData(category){
        var xhr= new XMLHttpRequest();
        xhr.open('GET','http://projet2501.esy.es/PHP/XHR.php?param'+category);
        xhr.addEventListener('readystatechange',function(){
            if(xhr.readyState===XMLHttpRequest.DONE && xhr.status===200){
                var resultContainer= document.getElementById('result');
                resultContainer.innerHTML= xhr.response;
            }
        });
        xhr.send(null);
    }


    var test= {a:3}=={a:3};
    console.log(test);

    var test2= {a:3}==={a:3};
    console.log(test2);
</script>

</body>
</html>
