<?php
/**
 * Created by PhpStorm.
 * User: williamsilva
 * Date: 10/20/16
 * Time: 3:09 PM
 */


use App\Helpers\Auth;
use App\Helpers\Message;
use App\Models\Emprestimo;
use App\Resources\StatusResource;
use Symfony\Component\HttpFoundation\Request;

$app->get('/home/reservar', function () use ($app) {

    try {
        $equipamentoResource = new \App\Resources\EquipamentoResource();
        $equipamentos = $equipamentoResource->retornarListaEquipamentosNaoReservados();
    } catch (\Exception $exception) {
        die($exception->getMessage());
    }

    return $app['twig']->render('reservar_equipamentos.twig', [
        'funcionario' => \App\Helpers\Auth::getFuncionarioLogado(),
        'equipamentos' => $equipamentos,
    ]);

})->before($validarLogin);


$app->post('/home/reservar', function (Request $request) use ($app) {

    $message = new Message($app);

    try {

        $dataEmprestimo = DateTime::createFromFormat('d/m/Y', $request->get('dataEmprestimo'));
        $dataDevolucao = DateTime::createFromFormat('d/m/Y', $request->get('dataDevolucao'));

        $emprestimo = new Emprestimo($request->get('quantidadeSolicitada'),
            DateTime::createFromFormat('Y-m-d', $dataEmprestimo->format('Y-m-d')),
            DateTime::createFromFormat('Y-m-d', $dataDevolucao->format('Y-m-d'))
        );

        $emprestimo->setFuncionario(Auth::getFuncionarioLogado());

        if (!empty($request->get('equipamentos')) || count($request->get('equipamentos')) > 0)
            $equipamentosIds = $request->get('equipamentos');
        else
            throw new \Exception("Favor selecionar um equipamento");

        foreach ($equipamentosIds as $equipamentoId) {
            $equipamentoResource = new \App\Resources\EquipamentoResource();
            $emprestimo->addEquipamento($equipamentoResource->retornarEquipamentoPeloNumPatrimonio($equipamentoId));
        }

        $emprestimoResource = new \App\Resources\EmprestimoResource();
        $emprestimoResource->cadastrarEmprestimo($emprestimo);

    } catch (\Exception $erro) {
        $message->makeText($erro->getMessage(), Message::Error)->show();
        return $app->redirect('/home/reservar');
    }

    $message->makeText('Reserva solicitada com sucesso!', Message::Success)->show();
    return $app->redirect('/home');
})->before($validarLogin);


$app->get('/home/reserva/cancelar/{id}', function ($id) use ($app) {

    $message = new Message($app);

    try {
        $emprestimoResource = new \App\Resources\EmprestimoResource();
        $emprestimoResource->cancelarEmprestimo($emprestimoResource->getEmprestimoById($id));

        $message->makeText('Cancelamento foi efetuado com sucesso!', Message::Success)->show();
    } catch (\Exception $erro) {
        $message->makeText("Ocorreu um erro ao cancelar o emprestimo! \n Erro: {$erro->getMessage()}", Message::Error)->show();
    }
    return $app->redirect('/home');

})->before($validarLogin);

$app->get('/home/status/alterar/{id}', function ($id) use ($app) {
    $emprestimoResource = new \App\Resources\EmprestimoResource();
    $emprestimo = $emprestimoResource->getEmprestimoById($id);

    return $app['twig']->render('alterar_status_emprestimo.twig', [
        'funcionario' => \App\Helpers\Auth::getFuncionarioLogado(),
        'emprestimo' => $emprestimo,
    ]);

})->before($validarLogin);


$app->post('/home/status/alterar', function (Request $request) use ($app) {
    $idEmprestimo = $request->get('idEmprestimo');
    $idStatus = $request->get('status');

    $emprestimoResource = new \App\Resources\EmprestimoResource();
    $emprestimo = $emprestimoResource->getEmprestimoById($idEmprestimo);

    if ($idStatus != 3 && $idStatus != 4) {
        $statusResource = new StatusResource();
        $status = $statusResource->getStatusbyId($idStatus);
        $emprestimoResource->modificarStatus($emprestimo, $status);
    } elseif ($idStatus == 3) {
        $emprestimoResource->devolvendoEquipamentoEmprestimo($emprestimo);
    } elseif ($idStatus == 4) {
        $emprestimoResource->cancelarEmprestimo($emprestimo);
    }

    $message = new Message($app);
    $message->makeText("Status do Emprestimo foi alterado com sucesso!", Message::Success)->show();
    return $app->redirect('/home');


})->before($validarLogin);