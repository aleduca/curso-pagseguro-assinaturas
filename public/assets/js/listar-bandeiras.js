$(document).ready(function(){

   var divBandeiras = $("#bandeira"); 
   var divBancos = $(".bancos"); 

   $.ajax({
       url:'public/ajax/id_sessao.php',
       dataType:'json',
       success: function(retorno){

            var idSession = retorno.id;
            PagSeguroDirectPayment.setSessionId(idSession);
            PagSeguroDirectPayment.getPaymentMethods({
                success:function(response){

                    var bancos = '';
                    var bandeiras = '';
                    $.each(response.paymentMethods.CREDIT_CARD.options, function(key,value){
                        if(value.status == 'AVAILABLE'){
                            bandeiras+='<option value="'+value.name+'">'+value.name+'</option>';
                            bancos+= '<div class="two wide column">'+value.name+'<br /> <img src=https://stc.pagseguro.uol.com.br/'+value.images.SMALL.path+' />'+'</div>';
                        }
                    });
                    divBandeiras.html(bandeiras);
                    divBancos.html(bancos);

                },
                error: function(response){
                    console.log(response);
                }

            });


       },
       error: function(error){
           console.log(error.responseText);
       }

   });

});