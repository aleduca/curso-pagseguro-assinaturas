$(document).ready(function(){

    var btn_reativar = $("#btn-reativar");
    var btn_suspender = $("#btn-suspender");
    var message = $("#message");

    btn_suspender.on('click', function(event){
        event.preventDefault();
       
        var id_assinatura = $(this).attr('data-id');

        $.ajax({
            url:'../public/ajax/suspender_ativar_assinatura.php',
            type:'post',
            dataType:'json',
            data:'id_assinatura='+id_assinatura+'&status=SUSPENDED',
            beforeSend: function(){
            let mensagemAguarde = "<i class='fa fa-spinner fa-spin fa-1x fa-fw'></i>Aguarde enquanto atualizamos sua assinatura !!!";
            message.html('<div class="ui huge info message" style="text-align:center;">'+mensagemAguarde+'</div><br />');
            },
            success: function(retorno){

                console.log(retorno);

                if(retorno.error == true){
                    message.html(showError(retorno))
                }

                if(retorno.status == 'ok'){
                    message.html("<div class='ui huge warning message' style='text-align:center;''><i class='fa fa-check' aria-hidden='true'></i> Sua assinatura foi suspensa, para reativar clique no botão reativar conta.</div><br />");
                }

                setTimeout(function(){
                    location.reload();
                },3000);
            }
        });
    });

    btn_reativar.on('click', function(event){
        event.preventDefault();
       
        var id_assinatura = $(this).attr('data-id');

        $.ajax({
            url:'../public/ajax/suspender_ativar_assinatura.php',
            type:'post',
            dataType:'json',
            data:'id_assinatura='+id_assinatura+'&status=ACTIVE',
            beforeSend: function(){
            let mensagemAguarde = "<i class='fa fa-spinner fa-spin fa-1x fa-fw'></i>Aguarde enquanto atualizamos sua assinatura !!!";
            message.html('<div class="ui huge info message" style="text-align:center;">'+mensagemAguarde+'</div><br />');
            },
            success: function(retorno){

                console.log(retorno);

                if(retorno.error == true){
                    message.html(showError(retorno))
                }

                if(retorno.status == 'ok'){
                    message.html("<div class='ui huge success message' style='text-align:center;''><i class='fa fa-check' aria-hidden='true'></i> Sua assinatura foi reativada com sucesso.</div><br />");
                }

                setTimeout(function(){
                    location.reload();
                },3000);
            }
        });
    });

});