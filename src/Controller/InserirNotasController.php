<?php

namespace Ifnc\Tads\Controller;

use Ifnc\Tads\Entity\DisciplinaTurma;
use Ifnc\Tads\Helper\SelectPro;
use Ifnc\Tads\Helper\Transaction;


class InserirNotasController implements IController
{
    public function request(): void
    {
        echo "Até aqui ainda vai";
        Transaction::open();
            $dt = SelectPro::InserirNotas($_SESSION["usuario"]->id, $_GET['id']);
        Transaction::close();

        $new = new DisciplinaTurma();
        foreach ($dt as $d) {
            $new->id = $_POST['id-'.$d->id];
            $new->idDisciplina = $_POST['idDisciplina-'.$d->id];
            $new->idAluno = $_POST['idAluno-'.$d->id];
            $new->idTurma = $_POST['idTurma-'.$d->id];
            $new->pb = $_POST['pb-'.$d->id];
            $new->sb = $_POST['sb-'.$d->id];
            $new->tb = $_POST['tb-'.$d->id];
            $new->qb = $_POST['qb-'.$d->id];
            var_dump($new);
            Transaction::open();
            $new->store();
            Transaction::close();
        }
        header('Location: /inserir-notas?id='.$_GET['id'], true, 302);
        exit();
    }
}
