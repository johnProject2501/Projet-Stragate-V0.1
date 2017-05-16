$(function(){
    var products=[];
    $.ajax({
        url:"Json.json",
        method:'get',
        succes:function(data){
            products=data.products;
            init();
        }
    })
})

function init(){
   $('form').submit()(function(evt){
       evt.preventDefault();
       showFilteredList();
   });
    showFilteredList();
}

function showFilteredList(){
    var filteredProducts= $.grep(producs,function(item,index){
        var searchString=$('#search').val();
        var minprice= ($('#min').val()!='')?parseInt($('#min').val()):0;
        var maxprice= ($('#max').val()!='')?parseInt($('#max').val()):Number.POSITIVE_INFINITY;
        if(item.titre.indexOf(searchString)!=-1 && item.prix >=minprice && item.prix<=maxprice){
            return true;
        }
        return false;
    });
    if(filteredProducts.length===0){
        $('#products').html('<p>Aucun produit trouvé</p>');

    }
    else{
        var html='<ul>'
        for (var i =0; i < filteredProducts.length; i++){
            var product= filteredProducts[i];
            html+='<li>'+product.titre+': '+product.prix+' €</li>';
        }
        html+='</ul>'
        $('#products').html(html);
    }
}