var errorsCode = {
	10001:'O cartão escolhido nao bate com os números dados !!',
	10000:'Escolha um cartão de crédito válido !!',
	17061:'Escolha um plano !!',
    17022:'O plano já foi cancelado !!',
    17079: 'O limite de alunos para esse plano já está completo !!'
};

var showError = function(error){
	let errors = error.errors;
	let errorsFound;

	$.each(errors, function(key, value){
		errorsFound = errorsCode[key];
	});

	return '<div class="ui huge negative message" style="text-align:center">'+errorsFound+'</div><br />';

}