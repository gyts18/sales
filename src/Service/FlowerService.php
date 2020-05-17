<?php


namespace App\Service;


use App\Entity\Products\Flowers;
use App\Service\Traits\RepositoryResultsTrait;

class FlowerService extends BaseService
{
    use RepositoryResultsTrait;

    public function getEntityClass(): string
    {
        return Flowers::class;
    }
}