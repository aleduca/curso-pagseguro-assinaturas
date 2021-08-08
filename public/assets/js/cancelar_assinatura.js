$(document).ready(function(){

    var btn_cancelar = $("#btn-cancelar");
    var message = $("#message");

    btn_cancelar.on('click', function(event){
        event.preventDefault();

        var id_assinatura = $(this).attr('data-id');

        $.ajax({
            url:'../public/ajax/cancelar_assinatura.php',
            type:'post',
            data:'id_assinatura='+id_assinatura,
            dataType:'json',
            beforeSend: function(){
                let mensagemAguarde = "<i class='fa fa-spinner fa-spin fa-1x fa-fw'></i>Aguarde enquanto estamos cancelando sua assinatura";
                message.html('<div class="ui huge info message" style="text-align:center;">'+mensagemAguarde+'</div><br />');
            },
            success: function(retorno){

                if(retorno.error == false){
                    let mensagemSucesso = '<i class="fa fa-check" aria-hidden="true"></i>Você acabou de cancelar a assinatura do portal com sucesso.';
                    message.html('<div class="ui huge success message" style="text-align:center;">'+mensagemSucesso+'</div><br />');
                }

                if(retorno.error == true){
                    message.html(showError(retorno));
                }

                setTimeout(function(){
                    location.reload();
                },3000)

            },
            error: function(error){
                console.log(error);
            }
        });


    });

});