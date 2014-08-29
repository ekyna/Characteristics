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
     * @var array
     */
    private $parameters;

    /**
     * Constructor.
     *
     * @param string $name
     * @param string $fullName
     * @param string $title
     * @param string $type
     * @param array $parameters
     */
    public function __construct($name, $fullName, $title, $type, array $parameters = array())
    {
        $this->name = $name;
        $this->fullName = $fullName;
        $this->title = $title;
        $this->type = $type;
        $this->parameters = $parameters;
    }

    /**
     * Returns the identifier.
     *
     * @return string
     */
    public function getIdentifier()
    {
        return true === $this->parameters['shared'] ? $this->name : $this->fullName;
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
     * Sets the parameters.
     *
     * @param array $parameters
     */
    public function setParameters($parameters)
    {
        $this->parameters = $parameters;
    }

    /**
     * Returns the parameters.
     *
     * @return array
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * Returns the [key] parameter value.
     *
     * @param string $key
     *
     * @throws \InvalidArgumentException
     *
     * @return mixed
     */
    public function getParameter($key)
    {
        if (!array_key_exists($key, $this->parameters)) {
            throw new \InvalidArgumentException(sprintf('Parameter "%s" does not exists.', $key));
        }

        return $this->parameters[$key];
    }
}
