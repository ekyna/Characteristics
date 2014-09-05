<?php

namespace Ekyna\Component\Characteristics\Schema;

use Ekyna\Component\Characteristics\Schema\Loader\YamlLoader;
use Symfony\Component\Config\Loader\DelegatingLoader;
use Symfony\Component\Config\Loader\LoaderResolver;
use Symfony\Component\Finder\Finder;

/**
 * Class Registry
 * @package Ekyna\Component\Characteristics\Schema
 */
class SchemaRegistry implements SchemaRegistryInterface
{
    /**
     * @var Schema[]
     */
    private $schemas;

    /**
     * @var array
     */
    private $dirs;

    /**
     * @var bool
     */
    private $loaded = false;

    /**
     * Constructor.
     */
    public function __construct(array $dirs = array())
    {
        $this->schemas = array();
        $this->dirs = $dirs;
    }

    /**
     * {@inheritDoc}
     */
    public function setDirs(array $dirs)
    {
        if ($this->loaded) {
            throw new \RuntimeException('Can\'t change schema directories as registry has already been loaded.');
        }

        $this->dirs = $dirs;
    }

    /**
     * {@inheritDoc}
     */
    public function getSchemaByName($name)
    {
        $this->load();

        if (!array_key_exists($name, $this->schemas)) {
            throw new \Exception(sprintf('Schema "%s" can\'t be found.', $name));
        }

        return $this->schemas[$name];
    }

    /**
     * {@inheritDoc}
     */
    public function getSchemas()
    {
        $this->load();

        return $this->schemas;
    }

    /**
     * {@inheritDoc}
     */
    public function getDefinitionsByType($type = 'choice')
    {
        $this->load();

        $definitions = array();

        foreach($this->schemas as $schema) {
            foreach($schema->getGroups() as $group) {
                foreach($group->getDefinitions() as $definition) {
                    if ($definition->getType() == $type && array_key_exists($definition->getIdentifier(), $definitions)) {
                        $definitions[$definition->getIdentifier()] = $definition;
                    }
                }
            }
        }

        return $definitions;
    }

    /**
     * {@inheritDoc}
     */
    public function getDefinitionByIdentifier($identifier)
    {
        $this->load();

        foreach($this->schemas as $schema) {
            foreach($schema->getGroups() as $group) {
                foreach($group->getDefinitions() as $definition) {
                    if ($definition->getIdentifier() === $identifier) {
                        return $definition;
                    }
                }
            }
        }

        throw new \RuntimeException(sprintf('Unable to find "%s" characteristic definition.', $identifier));
    }

    /**
     * Adds a schema.
     *
     * @param Schema $schema
     * @throws \Exception
     * @return SchemaRegistry
     */
    private function addSchema(Schema $schema)
    {
        if (array_key_exists($schema->getName(), $this->schemas)) {
            throw new \Exception(sprintf('Schema "%s" is allready registered.', $schema->getName()));
        }

        $this->schemas[$schema->getName()] = $schema;

        return $this;
    }

    /**
     * Loads the schemas.
     *
     * @return SchemaRegistry
     */
    private function load()
    {
        if ($this->loaded) {
            return $this;
        }

        if (0 == count($this->dirs)) {
            return $this;
        }

        $loaderResolver = new LoaderResolver(array(
            new YamlLoader()
        ));
        $loader = new DelegatingLoader($loaderResolver);

        $finder = new Finder();
        $finder->files()->in($this->dirs)->name('schemas.yml');

        foreach ($finder as $file) {
            $schemas = $loader->load((string)$file);
            foreach ($schemas as $schema) {
                $this->addSchema($schema);
            }
        }

        $this->loaded = true;

        return $this;
    }
}
