// Obter os dados armazenados no local storage
const storedData = JSON.parse(localStorage.getItem("formData")) || [];

// Criar as linhas da tabela com os dados armazenados
const table = document.getElementById("dataTable").getElementsByTagName("tbody")[0];

storedData.forEach(function(data, index) {
  const newRow = table.insertRow();
  newRow.setAttribute("data-index", index);

  const nomeCell = newRow.insertCell();
  const emailCell = newRow.insertCell();
  const phoneCell = newRow.insertCell();
  const messageCell = newRow.insertCell();
  const actionCell = newRow.insertCell();

  nomeCell.textContent = data.nome;
  emailCell.textContent = data.email;
  phoneCell.textContent = data.phone;
  messageCell.textContent = data.message;

  const deleteButton = document.createElement("button");
  deleteButton.textContent = "Excluir";
  deleteButton.addEventListener("click", function() {
    // Obter o índice da linha selecionada
    const rowIndex = this.parentNode.parentNode.getAttribute("data-index");

    // Remover a linha da tabela
    table.deleteRow(rowIndex);

    // Remover o item correspondente dos dados armazenados
    storedData.splice(rowIndex, 1);

    // Atualizar os dados no local storage
    localStorage.setItem("formData", JSON.stringify(storedData));
  });

  actionCell.appendChild(deleteButton);
});
