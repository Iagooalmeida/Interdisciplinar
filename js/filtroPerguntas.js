$(document).ready(function () {
  // Adiciona eventos de mudança e entrada nos elementos de entrada
  $('input[name="filtro"], #filtroInput, #visualizacao').on("change input", function () {
      aplicarFiltro();
  });

  $(".excluir-btn").on("click", function () {
      var idPergunta = $(this).data("id");

      if (confirm("Tem certeza que deseja excluir este usuário?")) {
          $.ajax({
              url: "Controllers/excluir_Pergunta.php",
              method: "POST",
              data: { acao: "excluir", id: idPergunta },
              success: function (data) {
                  // Faça algo após a exclusão, se necessário
                  console.log(data);
                  // Recarregar a página ou atualizar a lista, por exemplo
                  location.reload();
              },
              error: function (error) {
                  console.error("Erro ao excluir: ", error);
              },
          });
      }
  });

  function aplicarFiltro() {
      var filtro = $('input[name="filtro"]:checked').val();
      var termo = $("#filtroInput").val().toLowerCase();
      var visualizacao = $("#visualizacao").val();

      // Filtra as linhas da tabela com base na opção selecionada
      $("table tbody tr").each(function () {
          var colunaTexto = "";

          switch (filtro) {
              case "id":
                  colunaTexto = $(this).find("td:eq(0)").text(); // Coluna ID
                  break;
              case "autor":
                  colunaTexto = $(this).find("td:eq(2)").text(); // Coluna Autor
                  break;
              case "pergunta":
                  colunaTexto = $(this).find("td:eq(3)").text(); // Coluna Pergunta
                  break;
              case "tema":
                  colunaTexto = $(this).find("td:eq(5)").text(); // Coluna Tema
                  break;
              case "status":
                  colunaTexto = $(this).find("td:eq(6)").text(); // Coluna Status
                  break;
          }

          // Remove espaços em branco extras no início e no final
          colunaTexto = colunaTexto.trim();
          termo = termo.trim();

          // Verifica se o termo de pesquisa está contido em qualquer parte da string
          if (contemTermo(colunaTexto, termo) && atendeCondicaoVisualizacao($(this), visualizacao)) {
              $(this).show();
          } else {
              $(this).hide();
          }
      });
  }

  // Função para verificar se um termo está contido em qualquer parte da string
  function contemTermo(texto, termo) {
      return texto.toLowerCase().includes(termo);
  }

  // Função para verificar a condição de visualização selecionada
  function atendeCondicaoVisualizacao(elemento, condicao) {
      switch (condicao) {
          case "atual":
              return true; // Sem alteração na visualização padrão
          case "internas":
              return elemento.find("td:eq(1)").text().toLowerCase() === "interna"; // Mostra apenas perguntas internas
          case "externas":
              return elemento.find("td:eq(1)").text().toLowerCase() === "visitante"; // Mostra apenas perguntas externas
          case "aprovadas":
              return elemento.find("td:eq(6)").text().toLowerCase() === "aprovado"; // Mostra apenas as perguntas aprovadas
          case "pendentes":
              return elemento.find("td:eq(6)").text().toLowerCase() === "pendente"; // Mostra apenas as perguntas pendentes
          default:
              return true;
      }
  }

  // Restante do seu código...

  function limparFiltro() {
      // Limpa o campo de entrada
      $("#filtroInput").val("");

      // Limpa a seleção da caixa de visualização
      $("#visualizacao").val("atual");

      // Exibe todas as linhas da tabela
      $("table tbody tr").show();
  }
});
