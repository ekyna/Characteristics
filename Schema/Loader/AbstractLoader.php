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

                    $this->validateDefinitionConfig($fullName, $characteristicConfig);

                    $definition = new Definition();
                    $definition
                        ->setName($characteristicName)
                        ->setFullName($fullName)
                        ->setType($characteristicConfig['type'])
                        ->setTitle($characteristicConfig['title'])
                        ->setShared($characteristicConfig['shared'])
                        ->setVirtual($characteristicConfig['virtual'])
                        ->setPropertyPaths($characteristicConfig['property_paths'])
                        ->setFormat($characteristicConfig['format'])
                        ->setDisplayGroups($characteristicConfig['display_groups'])
                    ;
                    $group->addDefinition($definition);
                }
                $schema->addGroup($group);
            }
            $schemas[] = $schema;
        }

        return $schemas;
    }

    /**
     * Validates the definition configuration.
     *
     * @param string $name
     * @param array $config
     * @throws \InvalidArgumentException
     */
    private function validateDefinitionConfig($name, array &$config)
    {
        if (true === $config['virtual'] && 0 === count($config['property_paths'])) {
            throw new \InvalidArgumentException(sprintf('"property_paths" must be set for "virtual" characteristic "%s".', $name));
        }
        if ($config['type'] === 'datetime') {
            if ($config['format'] === '%s') {
                $config['format'] = 'd/m/Y';
            }
        } elseif (false === strpos($config['format'], '%s')) {
            throw new \InvalidArgumentException(sprintf('"format" must contain "%%s" for characteristic "%s".', $name));
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
