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
     * @var bool
     */
    private $shared = false;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $type;

    /**
     * Constructor.
     *
     * @param string $name
     * @param string $fullName
     * @param bool $shared
     * @param string $title
     * @param string $type
     */
    public function __construct($name, $fullName, $shared, $title, $type)
    {
        $this->name = $name;
        $this->fullName = $fullName;
        $this->shared = $shared;
        $this->title = $title;
        $this->type = $type;
    }

    /**
     * Returns the identifier.
     *
     * @return string
     */
    public function getIdentifier()
    {
        return $this->shared ? $this->name : $this->fullName;
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
     * @return string
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * @param boolean $shared
     *
     * @return Definition
     */
    public function setShared($shared)
    {
        $this->shared = (bool)$shared;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getShared()
    {
        return $this->shared;
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
}
