console.log("Modal.js loaded");


$(document).ready(function () {
    $(".detalhes-btn").on("click", function () {
        var idPergunta = $(this).data("id");

        // Faz uma solicitação AJAX para obter os detalhes da pergunta
        $.ajax({
            url: "Controllers/obterDetalhesPergunta.php",
            method: "POST",
            data: { idPergunta: idPergunta },
            dataType: "json",
            success: function (data) {
                // Verifica se há detalhesPergunta na resposta
                if ('detalhesPergunta' in data) {
                    // Exibe os detalhes no modal
                    exibirDetalhesPergunta(data.detalhesPergunta);
                } else if ('idPerguntas' in data) {
                    // Se não houver 'detalhesPergunta', mas houver 'idPerguntas', assume-se que é um único detalhe
                    exibirDetalhesPergunta(data);
                } else {
                    console.error("Resposta do servidor não contém detalhesPergunta.");
                }
            },
            error: function (error) {
                console.error("Erro ao obter detalhes da pergunta: ", error);
            }
        });
    });

    $(".close").on("click", function () {
        $("#myModal").hide();
    });
});

function exibirDetalhesPergunta(detalhes) {
    // Preenche o modal com os detalhes
    $("#detalhe-id").text(detalhes.idPerguntas);
    $("#detalhe-autor").text(detalhes.Autor);
    $("#detalhe-conteudo").text(detalhes.ConteudoPergunta);
    $("#detalhe-resposta").text(detalhes.Resposta);
    $("#detalhe-status").text(detalhes.Status);
    $("#detalhe-data").text(detalhes.DataSubmissao);
    $("#detalhe-atualizacao").text(detalhes.UltimaAtualizacao);

    // Abre o modal
    $("#myModal").show();
}
