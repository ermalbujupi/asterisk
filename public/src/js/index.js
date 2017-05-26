var names = {};
var products = null;
var productsSell = [];
var count = 0;
$(function(){

    ajax('GET','/home/get_products','',getNames,'');

    $('.autocomplete').on('click',function(){
        $('input.autocomplete').autocomplete({
            data:names,
            limit: 20, // The max amount of results that can be shown at once. Default: Infinity.
            onAutocomplete: function(val) {

                for(var i = 0; i< products.length ; i++){
                    if(products[i].name == val){
                        $('#price').val(products[i].price_sold);
                    }
                }

            },
            minLength: 1, // The minimum length of the input for the autocomplete to start. Default: 1.
        });
    });


    $('#master_sell').on('click',function(){
        var final = [];

        for(var i = 0; i< productsSell.length; i++){
            final.push(productsSell[i].id+';'+productsSell[i].price_sold+';'+productsSell[i].quantity)
        }

        ajax('POST','/stock/sell_product','products='+final+'&total='+parseFloat($('#total').text()),productSold,'');
    });

    $('#quantity').on('keypress',function(e){
        if(e.keyCode == 13){
            var val = $('.autocomplete').val();
            var quantity = $(this).val();

            for(var i = 0; i< products.length ; i++){
                if(products[i].name == val){

                    $('#price').val(products[i].price_sold);

                    if(existsInSell(products[i])){
                        Materialize.toast('Product already added',3000,'red');
                        return false;
                    }

                    if(quantity > products[i].quantity){
                        Materialize.toast('You dont have '+quantity+' '+products[i].name+" in your stock",3000,'red');
                        return false ;
                    }



                    $('#sell_body').append(
                        '<tr class="none-top-border">'
                        +'<td>'+products[i].id+'</td>'
                        +'<td>'+products[i].name+'</td>'
                        +'<td>'+products[i].brand+'</td>'
                        +'<td>'+products[i].category+'</td>'
                        +'<td>'+products[i].price+'</td>'
                        +'<td>'+products[i].price_sold+'</td>'
                        +'<td>'+products[i].quantity+'</td>'
                        +'<td>'
                        +'<a id="'+products[i].id+'"  href="#" class="btn btn-floating tooltipped waves-effect waves-light red action_button tooltipped remove_sell" data-tooltip="Delete Product" data-position="top"><span class="fa fa-times"></span></a>'

                        +'</td>'
                        +'</tr>')

                    productsSell.push(products[i]);

                    if(count == ''){
                        $('#total').text(products[i].price_sold*products[i].quantity);
                        count++;
                    }else{
                        $('#total').text(parseFloat($('#total').text())+(products[i].price_sold*products[i].quantity));
                    }
                }
            }
        }
    });

    $('#sell_body').on('click','.remove_sell',function(){

        var id = $(this).attr('id');


        $('#sell_body tr').each(function(){

            if($(this).find('td:first-child').text() == id){
                $(this).remove();

                for(var i = 0; i< productsSell.length; i++){
                    if(productsSell[i].id == id){

                        $('#total').text(parseFloat($('#total').text())-(products[i].price_sold*products[i].quantity));

                        var index = productsSell.indexOf(productsSell[i]);
                        if(index > -1){
                            productsSell.splice(index,1);
                        }

                    }
                }
            }
        });


    });


});

function productSold(params,success,responseObj){
    if(success){
        Materialize.toast(responseObj.message,3000,'green');
        location.reload();
    }else{
        Materialize.toast(responseObj.message,3000,'red');
    }
}

function getNames(params,success,responseObj){

    if(success){

        products = responseObj.products;

        for(var i =0 ; i< products.length ; i++){
            names[''+products[i].name+''] = null;
        }

    }
}

function existsInSell(obj){

    for(var i =0; i< productsSell.length ; i++){
        if(obj.id == productsSell[i].id ){
            return true;
        }
    }
        return false;
}