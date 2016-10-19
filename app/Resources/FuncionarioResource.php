<?php
/**
 * Created by PhpStorm.
 * User: williamsilva
 * Date: 10/17/16
 * Time: 4:03 PM
 */

namespace App\Resources;


use App\Models\Funcionario;
use Doctrine\Common\Collections\Collection;

class FuncionarioResource extends AbstractResource
{


    /**
     * @param int $id
     * @return Funcionario
     */
    public function getFuncionarioByMasp(int $masp) : Funcionario
    {
        return $this->getEntityManager()->getRepository(Funcionario::class)->findOneBy([
            'masp' => $masp
        ]);
    }

    /**
     * @return array
     */
    public function retornarListaFuncionarios() : array
    {
        $funcionarios = $this->getEntityManager()->getRepository(Funcionario::class)->findAll();
        return $funcionarios;
    }

    public function existeFuncionario()
    {

    }

    public function efetuarLogin($masp, $senha) : bool
    {
        if ($this->getEntityManager()->getRepository(Funcionario::class)->findOneBy([
            'masp' => $masp,
            'senha' => $senha
        ])
        ) return true;

        return false;
    }

    public function efetuarCadastro(Funcionario $funcionario)
    {
        $em = $this->getEntityManager();
        $em->persist($funcionario);
        $em->flush();
    }

    public function alterar(Funcionario $funcionario)
    {
        $em = $this->getEntityManager();
        $em->merge($funcionario);
        $em->flush();
    }

    public function remover($masp)
    {
        $em = $this->getEntityManager();
        $em->remove($em->getRepository(Funcionario::class)->findOneBy([
            'masp' => $masp
        ]));
        $em->flush();
    }
}