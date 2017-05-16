
$(document).ready(function(){

    $('.reponse').hide();

//methode 1
    $("form1").submit(function(){
        event.preventDefault();

            $('.reponse').show();

            if ($(':radio[id="0"]:checked').val()) {

                $('#q1').css('color', 'green');
            }
            else {

                $('#q1').css('color', 'red');
            }

            if ($(':radio[id="1"]:checked').val()) {

                $('#q2').css('color', 'green');
            }
            else {

                $('#q2').css('color', 'red');
            }

            if ($(':radio[id="2"]:checked').val()) {

                $('#q3').css('color', 'green');
            }
            else {

                $('#q3').css('color', 'red');
            }

    });

//methode 2

    $("form2").submit(function(){
        event.preventDefault();
         var tabjuste=['0','1','2'];

        $('.reponse').show();

        for(var i=0 ; i < tabjuste.length ; i++){
            if ($(':radio[id="'+i+'"]:checked').val()) {

                $('#q'+i).css('color', 'green');
            }
            else {

                $('#q'+i).css('color', 'red');
            }
        }




    });

//methode 3

    $(document).ready(function(){
        var reponses = ["0","1","2"];
        $('form').on ('submit',function(evt){
            evt.preventDefault();
            $('fieldset').each(function(index){
                if($(this).find('input:checked').attr('id') === reponses[index]){
                    $(this).css('border-color','#0f0');
                } else {
                    $(this).css('border-color','#f00').find('.reponse').show();
                }
            })
        });
    })


});




