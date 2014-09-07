<?php

namespace Ekyna\Component\Characteristics\Entity;

use Ekyna\Component\Characteristics\Exception\UnexpectedValueException;
use Ekyna\Component\Characteristics\Model\CharacteristicInterface;
use Ekyna\Component\Characteristics\Schema\Definition;

/**
 * Class BooleanCharacteristic
 * @package Ekyna\Component\Characteristics\Entity
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class BooleanCharacteristic extends AbstractCharacteristic
{
    /**
     * @var boolean
     */
    protected $boolean;

    /**
     * Sets the boolean.
     *
     * @param boolean $boolean
     * @return BooleanCharacteristic
     */
    public function setBoolean($boolean = null)
    {
        $this->boolean = null !== $boolean ? (bool) $boolean : null;

        return $this;
    }

    /**
     * Returns the boolean.
     *
     * @return boolean
     */
    public function getBoolean()
    {
        return $this->boolean;
    }

    /**
     * {@inheritdoc}
     */
    public function getValue()
    {
        return $this->getBoolean();
    }

    /**
     * {@inheritdoc}
     */
    public function setValue($value = null)
    {
        if ($this->supports($value)) {
            return $this->setBoolean($value);
        }
        throw new UnexpectedValueException('Expected boolean.');
    }

    /**
     * {@inheritdoc}
     */
    public function supports($value = null)
    {
        if (null !== $value && $value != (bool) $value) {
            return false;
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function equals(CharacteristicInterface $characteristic)
    {
        return ($characteristic instanceof BooleanCharacteristic)
            && ($characteristic->getBoolean() === $this->getBoolean());
    }

    /**
     * {@inheritdoc}
     */
    public function display(Definition $definition)
    {
        if (!$this->isNull()) {
            return $this->boolean ? 'Oui' : 'Non';
        }
        return parent::display($definition);
    }

    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return 'boolean';
    }
}
