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
    protected $identifier;

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
     * Sets the identifier.
     *
     * @param string $identifier
     * @return ChoiceCharacteristicValue
     */
    public function setIdentifier($identifier)
    {
        $this->identifier = $identifier;
        return $this;
    }

    /**
     * Returns the identifier.
     *
     * @return string
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }
}
