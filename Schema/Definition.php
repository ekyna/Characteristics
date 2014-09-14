<?php

namespace Ekyna\Component\Characteristics\Schema;

/**
 * Class Definition
 * @package Ekyna\Component\Characteristics\Schema
 */
class Definition
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $fullName;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $type;

    /**
     * @var boolean
     */
    private $shared;

    /**
     * @var boolean
     */
    private $virtual;

    /**
     * @var array
     */
    private $propertyPaths;

    /**
     * @var string
     */
    private $format;

    /**
     * @var array
     */
    private $displayGroups;


    /**
     * Returns the identifier.
     *
     * @return string
     */
    public function getIdentifier()
    {
        return true === $this->getShared() ? $this->name : $this->fullName;
    }

    /**
     * Sets the name.
     *
     * @param string $name
     *
     * @return Definition
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
     * Sets the full name.
     *
     * @param string $fullName
     *
     * @return Definition
     */
    public function setFullName($fullName)
    {
        $this->fullName = $fullName;

        return $this;
    }

    /**
     * Returns the full name.
     *
     * @return string
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * Sets the title.
     *
     * @param string $title
     *
     * @return Definition
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
     * Sets the type.
     *
     * @param string $type
     *
     * @return Definition
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Returns the type.
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Sets the shared.
     *
     * @param boolean $shared
     * @return Definition
     */
    public function setShared($shared)
    {
        $this->shared = $shared;
        return $this;
    }

    /**
     * Returns the shared.
     *
     * @return boolean
     */
    public function getShared()
    {
        return $this->shared;
    }

    /**
     * Sets the virtual.
     *
     * @param boolean $virtual
     * @return Definition
     */
    public function setVirtual($virtual)
    {
        $this->virtual = $virtual;
        return $this;
    }

    /**
     * Returns the virtual.
     *
     * @return boolean
     */
    public function getVirtual()
    {
        return $this->virtual;
    }

    /**
     * Sets the propertyPaths.
     *
     * @param array $propertyPaths
     * @return Definition
     */
    public function setPropertyPaths($propertyPaths)
    {
        $this->propertyPaths = $propertyPaths;
        return $this;
    }

    /**
     * Returns the propertyPaths.
     *
     * @return array
     */
    public function getPropertyPaths()
    {
        return $this->propertyPaths;
    }

    /**
     * Sets the format.
     *
     * @param string $format
     * @return Definition
     */
    public function setFormat($format)
    {
        $this->format = $format;
        return $this;
    }

    /**
     * Returns the format.
     *
     * @return string
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * Sets the displayGroups.
     *
     * @param array $displayGroups
     * @return Definition
     */
    public function setDisplayGroups(array $displayGroups = array('default'))
    {
        $this->displayGroups = $displayGroups;
        return $this;
    }

    /**
     * Returns the displayGroups.
     *
     * @return array
     */
    public function getDisplayGroups()
    {
        return $this->displayGroups;
    }
}
