<?php
/**
 * Created by PhpStorm.
 * User: williamsilva
 * Date: 10/17/16
 * Time: 3:00 PM
 */

namespace App\Models;

use Doctrine\DBAL\Types\IntegerType;
use Doctrine\ORM\Mapping;

/**
 * Class Funcionario
 * @package App\Models
 * @Entity
 */
class Funcionario
{
    /**
     * @Id
     * @Column(type="integer")
     */
    private $masp;

    /**
     * @Column(type="string", nullable=false)
     */
    private $nome;

    /**
     * @Column(type="string", nullable=false)
     */
    private $email;

    /**
     * @Column(type="string", nullable=false)
     */
    private $senha;

    /**
     * @Column(type="integer", nullable=false, options={"default":0 })
     */
    private $nivelDeAcesso;

    /**
     * @var Emprestimo
     * @OneToMany(
     *     targetEntity="Emprestimo",
     *     mappedBy="Emprestimo"
     * )
     */
    private $emprestimo;


    /**
     * Funcionario constructor.
     * @param $nome
     * @param $masp
     * @param $email
     * @param $senha
     */
    public function __construct(string $nome, int $masp, string $email, string $senha, int $nivelDeAcesso = 0)
    {
        $this->nome = $nome;
        $this->masp = $masp;
        $this->email = $email;
        $this->senha = $senha;
        $this->nivelDeAcesso = $nivelDeAcesso;
    }

    /**
     * @return string
     */
    public function getNome(): string
    {
        return $this->nome;
    }

    /**
     * @param string $nome
     */
    public function setNome(string $nome)
    {
        $this->nome = $nome;
    }

    /**
     * @return int
     */
    public function getMasp(): int
    {
        return $this->masp;
    }

    /**
     * @param int $masp
     */
    public function setMasp(int $masp)
    {
        $this->masp = $masp;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getSenha(): string
    {
        return $this->senha;
    }

    /**
     * @param string $senha
     */
    public function setSenha(string $senha)
    {
        $this->senha = $senha;
    }

    /**
     * @return int
     */
    public function getNivelDeAcesso() : int
    {
        return $this->nivelDeAcesso;
    }

    /**
     * @param mixed $nivelDeAcesso
     */
    public function setNivelDeAcesso(int $nivelDeAcesso)
    {
        $this->nivelDeAcesso = $nivelDeAcesso;
    }

    /**
     * @return Emprestimo
     */
    public function getEmprestimo() : Emprestimo
    {
        return $this->emprestimo;
    }

    /**
     * @param Emprestimo $emprestimo
     */
    public function setEmprestimo(Emprestimo $emprestimo)
    {
        $this->emprestimo = $emprestimo;
    }


}