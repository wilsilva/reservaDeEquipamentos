<?php
/**
 * Created by PhpStorm.
 * User: williamsilva
 * Date: 10/17/16
 * Time: 2:26 PM
 */

namespace App\Helpers;


use App\Models\Funcionario;
use App\Resources\FuncionarioResource;
use Silex\Application;
use Symfony\Component\HttpFoundation\Session\Session;

class Auth
{
    private $app;

    /**
     * Auth constructor.
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public static function funcionarioEstaLogado(): bool
    {

        $session = new Session();

        if ($session->get('logado')) {
            return true;
        } else {
            return false;
        }
    }

    public static function getFuncionarioLogado() : Funcionario
    {
        $session = new Session();

        try {
            $resource = new FuncionarioResource();
            return $resource->getFuncionarioByMasp($session->get('masp'));
        }catch (\TypeError $error){
            $session->clear();
        }
    }

    public static function logout()
    {
        $session = new Session();
        $session->clear();
    }
}