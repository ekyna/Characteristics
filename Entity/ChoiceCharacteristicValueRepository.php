<?php

namespace Ekyna\Component\Characteristics\Entity;

use Doctrine\ORM\EntityRepository;
use Ekyna\Component\Characteristics\Schema\Definition;

/**
 * Class ChoiceCharacteristicValueRepository
 * @package Ekyna\Component\Characteristics\Entity
 */
class ChoiceCharacteristicValueRepository extends EntityRepository
{
    public function findByDefinition(Definition $definition)
    {
        $query = $this->createQueryBuilder('c')
            ->where('c.name = :name')
            ->setParameter('name', $definition->getIdentifier())
            ->orderBy('c.value', 'ASC')
            ->getQuery();

        return $query->getResult();
    }
} 