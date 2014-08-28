<?php

namespace Ekyna\Component\Characteristics\Tests\Metadata\Driver;

use Doctrine\Common\Annotations\AnnotationReader;
use Ekyna\Component\Characteristics\Metadata\Driver\AnnotationDriver;

/**
 * Class AnnotationDriverTest
 * @package Ekyna\Component\Characteristics\Tests\Metadata\Driver
 */
class AnnotationDriverTest extends BaseDriverTest
{
    public function getDriver()
    {
        return new AnnotationDriver(new AnnotationReader());
    }
} 