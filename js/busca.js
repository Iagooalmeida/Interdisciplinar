$(document).ready(function () {
  $("#busca").on("input", buscarProdutos);

  function buscarProdutos() {
    var termo = $("#busca").val();

    $.ajax({
      type: "POST",
      url: "busca_perguntas.php",
      data: { termo: termo },
      success: function (response) {
        $("#resultado").html(response);

        if (termo.length > 0) {
          $("#resultado").show();
          $("#resultado").css(
            "width",
            "100%",
            "border-radius",
            "var(--radius)",
            "background-color",
            "var(--grey-1)",
            "--arrow-translate",
            "-50%",
            "--arrow-rotation",
            "45deg"
          );
          $("#resultado").nextAll().hide();
        } else {
          $("#resultado").hide();
          $("#resultado").nextAll().show();
        }
      },
    });
  }
});
