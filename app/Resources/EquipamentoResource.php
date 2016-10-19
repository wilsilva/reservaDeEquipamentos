<?php
/**
 * Created by PhpStorm.
 * User: williamsilva
 * Date: 10/18/16
 * Time: 11:00 AM
 */

namespace App\Resources;


use App\Models\Equipamento;

class EquipamentoResource extends AbstractResource
{

    /**
     * @return array
     */
    public function retornarListaEquipamentos() : array
    {
        $equipamentos = $this->getEntityManager()->getRepository(Equipamento::class)->findAll();
        return $equipamentos;
    }

    public function cadastrar(Equipamento $equipamento)
    {
        $em = $this->getEntityManager();
        $em->persist($equipamento);
        $em->flush();
    }

    public function retornarEquipamentoPeloNumPatrimonio($numPatrimonio) : Equipamento
    {
        return $this->getEntityManager()->getRepository(Equipamento::class)->findOneBy([
            'numPatrimonio' => $numPatrimonio
        ]);
    }

    public function alterar(Equipamento $equipamento)
    {
        $em = $this->getEntityManager();
        $em->merge($equipamento);
        $em->flush();
    }

    public function remover($numPatrimonio)
    {
        $em = $this->getEntityManager();
        $em->remove($em->getRepository(Equipamento::class)->findOneBy([
            'numPatrimonio' => $numPatrimonio
        ]));
        $em->flush();
    }

}