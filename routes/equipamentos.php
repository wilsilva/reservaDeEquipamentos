<?php
/**
 * Created by PhpStorm.
 * User: williamsilva
 * Date: 10/18/16
 * Time: 10:46 AM
 */

use App\Helpers\Message;
use App\Models\Equipamento;
use App\Resources\EquipamentoResource;
use Symfony\Component\HttpFoundation\Request;

$app->get('/home/equipamentos', function () use ($app) {

    $resource = new EquipamentoResource();
    $equipamentos = $resource->retornarListaEquipamentos();

    return $app['twig']->render('listar_equipamentos.twig', [
        'funcionario' => \App\Helpers\Auth::getFuncionarioLogado(),
        'equipamentos' => $equipamentos
    ]);

})->before($validarLogin);

$app->get('/home/equipamento/cadastro', function () use ($app) {

    $resource = new EquipamentoResource();


    return $app['twig']->render('cadastro_equipamento.twig', [
        'funcionario' => \App\Helpers\Auth::getFuncionarioLogado(),
    ]);

})->before($validarLogin);

$app->post('/home/equipamento/cadastro', function (Request $request) use ($app) {

    try {

        $equipamento = new Equipamento(
            (int)$request->get('numPatrimonio'),
            $request->get('nomeEquipamento'),
            $request->get('tipoEquipamento'),
            $request->get('descricao'),
            $request->get('marca'),
            $request->get('modelo'),
            (int)$request->get('quantidadeDisponivel')
        );

        $resource = new EquipamentoResource();
        $resource->cadastrar($equipamento);

        $message = new Message($app);
        $message->makeText("Equipamento cadastrado com sucesso!", Message::Success)->show();
        return $app->redirect('/home/equipamentos');

    } catch (\Exception $erro) {

        return $app->redirect('/home/equipamentos');
    }

})->before($validarLogin);


$app->get('/home/equipamento/alteracao/{numPatrimonio}', function ($numPatrimonio) use ($app) {

    $resource = new EquipamentoResource();
    $equipamento = $resource->retornarEquipamentoPeloNumPatrimonio($numPatrimonio);

    return $app['twig']->render('alteracao_equipamento.twig', [
        'funcionario' => \App\Helpers\Auth::getFuncionarioLogado(),
        'equipamento' => $equipamento
    ]);

})->before($validarLogin);

$app->post('/home/equipamento/alteracao', function (Request $request) use ($app) {

    try {

        $equipamento = new Equipamento(
            (int)$request->get('numPatrimonio'),
            $request->get('nomeEquipamento'),
            $request->get('tipoEquipamento'),
            $request->get('descricao'),
            $request->get('marca'),
            $request->get('modelo'),
            (int)$request->get('quantidadeDisponivel')
        );

        $resource = new EquipamentoResource();
        $resource->alterar($equipamento);

        $message = new Message($app);
        $message->makeText("Equipamento alterado com sucesso!", Message::Success)->show();
        return $app->redirect('/home/equipamentos');

    } catch (\Exception $erro) {

        return $app->redirect('/home/equipamentos');
    }

})->before($validarLogin);


$app->get('/home/equipamento/remover/{numPatrimonio}', function ($numPatrimonio) use ($app) {

    $resource = new EquipamentoResource();
    $resource->remover($numPatrimonio);
    $message = new Message($app);
    $message->makeText("Equipamento removido com sucesso!", Message::Success)->show();
    return $app->redirect('/home/equipamentos');

})->before($validarLogin);