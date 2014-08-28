<?php

namespace Ekyna\Component\Characteristics\Schema\Loader;

use Symfony\Component\Config\Loader\LoaderInterface as BaseLoaderInterface;

/**
 * Interface LoaderInterface
 * @package Ekyna\Component\Characteristics\Schema\Loader
 */
interface LoaderInterface extends BaseLoaderInterface
{
    /**
     * Loads the schemas configurations resource file.
     *
     * @param mixed $resource
     * @param null  $type
     *
     * @return \Ekyna\Component\Characteristics\Schema\Schema[]
     */
    public function load($resource, $type = null);

    /**
     * Finds a loader able to load an imported resource.
     *
     * @param mixed  $resource A Resource
     * @param string $type     The resource type
     *
     * @return LoaderInterface A LoaderInterface instance
     *
     * @throws FileLoaderLoadException if no loader is found
     */
    public function resolve($resource, $type = null);
} 