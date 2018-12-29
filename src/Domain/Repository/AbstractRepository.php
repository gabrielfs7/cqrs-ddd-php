<?php declare(strict_types=1);

namespace Sample\Domain\Repository;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;

abstract class AbstractRepository extends EntityRepository
{
    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct($entityManager, new ClassMetadata(static::class));
    }

    public function save($entity): void
    {
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush($entity);
    }
}
