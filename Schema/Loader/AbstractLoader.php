<?php

namespace Ekyna\Component\Characteristics\Schema\Loader;

use Ekyna\Component\Characteristics\Schema\Config\SchemaConfiguration;
use Ekyna\Component\Characteristics\Schema\Definition;
use Ekyna\Component\Characteristics\Schema\Group;
use Ekyna\Component\Characteristics\Schema\Schema;
use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\Config\Loader\LoaderResolverInterface;
use Symfony\Component\Intl\Locale\Locale;

/**
 * Class AbstractLoader
 * @package Ekyna\Component\Characteristics\Schema\Loader
 * @author Étienne Dauvergne <contact@ekyna.com>
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
                    $fullName = implode(':', array($schemaName, $groupName, $characteristicName));
                    $type = $characteristicConfig['type'];
                    $parameters = $characteristicConfig['parameters'];

                    $this->validateParameters($fullName, $type, $parameters);

                    $definition = new Definition(
                        $characteristicName,
                        $fullName,
                        $characteristicConfig['title'],
                        $type,
                        $parameters
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
     * Validates the parameters.
     *
     * @param string $name
     * @param string $type
     * @param array $parameters
     * @throws \InvalidArgumentException
     */
    private function validateParameters($name, $type, array &$parameters)
    {
        if (true === $parameters['virtual'] && 0 === count($parameters['property_paths'])) {
            throw new \InvalidArgumentException(sprintf('"property_paths" parameter must be set for "virtual" characteristic "%s".', $name));
        }
        if ($type === 'datetime') {
            if ($parameters['format'] === '%s') {
                $parameters['format'] = 'd/m/Y';
            }
        } elseif (false === strpos($parameters['format'], '%s')) {
            throw new \InvalidArgumentException(sprintf('"format" parameter must contain "%%s" for characteristic "%s".', $name));
        }
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
