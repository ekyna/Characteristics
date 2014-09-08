<?php

namespace Ekyna\Component\Characteristics\Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class ChoiceCharacteristicValue
 * @package Ekyna\Component\Characteristics\Entity
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class ChoiceCharacteristicValue
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    protected $value;

    /**
     * @var string
     */
    protected $name;

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns the string representation.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getValue();
    }

    /**
     * @param string $value
     *
     * @return ChoiceCharacteristicValue
     */
    public function setValue($value)
    {
        $this->value = (string)$value;

        return $this;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param string $name
     *
     * @return ChoiceCharacteristicValue
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}
