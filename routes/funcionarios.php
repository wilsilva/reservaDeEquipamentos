<?php
/**
 * Created by PhpStorm.
 * User: williamsilva
 * Date: 10/18/16
 * Time: 4:10 PM
 */

use App\Helpers\Message;
use App\Models\Funcionario;
use App\Resources\FuncionarioResource;
use Symfony\Component\HttpFoundation\Request;

$app->get('/home/funcionarios', function () use ($app) {

    $resource = new FuncionarioResource();
    $funcionarios = $resource->retornarListaFuncionarios();

    return $app['twig']->render('listar_funcionarios.twig', [
        'funcionario' => \App\Helpers\Auth::getFuncionarioLogado(),
        'funcionarios' => $funcionarios
    ]);

})->before($validarLogin);


$app->get('/home/funcionario/cadastro', function () use ($app) {

    return $app['twig']->render('cadastro_funcionario.twig', [
        'funcionario' => \App\Helpers\Auth::getFuncionarioLogado(),
    ]);

})->before($validarLogin);

$app->post('/home/funcionario/cadastro', function (Request $request) use ($app) {

    $funcionario = new Funcionario(
        $request->get('nome'),
        $request->get('masp'),
        $request->get('email'),
        $request->get('senha'),
        $request->get('nivelDeAcesso')
    );

    $resource = new FuncionarioResource();
    $resource->efetuarCadastro($funcionario);

    $message = new Message($app);
    $message->makeText("Funcionário cadastrado com sucesso!", Message::Success)->show();
    return $app->redirect('/home/funcionarios');

})->before($validarLogin);


$app->get('/home/funcionario/alteracao/{masp}', function ($masp) use ($app) {

    $resource = new FuncionarioResource();
    $funcionario = $resource->getFuncionarioByMasp((int)$masp);

    return $app['twig']->render('alteracao_funcionario.twig', [
        'funcionario' => \App\Helpers\Auth::getFuncionarioLogado(),
        'funcionarioAlt' => $funcionario
    ]);

})->before($validarLogin);


$app->post('/home/funcionario/alteracao', function (Request $request) use ($app) {

    $funcionario = new Funcionario(
        $request->get('nome'),
        $request->get('masp'),
        $request->get('email'),
        $request->get('senha'),
        $request->get('nivelDeAcesso')
    );

    $resource = new FuncionarioResource();
    $resource->alterar($funcionario);

    $message = new Message($app);
    $message->makeText("Funcionário alterado com sucesso!", Message::Success)->show();
    return $app->redirect('/home/funcionarios');


})->before($validarLogin);

$app->get('/home/funcionario/remover/{masp}', function ($masp) use ($app) {

    $resource = new FuncionarioResource();
    $resource->remover($masp);
    $message = new Message($app);
    $message->makeText("Funcionário removido com sucesso!", Message::Success)->show();
    return $app->redirect('/home/funcionarios');

})->before($validarLogin);