$(document).ready(function(){

    var inputNumero = $("input#numero");
    var divBandeiras = $("#bandeira");

    var pegarBandeira = function(){
        PagSeguroDirectPayment.getBrand({
            cardBin:inputNumero.val(),
            success:function(response){
                bandeira = response.brand.name;
                divBandeiras.html('<option value='+response.brand.name+'>'+bandeira.toUpperCase()+'</option>');
            },
            error:function(response){
                console.log(response);
            }
        });
    };

    inputNumero.keyup(function(){
        pegarBandeira();
    });

});