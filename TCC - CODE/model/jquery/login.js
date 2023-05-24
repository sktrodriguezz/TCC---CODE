$("#btnLogin").click(function() {
  var email = $("#email").val();
  var senha = $("#senha").val();
  
  $.ajax({
    url: "api/contato/login.php",
    method: "POST",
    data: {
      email: email,
      senha: senha 
    }
  })
  .done(function(response) {
    if(response.type == "success") {
      window.location = "login.php";
    } else {
      alert(response.mensagem); 
    }
  })
  .fail(function() {
    console.log("Erro ao enviar o formulário!"); 
  });
});