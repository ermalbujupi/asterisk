var names = {};
var products = null;
var productsSell = [];
var count = 0;
$(function(){

    $('#master_sell').on('click',function(){
        ajax('GET','/home/get_products','',getNames,'');
    });


    $('.autocomplete').on('click',function(){

        $('input.autocomplete').autocomplete({
            data:names,
            limit: 20, // The max amount of results that can be shown at once. Default: Infinity.
            onAutocomplete: function(val) {

                for(var i = 0; i< products.length ; i++){
                    if(products[i].name == val){
                        $('#master_price').val(products[i].price_sold);
                        $('#master_quantity').focus();
                    }
                }

            },
            minLength: 1, // The minimum length of the input for the autocomplete to start. Default: 1.
        });
    });


    $('#final_sell').on('click',function(){
        var final = [];

        for(var i = 0; i< productsSell.length; i++){
            final.push(productsSell[i].id+';'+productsSell[i].price_sold+';'+productsSell[i].quantity)
        }

        ajax('POST','/stock/sell_product','products='+final+'&total='+parseFloat($('#total').text()),productSold,'');
    });

    $('#master_quantity').on('keypress',function(e){
        if(e.keyCode == 13){
            var val = $('.autocomplete').val();
            var quantity = $(this).val();

            for(var i = 0; i< products.length ; i++){
                if(products[i].name == val){

                    $('#master_price').val(products[i].price_sold);

                    if(!existsInSell(products[i],quantity)){
                        $('#master_sell_body').append(
                            '<tr class="none-top-border">'
                            +'<td>'+products[i].id+'</td>'
                            +'<td>'+products[i].name+'</td>'
                            +'<td>'+products[i].brand+'</td>'
                            +'<td>'+products[i].category+'</td>'
                            +'<td>'+products[i].price+'</td>'
                            +'<td>'+products[i].price_sold+'</td>'
                            +'<td>'+quantity+'</td>'
                            +'<td>'
                            +'<a id="'+products[i].id+'"  href="#" class="btn btn-floating tooltipped waves-effect waves-light red action_button tooltipped remove_sell" data-tooltip="Delete Product" data-position="top"><span class="fa fa-times"></span></a>'

                            +'</td>'
                            +'</tr>');
                        var newProduct = {id:products[i].id, name:+products[i].name, category:products[i].category, price:products[i].price,price_sold:products[i].price_sold,quantity:quantity};
                        productsSell.push(newProduct);

                        if(count == 0){
                            $('#total').text(products[i].price_sold*products[i].quantity);
                            count++;
                        }else{
                            $('#total').text(parseFloat($('#total').text())+(products[i].price_sold*products[i].quantity));
                        }
                    }else{
                        return false;
                    }

                }
            }
            clear();
        }

    });

    $('#master_sell_body').on('click','.remove_sell',function(){

        var id = $(this).attr('id');


        $('#master_sell_body tr').each(function(){

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

function clear(){
    $('#master_price').val("");
    $('#master_quantity').val("");
    $('.autocomplete').val("");
    $('.autocomplete').focus();
}

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

function existsInSell(obj,quantity){
    var value = 0;
    for(var i =0; i< productsSell.length ; i++){
        if(obj.id == productsSell[i].id ){
            quantity = parseInt(quantity);
            value = (parseInt(productsSell[i].quantity)+parseInt(quantity));
            if( value<= parseInt(obj.quantity)){

                $('#master_sell_body tr').each(function(){

                    if($(this).find('td:first-child').text() == obj.id){
                        $(this).find('td:nth-child(7)').text(value)
                        productsSell[i].quantity = value;
                        clear();
                    }
                });
            }else{
                Materialize.toast('You dont have '+value+' '+obj.name+' in your stock',3000,'red');
                clear();
                return true;
            }
            return true;
        }
    }
    return false;
}