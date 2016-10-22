<?php
/**
 * Created by PhpStorm.
 * User: williamsilva
 * Date: 10/22/16
 * Time: 4:51 PM
 */

namespace app\Resources;


use App\Models\Status;

class StatusResource extends AbstractResource
{

    public function retornarStatusAguardandoAprovacao() : Status
    {
        return $this->getEntityManager()->getRepository(Status::class)->find(1);

    }

}