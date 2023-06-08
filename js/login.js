    var btn = document.getElementById('form-submit');
    btn.addEventListener('click', () => {

		var emailjs = document.getElementById('email').value;
		var senhajs = document.getElementById('senha').value;

    if(emailjs == "" || emailjs == null){
      $("#erro-email").html("Email é obrigatório.");
      alert('Preencha todos os campos!')
      return(false);
    }

    if(senhajs == "" || senhajs == null){
      $("#erro-senha").html("Senha é obrigatório.");
      alert('Preencha todos os campos!')
      return(false);
    }
   	return(true);
});
