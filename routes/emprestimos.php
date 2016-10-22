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
use Symfony\Component\HttpFoundation\Request;

$app->get('/home/reservar', function () use ($app) {

    $equipamentoResource = new \App\Resources\EquipamentoResource();
    $equipamentos = $equipamentoResource->retornarListaEquipamentos();

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

        $equipamentosIds = $request->get('equipamentos');

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