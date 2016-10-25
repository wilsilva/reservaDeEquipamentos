<?php
/**
 * Created by PhpStorm.
 * User: williamsilva
 * Date: 10/22/16
 * Time: 4:51 PM
 */

namespace App\Resources;


use App\Models\Status;

class StatusResource extends AbstractResource
{

    public function retornarStatusAguardandoAprovacao() : Status
    {
        return $this->getEntityManager()->getRepository(Status::class)->find(1);

    }

    public function retornarStatusCancelado() : Status
    {
        return $this->getEntityManager()->getRepository(Status::class)->find(4);
    }

    public function getStatusbyId($idStatus) : Status
    {
        return $this->getEntityManager()->getRepository(Status::class)->find($idStatus);
    }

    public function retornarStatusDevolvido() : Status
    {
        return $this->getEntityManager()->getRepository(Status::class)->find(3);
    }

}