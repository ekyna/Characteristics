<?php

namespace Ekyna\Component\Characteristics\Metadata\Driver;

use Doctrine\Common\Annotations\Reader;
use Ekyna\Component\Characteristics\Annotation\Inherit;
use Ekyna\Component\Characteristics\Annotation\Schema;
use Ekyna\Component\Characteristics\Metadata\ClassMetadata;
use Metadata\Driver\DriverInterface;

/**
 * Class AnnotationDriver
 * @package Ekyna\Component\Characteristics\Metadata\Driver
 */
class AnnotationDriver implements DriverInterface
{
    /**
     * @var \Doctrine\Common\Annotations\Reader
     */
    private $reader;

    public function __construct(Reader $reader)
    {
        $this->reader = $reader;
    }

    /**
     * @param \ReflectionClass $class
     *
     * @return \Metadata\ClassMetadata
     */
    public function loadMetadataForClass(\ReflectionClass $class)
    {
        $classMetadata = new ClassMetadata($class->name);
        $classMetadata->fileResources[] = $class->getFilename();

        foreach ($this->reader->getClassAnnotations($class) as $annotation) {
            if ($annotation instanceOf Schema) {
                $classMetadata->schema = $annotation->name;
            }
            if ($annotation instanceOf Inherit) {
                $classMetadata->inherit = $annotation->name;
            }
        }

        if (null !== $classMetadata->schema) {
            return $classMetadata;
        }

        return null;
    }
}
