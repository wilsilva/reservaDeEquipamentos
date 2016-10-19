<?php

use App\Controllers\FuncionarioController;
use App\Helpers\Message;
use App\Models\Funcionario;
use Symfony\Component\HttpFoundation\Request;

$app->get('/login', function () use ($app) {

    if (\App\Helpers\Auth::funcionarioEstaLogado()) {
        return $app->redirect('/home');
    }

    return $app['twig']->render('login.twig', []);
});

$app->post('/login', function (Request $request) use ($app) {
    $message = new Message($app);

    $controller = new FuncionarioController();

    try {

        if ($controller->validarAcesso($request->get('masp'), $request->get('senha'))) {
            $controller->salvarCredenciaisDeAcesso((int)$request->get('masp'));
        }

    } catch (\App\Exceptions\FuncionarioInvalidoException $exception) {
        $message->makeText($exception->getMessage(), Message::Error)->show();
        return $app->redirect('/login');
    } catch (\TypeError $exception) {
        $message->makeText("Favor preencher os campos corretamente!", Message::Error)->show();
        return $app->redirect('/login');
    }

    return $app->redirect('/home');

});

$app->get('/login/cadastro', function () use ($app) {
    return $app['twig']->render('cadastro.twig', []);
});

$app->post('/login/cadastro', function (Request $request) use ($app) {

    $message = new Message($app);

    try {
        $funcionario = new Funcionario($request->get('nome'),
            $request->get('masp'),
            $request->get('email'),
            $request->get('senha')
        );

        $controller = new FuncionarioController($funcionario);
        if ($controller->validarCadastroFuncionario()) {
            $resource = new \App\Resources\FuncionarioResource();
            $resource->efetuarCadastro($funcionario);
        }

    } catch (\App\Exceptions\FuncionarioInvalidoException $exception) {
        $message->makeText($exception->getMessage(), Message::Error)->show();
        return $app->redirect('/login/cadastro');
    } catch (\TypeError $exception) {
        $message->makeText("Favor preencher os campos corretamente!", Message::Error)->show();
        return $app->redirect('/login/cadastro');
    }

    $message->makeText("Cadastro Efetuado com sucesso!", Message::Success)->show();
    return $app->redirect('/login');

});
