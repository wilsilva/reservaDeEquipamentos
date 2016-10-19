<?php
/**
 * Created by PhpStorm.
 * User: williamsilva
 * Date: 10/17/16
 * Time: 9:51 PM
 */

namespace App\Models;


use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\OneToMany;

/**
 * Class Status
 * @package App\Models
 * @Entity
 */
class Status
{

    /**
     * @var int
     * @Id
     * @Column(
     *     type="integer",
     * )
     * @GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @Column(type="string", nullable=false)
     */
    private $status;

    /**
     * @var Emprestimo
     * @OneToMany(
     *     targetEntity="Emprestimo",
     *     mappedBy="Emprestimo"
     * )
     */
    private $emprestimo;
}