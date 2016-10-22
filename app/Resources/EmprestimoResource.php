<?php
/**
 * Created by PhpStorm.
 * User: williamsilva
 * Date: 10/20/16
 * Time: 3:35 PM
 */

namespace App\Resources;


use App\Models\Emprestimo;

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
}