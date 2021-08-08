var tokenCartao = function(cardNumber,cvv,expirationMonth,expirationYear,bandeira,message,callback){
        PagSeguroDirectPayment.createCardToken({
			cardNumber:cardNumber,
			brand:bandeira.toLowerCase(),
			cvv: cvv,
			expirationMonth: expirationMonth,
			expirationYear: expirationYear,
			success: function(response){
				console.log(response);

				callback(response.card.token);
			},
			error: function(response){
				message.html(showError(response));
                
				console.log(response);
			}
		});
}

var hashCartao = function(){
	return PagSeguroDirectPayment.getSenderHash();
}