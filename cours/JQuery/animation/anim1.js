



$(document).ready(function(){
    $('#html').click(function(e){

        var offset=$(this).offset();
        var destY = e.pageY-offset.left-50;
        var destX = e.pageX-offset.top-50;

        destX=Math.min(Math.max(parseInt(destX),0),700);
        destY=Math.min(Math.max(parseInt(destY),0),700);




        $('#moving').animate({left:destX, top:destY},{duration:1000, queue:true});






    });
});