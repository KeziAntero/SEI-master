<?php


namespace Ifnc\Tads\Controller;


use Ifnc\Tads\Entity\Funcionario;
use Ifnc\Tads\Helper\Transaction;

class  CadastroController implements IController
{

    public function request(): void
    {
        $funcionario = new Funcionario();
        if(!empty($_POST['id'])) {
            $funcionario->id = $_POST['id'];
        } else {
            $funcionario->senha = password_hash($_POST['cpf'], PASSWORD_ARGON2I);
            $funcionario->nlogin = 0;
        }
        $funcionario->nome = $_POST['nome'];
        $funcionario->dataNascimento = $_POST['dataNascimento'];
        $funcionario->cpf = $_POST['cpf'];
        $funcionario->email = $_POST['email'];
        $funcionario->telefone = $_POST['telefone'];
        $funcionario->cargo = $_POST['cargo'];
        
        
        var_dump($funcionario);
        Transaction::open();
        $funcionario->store();
        if(!empty($_POST['id'])) {
            header('Location: /perfil-funcionario', true, 302);
            $_SESSION['usuario'] = Funcionario::findByCondition("id='{$_POST['id']}'");
            Transaction::close();
        exit();
        }
        Transaction::close();

        header('Location: /Pagina-inicial', true, 302);
        exit();
    }
}
