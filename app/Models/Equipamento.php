<?php
/**
 * Created by PhpStorm.
 * User: williamsilva
 * Date: 10/17/16
 * Time: 8:55 PM
 */

namespace App\Models;

use Doctrine\DBAL\Types\IntegerType;
use Doctrine\ORM\Mapping;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\OneToOne;

/**
 * Class Equipamento
 * @package App\Models
 * @Entity
 */
class Equipamento
{

    /**
     * @Id
     * @Column(type="integer")
     * @var int
     */
    private $numPatrimonio;

    /**
     * @var string
     * @Column(type="string")
     */
    private $nome;

    /**
     * @var string
     * @Column(type="string")
     */
    private $tipo;

    /**
     * @var string
     * @Column(type="string")
     */
    private $descricao;

    /**
     * @var string
     * @Column(type="string")
     */
    private $marca;

    /**
     * @var string
     * @Column(type="string")
     */

    /**
     * @var string
     * @Column(type="string")
     */
    private $modelo;

    /**
     * @var int
     * @Column(type="integer")
     */
    private $quantidadeDisponivel;

    /**
     * @var Emprestimo
     * @OneToMany(
     *     targetEntity="Emprestimo",
     *     mappedBy="Emprestimo"
     * )
     */
    private $emprestimo;

    /**
     * Equipamento constructor.
     * @param int $numPatrimonio
     * @param string $nome
     * @param string $tipo
     * @param string $descricao
     * @param string $marca
     * @param string $modelo
     * @param int $quantidadeDisponivel
     */

    public function __construct(int $numPatrimonio, string $nome, string $tipo, string $descricao, string $marca, string $modelo, int $quantidadeDisponivel)
    {
        $this->numPatrimonio = $numPatrimonio;
        $this->nome = $nome;
        $this->tipo = $tipo;
        $this->descricao = $descricao;
        $this->marca = $marca;
        $this->modelo = $modelo;
        $this->quantidadeDisponivel = $quantidadeDisponivel;
    }

    /**
     * @return int
     */
    public function getNumPatrimonio(): int
    {
        return $this->numPatrimonio;
    }

    /**
     * @param int $numPatrimonio
     */
    public function setNumPatrimonio(int $numPatrimonio)
    {
        $this->numPatrimonio = $numPatrimonio;
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
     * @return string
     */
    public function getTipo(): string
    {
        return $this->tipo;
    }

    /**
     * @param string $tipo
     */
    public function setTipo(string $tipo)
    {
        $this->tipo = $tipo;
    }

    /**
     * @return string
     */
    public function getDescricao(): string
    {
        return $this->descricao;
    }

    /**
     * @param string $descricao
     */
    public function setDescricao(string $descricao)
    {
        $this->descricao = $descricao;
    }

    /**
     * @return string
     */
    public function getMarca(): string
    {
        return $this->marca;
    }

    /**
     * @param string $marca
     */
    public function setMarca(string $marca)
    {
        $this->marca = $marca;
    }

    /**
     * @return string
     */
    public function getModelo(): string
    {
        return $this->modelo;
    }

    /**
     * @param string $modelo
     */
    public function setModelo(string $modelo)
    {
        $this->modelo = $modelo;
    }

    /**
     * @return int
     */
    public function getQuantidadeDisponivel(): int
    {
        return $this->quantidadeDisponivel;
    }

    /**
     * @param int $quantidadeDisponivel
     */
    public function setQuantidadeDisponivel(int $quantidadeDisponivel)
    {
        $this->quantidadeDisponivel = $quantidadeDisponivel;
    }

    /**
     * @return mixed
     */
    public function getEmprestimo()
    {
        return $this->emprestimo;
    }

    /**
     * @param mixed $emprestimo
     */
    public function setEmprestimo($emprestimo)
    {
        $this->emprestimo = $emprestimo;
    }




}