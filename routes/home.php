<?php
/**
 * Created by PhpStorm.
 * User: williamsilva
 * Date: 10/17/16
 * Time: 5:38 PM
 */

use App\Helpers\Auth;
use App\Resources\EmprestimoResource;

$app->get('/home', function () use ($app) {

    $emprestimoResource = new EmprestimoResource();
    $emprestimos = $emprestimoResource->retornarListaEquipamentos();
    
    return $app['twig']->render('home.twig', [
        'funcionario' => Auth::getFuncionarioLogado(),
        'emprestimos' => $emprestimos
    ]);

})->before($validarLogin);

$app->get('/home/sair', function () use ($app) {

    \App\Helpers\Auth::logout();
    return $app->redirect('/login');

})->before($validarLogin);
