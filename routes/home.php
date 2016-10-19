<?php
/**
 * Created by PhpStorm.
 * User: williamsilva
 * Date: 10/17/16
 * Time: 5:38 PM
 */

$app->get('/home', function () use ($app) {

    return $app['twig']->render('home.twig', [
        'funcionario' => \App\Helpers\Auth::getFuncionarioLogado(),
    ]);

})->before($validarLogin);

$app->get('/home/sair', function () use ($app) {

    \App\Helpers\Auth::logout();
    return $app->redirect('/login');

})->before($validarLogin);