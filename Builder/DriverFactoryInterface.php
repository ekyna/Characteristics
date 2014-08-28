<?php

namespace Ekyna\Component\Characteristics\Builder;

use Doctrine\Common\Annotations\Reader;
use Metadata\Driver\DriverInterface;

/**
 * Interface DriverFactoryInterface
 * @package Ekyna\Component\Characteristics\Builder
 */
interface DriverFactoryInterface
{
    /**
     * @param array $metadataDirs
     * @param Reader $annotationReader
     *
     * @return DriverInterface
     */
    public function createDriver(array $metadataDirs, Reader $annotationReader);
} 