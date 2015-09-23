<?php

namespace Ekyna\Component\Characteristics\Schema;

/**
 * Class Group
 * @package Ekyna\Component\Characteristics\Schema
 */
class Group
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $title;

    /**
     * @var Definition[]
     */
    private $definitions;

    /**
     * Constructor.
     *
     * @param $name
     * @param $title
     */
    public function __construct($name, $title)
    {
        $this->definitions = [];
        $this->name = $name;
        $this->title = $title;
    }

    /**
     * Sets the name.
     *
     * @param string $name
     *
     * @return Group
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Returns the name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets the title.
     *
     * @param string $title
     *
     * @return Group
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Returns the title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Returns whether the group has the definition or not.
     *
     * @param Definition $definition
     *
     * @return bool
     */
    public function hasDefinition(Definition $definition)
    {
        return array_key_exists($definition->getName(), $this->definitions);
    }

    /**
     * Adds a definition.
     *
     * @param Definition $definition
     *
     * @throws \InvalidArgumentException
     *
     * @return Group
     */
    public function addDefinition(Definition $definition)
    {
        if ($this->hasDefinition($definition)) {
            throw new \InvalidArgumentException(sprintf('Definition "%s" allready exists.', $definition->getName()));
        }

        $this->definitions[$definition->getName()] = $definition;

        return $this;
    }

    /**
     * Returns a definition by name.
     *
     * @param $name
     *
     * @throws \InvalidArgumentException
     *
     * @return Definition
     */
    public function getDefinitionByName($name)
    {
        if (!array_key_exists($name, $this->definitions)) {
            throw new \InvalidArgumentException(sprintf('Can\'t find "%s" Definition.', $name));
        }

        return $this->definitions[$name];
    }

    /**
     * Returns the definitions.
     *
     * @return Definition[]
     */
    public function getDefinitions()
    {
        return $this->definitions;
    }
}
