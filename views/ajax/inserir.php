<?php
require_once dirname(__DIR__, 2).'/includes.php';

use App\Model\CentroDeCusto;
use App\Controller\CentroDeCustoController;
use App\Model\Cargo;
use App\Controller\CargoController;
use App\Model\Departamento;
use App\Controller\DepartamentoController;
use App\Model\Usuario;
use App\Controller\UsuarioController;

if($_POST['type'] == 'centro_de_custo')
{
    $c = new CentroDeCusto();
    $c->setNome($_POST['nome']);
    $cController = new CentroDeCustoController();
    $result = $cController->create($c);
    if($result){
        echo json_encode(['error' => false, 'msg' => "Centro de Custo criado!!"]);
        return;
    }else{
        echo json_encode(['error' => true, 'msg' => "Erro ao criar centro de custo, problema de conexão"]);
        return;
    }
}

if($_POST['type'] == 'cargo')
{
    $c = new Cargo();
    $c->setNome($_POST['nome']);
    $c->setDescricao($_POST['desc']);
    $cController = new CargoController();
    $result = $cController->create($c);
    if($result){
        echo json_encode(['error' => false, 'msg' => "Cargo criado!!"]);
        return;
    }else{
        echo json_encode(['error' => true, 'msg' => "Erro ao criar cargo, problema de conexão"]);
        return;
    }
}

if($_POST['type'] == 'departamento')
{
    $d = new Departamento();
    $d->setNome($_POST['nome']);
    $d->setCentroDeCustoId($_POST['centro_de_custo_id']);
    $Controller = new DepartamentoController();
    $result = $Controller->create($d);
    if($result){
        echo json_encode(['error' => false, 'msg' => "Departamento criado!!"]);
        return;
    }else{
        echo json_encode(['error' => true, 'msg' => "Erro ao criar departamento, problema de conexão"]);
        return;
    }
}

if($_POST['type'] == 'usuario')
{
    $u = new Usuario();
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    $u->setNome($_POST['nome']);
    $u->setEmail($_POST['email']);
    $u->setDataDeNascimento($_POST['data_de_nascimento']);
    $u->setCPF($_POST['cpf']);
    $u->setSenha($senha);
    $u->setCargoId($_POST['cargo_id']);
    $u->setDepartamentoId($_POST['departamento_id']);
    $uao = new UsuarioController();
    $result = $uao->create($u);
    if($result){
        echo json_encode(['error' => false, 'msg' => "Usuario criado!!"]);
        return;
    }else{
        echo json_encode(['error' => true, 'msg' => "Erro ao criar usuario, problema de conexão"]);
        return;
    }
}

