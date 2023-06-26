function storeFormData() {
    // Obter os valores dos campos do formulário
    const nome = document.getElementById("nome").value;
    const email = document.getElementById("email").value;
    const phone = document.getElementById("phone").value;
    const message = document.getElementById("message").value;

     // Verificar se algum campo está vazio
  if (nome === "" || email === "" || phone === "" || message === "") {
    alert("Por favor, preencha todos os campos do formulário.");
    return;
  }

  
    // Criar um objeto com os dados do formulário
    const formData = {
      nome: nome,
      email: email,
      phone: phone,
      message: message
    };

    // Exibir a mensagem de confirmação
    alert("Enviado com sucesso!!!");
  
    // Obter os dados armazenados anteriormente do local storage
    const storedData = JSON.parse(localStorage.getItem("formData")) || [];
  
    // Adicionar os novos dados ao array existente
    storedData.push(formData);
  
    // Armazenar os dados atualizados no local storage
    localStorage.setItem("formData", JSON.stringify(storedData));
  
    // Limpar os campos do formulário
    document.getElementById("myForm").reset();
  }
  
  
    // Redirecionar para a página da tabela
    // window.location.href = "pag_lista_sugestao.html";

  