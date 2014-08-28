<?php

namespace Ekyna\Component\Characteristics\Doctrine\ORM;

use Doctrine\Bundle\DoctrineBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass;

/**
 * Class DoctrineOrmMapping
 * @package Ekyna\Component\Characteristics\Doctrine\ORM
 */
final class DoctrineOrmMapping
{
    public static function buildCompilerPass()
    {
        $modelDir = realpath(__DIR__.'/../../Resources/config/doctrine');
        $mappings = array(
            $modelDir => 'Ekyna\Component\Characteristics\Entity',
        );

        return DoctrineOrmMappingsPass::createXmlMappingDriver(
            $mappings
            //array('ekyna_characteristics.manager_name'),  // Optional other manager name
            //'ekyna_characteristics.orm_enabled'           // Container parameter that enables the mapping
        );
    }
}
