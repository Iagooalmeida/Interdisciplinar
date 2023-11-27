<?php

class Pagination {
    private $totalRegistros;
    private $registrosPorPagina;
    private $paginasTotais;
    private $paginaAtual;

    public function __construct($totalRegistros, $registrosPorPagina) {
        $this->totalRegistros = $totalRegistros;
        $this->registrosPorPagina = $registrosPorPagina;
        $this->paginasTotais = ceil($totalRegistros / $registrosPorPagina);
        $this->paginaAtual = $this->obterPaginaAtual();
    }

    public function obterPaginaAtual() {
        if (isset($_GET['pagina']) && is_numeric($_GET['pagina'])) {
            $pagina = (int)$_GET['pagina'];

            if ($pagina > 0 && $pagina <= $this->paginasTotais) {
                return $pagina;
            }
        }

        return 1;
    }

    public function criarLinks() {
        $html = '<div class="pagination">';
        $html .= '<span>Página ' . $this->paginaAtual . ' de ' . $this->paginasTotais . '</span>';

        if ($this->paginasTotais > 1) {
            $html .= '<a href="?pagina=1">&laquo; Primeira</a>';

            for ($i = max(1, $this->paginaAtual - 2); $i <= min($this->paginaAtual + 2, $this->paginasTotais); $i++) {
                $html .= '<a href="?pagina=' . $i . '"';
                if ($i == $this->paginaAtual) {
                    $html .= ' class="active"';
                }
                $html .= '>' . $i . '</a>';
            }

            $html .= '<a href="?pagina=' . $this->paginasTotais . '">Última &raquo;</a>';
        }

        $html .= '</div>';

        return $html;
    }

    public function getPaginaAtual() {
        return $this->paginaAtual;
    }
}

?>
