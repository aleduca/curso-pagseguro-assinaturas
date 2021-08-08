$(document).ready(function(){

    var btn_criar_plano = $("#btn-criar-plano");

    btn_criar_plano.on('click', function(event){
        event.preventDefault();
        
        $.ajax({
            url:'public/ajax/criar_plano.php',
            dataType:'json',
            success:function(retorno){
                console.log(retorno);

                if(retorno == 'criado'){
                    swal("Plano Criado", "Você criou o plano com sucesso", "success");
                }

                if(retorno == 'erroPlano'){
                    swal("Erro", "Erro ao cadastrar o plano no banco de dados", "warning");
                }

                if(retorno == 'erroCode'){
                    swal("Erro", "Erro ao cadastrar o gerar o codigo do plano", "warning");
                }

            },
            error: function(retorno){
                console.log(retorno);
            }
        });

    });

});