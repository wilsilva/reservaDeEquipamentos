<?php


require_once __DIR__ . '/../vendor/autoload.php';

use App\Controllers\FuncionarioController;
use App\Helpers\Message;
use App\Models\Funcionario;
use Dflydev\Provider\DoctrineOrm\DoctrineOrmServiceProvider;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use \Symfony\Component\HttpFoundation\Session\Session;

$app = new Silex\Application();

$app->register(new Silex\Provider\SessionServiceProvider());

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__ . '/../app/Views',
));

$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'db.options' => [
        'driver' => 'pdo_mysql',
        'host' => '127.0.0.1',
        'dbname' => 'db_reservadeequipamentos',
        'user' => 'root',
        'password' => 'root',
        'charset' => 'utf8',
    ],
));

$app->register(new DoctrineOrmServiceProvider, array(
    'orm.proxies_dir' => __DIR__ . '/../proxies',
    'orm.em.options' => array(
        'mappings' => array(
            // Using actual filesystem paths
            array(
                'type' => 'annotation',
                'namespace' => 'App\Models',
                'path' => __DIR__ . '/../app/Models',
            ),
        ),
    ),
));

$app->get('/', function () use ($app) {

    if (\App\Helpers\Auth::funcionarioEstaLogado()) {
        return $app->redirect('/home');
    } else {
        return $app->redirect('/login');
    }

});

$validarLogin = function (Request $request, Application $app) {

    if (!\App\Helpers\Auth::funcionarioEstaLogado()) {
        return $app->redirect('/login');
    }
};

include_once __DIR__ . '/../routes/login.php';
include_once __DIR__ . '/../routes/home.php';
include_once __DIR__ . '/../routes/equipamentos.php';
include_once __DIR__ . '/../routes/funcionarios.php';
include_once __DIR__ . '/../routes/emprestimos.php';

$app->run();