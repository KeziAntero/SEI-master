<?php

namespace Ifnc\Tads\Controller;

use Ifnc\Tads\Helper\SelectPro;
use Ifnc\Tads\Entity\Turma;
use Ifnc\Tads\Helper\Render;
use Ifnc\Tads\Helper\Transaction;

class ImprimirHistoricoController implements IController
{
    public function request(): void
    {
        Transaction::open();

        echo Render::html(
            [
                "imprimirH.php",
            ],
            [
                "usuario" => $_SESSION["usuario"],
                "turma" => Turma::findByCondition("idAluno='{$_SESSION['usuario']->id}'"),
                "boletim" => SelectPro::boletim($_SESSION["usuario"]->id),
                "anos" => SelectPro::ano($_SESSION["usuario"]->id)
            ]
        );
    }
}
