$(document).ready(function () {
    // Adiciona eventos de mudança e entrada nos elementos de entrada
    $('input[name="filtro"], #filtroInput').on("change input", function () {
        aplicarFiltro();
    });

    $(".excluir-btn").on("click", function () {
        var idPergunta = $(this).data("id");

        if (confirm('Tem certeza que deseja excluir este usuário?')) {
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
                }
            });
        }
    });

    function aplicarFiltro() {
        console.log("Função aplicarFiltro chamada."); // Mensagem de depuração

        var filtro = $('input[name="filtro"]:checked').val();
        var termo = $('#filtroInput').val().toLowerCase();

        // Filtra as linhas da tabela com base na opção selecionada
        $('table tbody tr').each(function () {
            var colunaTexto = '';

            switch (filtro) {
                case 'id':
                    colunaTexto = $(this).find('td:eq(0)').text(); // Coluna ID
                    break;
                case 'autor':
                    colunaTexto = $(this).find('td:eq(1)').text(); // Coluna Autor
                    break;
                case 'tema':
                    colunaTexto = $(this).find('td:eq(4)').text(); // Coluna Tema
                    break;
                case 'status':
                    colunaTexto = $(this).find('td:eq(5)').text(); // Coluna Status
                    break;
            }

            // Verifica se as letras iniciais correspondem ao termo digitado
            if (colunaTexto.toLowerCase().startsWith(termo)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    }
});

function limparFiltro() {
    // Limpa o campo de entrada
    $('#filtroInput').val('');

    // Exibe todas as linhas da tabela
    $('table tbody tr').show();
}
