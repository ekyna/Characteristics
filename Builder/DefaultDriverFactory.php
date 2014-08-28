<?php

namespace Ekyna\Component\Characteristics\Builder;

use Doctrine\Common\Annotations\Reader;
use Ekyna\Component\Characteristics\Metadata\Driver\AnnotationDriver;
use Metadata\Driver\DriverChain;
use Metadata\Driver\FileLocator;

/**
 * Class DefaultDriverFactory
 * @package Ekyna\Component\Characteristics\Builder
 */
class DefaultDriverFactory implements DriverFactoryInterface
{
    public function createDriver(array $metadataDirs, Reader $annotationReader)
    {
        if ( ! empty($metadataDirs)) {
            $fileLocator = new FileLocator($metadataDirs);

            return new DriverChain(array(
                /*new YamlDriver($fileLocator),
                new XmlDriver($fileLocator),*/
                new AnnotationDriver($annotationReader),
            ));
        }

        return new AnnotationDriver($annotationReader);
    }
}
