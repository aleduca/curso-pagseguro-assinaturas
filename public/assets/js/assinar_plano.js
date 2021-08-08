$(document).ready(function(){

	var cardNumber = $("#numero").val();
	var cvv = $("#cvv").val();
	var expirationMonth = $("#validade-mes").val();
	var expirationYear = $("#validade-ano").val();
	var btn_assinar = $("#btn-assinar");
	var message = $("#message");

	var fecharPedido = function(token){
		var hash = hashCartao(); 
		var plano_escolhido = $("input[name=plano]:checked").val();

		$.ajax({
			url:'public/ajax/assinar.php',
			type:'post',
			data:'plano='+plano_escolhido+'&token='+token+'&hash='+hash,
			dataType:'json',
			beforeSend: function(){
				let mensagemAguarde = "<i class='fa fa-spinner fa-spin fa-1x fa-fw'></i> Aguarde enquanto verificamos os dados do seu cartão de crédito !!!";
				message.html('<div class="ui huge info message" style="text-align:center;">'+mensagemAguarde+'</div><br />');
			},
			success: function(retorno){
                console.log(retorno);
                if(retorno == 'jaassinado'){
                    swal("Erro", "Você já tem uma assinatura em nosso portal, verifique se a mesma está suspensa e reative, caso queira uma nova assinatura cancele a mesma", "info");
                }

                if(retorno == 'assinou'){
                    swal("Aprovado", "Agora você já tem uma assinatura conosco", "success");
                    setTimeout(function(){
                        location.reload();
                    },3000)
                }

                if(retorno.error){
				    message.html(showError(retorno));
                }
			},
			error: function(retorno){
				message.html(showError(retorno));
				console.log(retorno.responseText);
			}
		});
	};

	btn_assinar.on('click', function(event){
		event.preventDefault();
		var bandeira = $("#bandeira").val();
		tokenCartao(cardNumber, cvv, expirationMonth, expirationYear,bandeira,message,fecharPedido);
	});

});