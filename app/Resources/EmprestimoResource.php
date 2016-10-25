<?php
/**
 * Created by PhpStorm.
 * User: williamsilva
 * Date: 10/20/16
 * Time: 3:35 PM
 */

namespace App\Resources;


use App\Models\Emprestimo;
use App\Models\Status;

class EmprestimoResource extends AbstractResource
{

    public function retornarListaEquipamentos() : array
    {
        return $this->getEntityManager()->getRepository(Emprestimo::class)->findAll();
    }

    public function cadastrarEmprestimo(Emprestimo $emprestimo)
    {
        $statusResource = new StatusResource();
        $emprestimo->setStatus($statusResource->retornarStatusAguardandoAprovacao());
        $equipamentos = $emprestimo->getEquipamentos();
        $em = $this->getEntityManager();
        $emprestimo = $em->merge($emprestimo);
        $em->flush();

        foreach ($equipamentos as $equipamento) {
            $builder = $em->getConnection()->createQueryBuilder();
            $builder->insert('emprestimo_equipamento')->values([
                'emprestimo_id' => $emprestimo->getId(),
                'numPatrimonio' => $equipamento->getNumPatrimonio()
            ])->execute();
        }
    }

    public function getEmprestimoById($id) : Emprestimo
    {
        return $this->getEntityManager()->getRepository(Emprestimo::class)->find($id);
    }

    public function cancelarEmprestimo(Emprestimo $emprestimo)
    {
        $em = $this->getEntityManager();
        $statusResource = new StatusResource();
        $emprestimo->setStatus($statusResource->retornarStatusCancelado());
        $em->merge($emprestimo);
        $em->flush();

        $builder = $em->getConnection()->createQueryBuilder();
        $builder->delete('emprestimo_equipamento')->where("emprestimo_equipamento.emprestimo_id = {$emprestimo->getId()}")
            ->execute();
    }

    public function modificarStatus(Emprestimo $emprestimo, Status $status)
    {
        $em = $this->getEntityManager();
        $emprestimo->setStatus($status);
        $em->merge($emprestimo);
        $em->flush();
    }

    public function devolvendoEquipamentoEmprestimo(Emprestimo $emprestimo)
    {
        $em = $this->getEntityManager();
        $statusResource = new StatusResource();
        $emprestimo->setStatus($statusResource->retornarStatusDevolvido());
        $em->merge($emprestimo);
        $em->flush();

        $builder = $em->getConnection()->createQueryBuilder();
        $builder->delete('emprestimo_equipamento')->where("emprestimo_equipamento.emprestimo_id = {$emprestimo->getId()}")
            ->execute();
    }
}