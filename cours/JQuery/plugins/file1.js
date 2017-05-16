/*(function ($){
    $.fn.souligne=function(option){
        return this.each(function(){
            $(this).css('text-decoration','underline');
        })
    }

}(jquery));


function superHover(){

}*/









$(document).ready(function () {
    $('#img1').hover(function () {
        $(this).stop().animate({
            opacity: .4
        }, 200);
        $('.text').removeClass('hide');
    }, function () {
        $(this).stop().animate({
            opacity: 1
        }, 500);
        $('.text').addClass('hide');
    });

    $('#img2').hover(function () {
       var texte= $("#img2").attr("alt");
        console.log(texte);
        $(this).stop().animate({
            opacity: .4
        }, 200);
        $('.caption').html(texte);
    }, function () {
        var texte='';
        $(this).stop().animate({
            opacity: 1
        }, 500);
        $('.caption').html(texte);
    });





});


// Correction

    (function ($){
        $.fn.superhover=function(options){
            var defaut ={
                duration:400,
                overlaycolor: rgba(0,0,0,0.5)
            }

            $.extend(options,useroption);

            return this.each(function(){
                $(this).wrap('<div class="superhoverContainer"></div>');
                $(this).insertBefore('<div class="superhoveroverlay"></div>');
                $(this).insertBefore('<div class="superhovercaption"'+$(this).alt('alt')+'</div>')
            })
        }
    });













