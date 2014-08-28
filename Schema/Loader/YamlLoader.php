<?php

namespace Ekyna\Component\Characteristics\Schema\Loader;

use Symfony\Component\Yaml\Yaml;

/**
 * Class YamlLoader
 * @package Ekyna\Component\Characteristics\Schema\Loader
 */
class YamlLoader extends AbstractLoader
{
    /**
     * Loads the schemas configurations resource file.
     *
     * @param mixed $resource
     * @param null  $type
     *
     * @return \Ekyna\Component\Characteristics\Schema\Schema[]
     */
    public function load($resource, $type = null)
    {
        $configs = Yaml::parse($resource);

        return $this->createSchemas($configs);
    }

    /**
     * {@inheritDoc}
     */
    public function supports($resource, $type = null)
    {
        return is_string($resource) && 'yml' === pathinfo(
            $resource,
            PATHINFO_EXTENSION
        );
    }
}
