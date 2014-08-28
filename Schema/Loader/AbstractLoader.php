<?php

namespace Ekyna\Component\Characteristics\Schema\Loader;

use Ekyna\Component\Characteristics\Schema\Config\SchemaConfiguration;
use Ekyna\Component\Characteristics\Schema\Definition;
use Ekyna\Component\Characteristics\Schema\Group;
use Ekyna\Component\Characteristics\Schema\Schema;
use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\Config\Loader\LoaderResolverInterface;

/**
 * Class AbstractLoader
 * @package Ekyna\Component\Characteristics\Schema\Loader
 */
abstract class AbstractLoader implements LoaderInterface
{
    /**
     * @var LoaderResolverInterface
     */
    protected $resolver;

    /**
     * Creates and returns a Schema from the given configuration array.
     *
     * @param array $configuration
     *
     * @return Schema[]
     */
    protected function createSchemas(array $configuration)
    {
        $processor = new Processor();
        $processedConfiguration = $processor->processConfiguration(
            new SchemaConfiguration(),
            $configuration
        );

        $schemas = array();
        foreach ($processedConfiguration as $schemaName => $schemaConfig) {
            $schema = new Schema($schemaName, $schemaConfig['title']);
            foreach ($schemaConfig['groups'] as $groupName => $groupConfig) {
                $group = new Group($groupName, $groupConfig['title']);
                foreach ($groupConfig['characteristics'] as $characteristicName => $characteristicConfig) {
                    $definition = new Definition(
                        $characteristicName,
                        implode(':', array($schemaName, $groupName, $characteristicName)),
                        $characteristicConfig['shared'],
                        $characteristicConfig['title'],
                        $characteristicConfig['type']
                    );
                    $group->addDefinition($definition);
                }
                $schema->addGroup($group);
            }
            $schemas[] = $schema;
        }

        return $schemas;
    }

    /**
     * {@inheritDoc}
     */
    public function getResolver()
    {
        return $this->resolver;
    }

    /**
     * {@inheritDoc}
     */
    public function setResolver(LoaderResolverInterface $resolver)
    {
        $this->resolver = $resolver;
    }

    /**
     * {@inheritDoc}
     */
    public function resolve($resource, $type = null)
    {
        if ($this->supports($resource, $type)) {
            return $this;
        }

        $loader = null === $this->resolver ? false : $this->resolver->resolve($resource, $type);

        if (false === $loader) {
            throw new FileLoaderLoadException($resource);
        }

        return $loader;
    }
}
