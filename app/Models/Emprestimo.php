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
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\ManyToMany;
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
     * @var \DateTime
     * @Column(
     *     type="date",
     * )
     */
    private $dataEmprestimo;

    /**
     * @var \DateTime
     * @Column(
     *     type="date",
     * )
     */
    private $dataDevolucao;

    /**
     * @ManyToMany(targetEntity="Equipamento", inversedBy="emprestimos")
     * @JoinTable(name="emprestimo_equipamento",
     *      joinColumns={@JoinColumn(name="emprestimo_id", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="numPatrimonio", referencedColumnName="numPatrimonio")}
     *      )
     */
    private $equipamentos;

    /**
     * @var Funcionario
     * @ManyToOne(
     *     targetEntity="Funcionario",
     *     inversedBy="emprestimos"
     * )
     * @JoinColumn(name="funcionarioId", referencedColumnName="masp", nullable=false)
     */
    private $funcionario;

    /**
     * @var Status
     * @ManyToOne(
     *     targetEntity="Status",
     *     inversedBy="emprestimo"
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
    public function __construct(int $quantidadeSolicitada, \DateTime $dataEmprestimo, \DateTime $dataDevolucao)
    {
        $this->equipamentos = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return \DateTime
     */
    public function getDataEmprestimo(): \DateTime
    {
        return $this->dataEmprestimo;
    }

    /**
     * @param \DateTime $dataEmprestimo
     */
    public function setDataEmprestimo(\DateTime $dataEmprestimo)
    {
        $this->dataEmprestimo = $dataEmprestimo;
    }

    /**
     * @return \DateTime
     */
    public function getDataDevolucao(): \DateTime
    {
        return $this->dataDevolucao;
    }

    /**
     * @param \DateTime $dataDevolucao
     */
    public function setDataDevolucao(\DateTime $dataDevolucao)
    {
        $this->dataDevolucao = $dataDevolucao;
    }


    public function getEquipamentos()
    {
        return $this->equipamentos;
    }


    public function addEquipamento(Equipamento $equipamento)
    {
        $this->equipamentos->add($equipamento);
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
