<?php
/**
 * Created by PhpStorm.
 * User: williamsilva
 * Date: 10/17/16
 * Time: 2:56 PM
 */

namespace App\Controllers;


use App\Exceptions\FuncionarioInvalidoException;
use App\Models\Funcionario;
use App\Resources\FuncionarioResource;
use Symfony\Component\HttpFoundation\Session\Session;

class FuncionarioController
{
    private $funcionario;


    /**
     * FuncionarioController constructor.
     */
    public function __construct(Funcionario $funcionario = null)
    {
        $this->funcionario = $funcionario;
    }

    /**
     * @return Funcionario
     */
    public function getFuncionario(): Funcionario
    {
        return $this->funcionario;
    }

    public function validarCadastroFuncionario() : bool
    {
        if (empty($this->funcionario->getNome()) || empty($this->funcionario->getEmail()) || empty($this->funcionario->getMasp()) || empty($this->funcionario->getSenha())) {
            throw new FuncionarioInvalidoException("Favor preencher todos os campos!");
        }

        return true;
    }

    public function validarAcesso(int $masp, string $senha) : bool
    {
        $resource = new FuncionarioResource();

        if ($resource->efetuarLogin($masp, $senha)) {
            return true;
        }

        throw new FuncionarioInvalidoException('Masp ou Senha incorretos!');
    }

    public function salvarCredenciaisDeAcesso(int $masp)
    {
        $resource = new \App\Resources\FuncionarioResource();
        $funcionario = $resource->getFuncionarioByMasp($masp);

        $session = new Session();
        $session->set('logado', true);
        $session->set('nome', $funcionario->getNome());
        $session->set('email', $funcionario->getEmail());
        $session->set('masp', $funcionario->getMasp());
    }
}