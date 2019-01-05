<?php declare(strict_types=1);

namespace Sample\Domain\Repository;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;

abstract class AbstractRepository extends EntityRepository
{
    public function __construct(EntityManagerInterface $entityManager)
    {
        $entityName = str_replace(
            'Repository',
            '',
            basename(
                str_replace(
                    '\\',
                    '/',
                    static::class
                )
            )
        );

        $entityClass = str_replace(
            'Repository',
            'Entity',
            __NAMESPACE__
            )
            . '\\' .
            $entityName;

        parent::__construct($entityManager, new ClassMetadata($entityClass));
    }

    public function save($entity): void
    {
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush($entity);
    }
}
