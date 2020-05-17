<?php

namespace App\Service\Traits;

use Doctrine\ORM\QueryBuilder;

/**
 * Trait RepositoryResultsTrait
 *
 * used for Services, so that you can call any repository functions
 * without the need to call repository classes.
 */
trait RepositoryResultsTrait
{
    /**
     * @var bool
     */
    protected bool $returnQuery = false;

    /**
     * @param bool $shouldReturnQuery
     *
     * @return mixed
     */
    public function setReturnQuery(bool $shouldReturnQuery)
    {
        $this->returnQuery = $shouldReturnQuery;

        return $this;
    }

    /**
     * @return bool
     */
    public function shouldReturnQuery(): bool
    {
        return $this->returnQuery;
    }

    /**
     * @param QueryBuilder $qb
     *
     * @return QueryBuilder
     */
    public function getResult(QueryBuilder $qb)
    {
        $result = $this->returnQuery ? $qb : $qb->getQuery()->getResult();

        $this->setReturnQuery(false);

        return $result;
    }
}
