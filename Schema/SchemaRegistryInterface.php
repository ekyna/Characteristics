<?php

namespace Ekyna\Component\Characteristics\Schema;

/**
 * Interface SchemaRegistryInterface
 * @package Ekyna\Component\Characteristics\Schema
 */
interface SchemaRegistryInterface
{
    /**
     * Sets the schemas directories.
     *
     * @param array $dirs
     *
     * @return SchemaRegistry
     *
     * @throws \RuntimeException
     */
    public function setDirs(array $dirs);

    /**
     * Returns a Schema by his name.
     *
     * @param $name
     *
     * @throws \Exception
     *
     * @return Schema
     */
    public function getSchemaByName($name);

    /**
     * Returns the schemas.
     *
     * @return Schema[]
     */
    public function getSchemas();
}
