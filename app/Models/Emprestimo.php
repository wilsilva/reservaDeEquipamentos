<?php
/**
 * Created by PhpStorm.
 * User: williamsilva
 * Date: 10/17/16
 * Time: 9:25 PM
 */

namespace App\Models;


use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToOne;

/**
 * Class Emprestimo
 * @package App\Models
 * @Entity
 */
class Emprestimo
{
    /**
     * @Id
     * @Column(
     *     type="integer",
     * )
     * @GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     * @Column(
     *     type="integer",
     * )
     */
    private $quantidadeSolicitada;

    /**
     * @var string
     * @Column(
     *     type="datetime",
     * )
     */
    private $dataEmprestimo;

    /**
     * @var string
     * @Column(
     *     type="datetime",
     * )
     */
    private $dataDevolucao;

    /**
     * @var Equipamento
     * @ManyToOne(
     *     targetEntity="Equipamento",
     *     inversedBy="Emprestimo"
     * )
     * @JoinColumn(name="equipamentoId", referencedColumnName="numPatrimonio", nullable=false)
     */
    private $equipamento;

    /**
     * @var Funcionario
     * @ManyToOne(
     *     targetEntity="Funcionario",
     *     inversedBy="Emprestimo"
     * )
     * @JoinColumn(name="funcionarioId", referencedColumnName="masp", nullable=false)
     */
    private $funcionario;

    /**
     * @var Status
     * @ManyToOne(
     *     targetEntity="Status",
     *     inversedBy="Emprestimo"
     * )
     * @JoinColumn(name="statusId", referencedColumnName="id", nullable=false)
     */
    private $status;

    /**
     * Emprestimo constructor.
     * @param int $quantidadeSolicitada
     * @param string $dataEmprestimo
     * @param string $dataDevolucao
     */
    public function __construct(int $quantidadeSolicitada, string $dataEmprestimo, string $dataDevolucao)
    {
        $this->quantidadeSolicitada = $quantidadeSolicitada;
        $this->dataEmprestimo = $dataEmprestimo;
        $this->dataDevolucao = $dataDevolucao;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getQuantidadeSolicitada(): int
    {
        return $this->quantidadeSolicitada;
    }

    /**
     * @param int $quantidadeSolicitada
     */
    public function setQuantidadeSolicitada(int $quantidadeSolicitada)
    {
        $this->quantidadeSolicitada = $quantidadeSolicitada;
    }

    /**
     * @return string
     */
    public function getDataEmprestimo(): string
    {
        return $this->dataEmprestimo;
    }

    /**
     * @param string $dataEmprestimo
     */
    public function setDataEmprestimo(string $dataEmprestimo)
    {
        $this->dataEmprestimo = $dataEmprestimo;
    }

    /**
     * @return string
     */
    public function getDataDevolucao(): string
    {
        return $this->dataDevolucao;
    }

    /**
     * @param string $dataDevolucao
     */
    public function setDataDevolucao(string $dataDevolucao)
    {
        $this->dataDevolucao = $dataDevolucao;
    }

    /**
     * @return Equipamento
     */
    public function getEquipamento(): Equipamento
    {
        return $this->equipamento;
    }

    /**
     * @param Equipamento $equipamento
     */
    public function setEquipamento(Equipamento $equipamento)
    {
        $this->equipamento = $equipamento;
    }

    /**
     * @return Funcionario
     */
    public function getFuncionario(): Funcionario
    {
        return $this->funcionario;
    }

    /**
     * @param Funcionario $funcionario
     */
    public function setFuncionario(Funcionario $funcionario)
    {
        $this->funcionario = $funcionario;
    }

    /**
     * @return Status
     */
    public function getStatus(): Status
    {
        return $this->status;
    }

    /**
     * @param Status $status
     */
    public function setStatus(Status $status)
    {
        $this->status = $status;
    }


}