/**
$(selector css).eq(x)
               .get(x)


 $(selector css).css('width',50).append....

 foreach=each en Jquery
 $('button.maclass').on('click',function(evt){
    $.getJson(....)
    });




 $(selector).css({width:140, background:.... ,.. );


 $(s).width(140px);
     .innerwidth();
     .outerwidth(true);


 $(s).addClass(' ');
     .removeClass(' ');
     .toggleClass(' ');
     .hasClass(' ');

 $(s).val();
     .prop();
     .text();
     .html();


$(parent).sibling
         .parent



         $(   ).offset().top
                        .left



.animate({height:130, top 25},{options})


rajouter du contenu
    $(selector).append(a la fin)
               .prepend(au debut)
               .before(avant l'element)
               .after(apres l'element)



remplacer un element
    $(selector).replacewith('texte ici');

inserer element html

    $(selector).appendto(selector)
               .prependto(selector)
               .insertbefore(selector)
               .insertafter(selector)

cloner element
               $('selector').clone()
               $('sel').clone().insertbefore('  ')



encercler element exterieur
    $(selector)wrap.('<p></p>'>
               wrapall

encercler element interieur
     $(selector)wrapinner.('<p></p>'>


supprimer element du DOM
    $(selector)remove()


forcer un evenement (trigger)
    $(window).trigger('resize')



objet ajax
    $.ajax({
        url:'/ajax.php,
        data:'val1=32&val2=abc,
        method:'POST'/'GET';
        succes:function(data){}
        error:function(xhr,Error,Error){}
     });



load (url)
getJSON(url)
    Json.parse(str);
    Json.strongly(objet);
 */
