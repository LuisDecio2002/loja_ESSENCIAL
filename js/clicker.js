//função que controla clique no login e exibe erro com caixa de alerta
$(document).ready(function(){
	$("#topo-login").on("click", function MalFunc(){
		alert ("Estamos sob manutenção, então não é possível fazer login ou cadastro no momento. Tente novamente mais tarde");
  });

	//função que controla o click em "efetuar compra"
	$("#botaoComprar").on("click", function ErroCompra(){
		alert ("Erro ao confirmar a compra.\n \
				Por favor, tente novamente mais tarde.");
  });
});
