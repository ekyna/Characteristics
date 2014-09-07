<?php

namespace Ekyna\Component\Characteristics\Entity;

use Ekyna\Component\Characteristics\Exception\UnexpectedValueException;
use Ekyna\Component\Characteristics\Model\CharacteristicInterface;

/**
 * Class NumberCharacteristic
 * @package Ekyna\Component\Characteristics\Entity
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class NumberCharacteristic extends AbstractCharacteristic
{
    /**
     * @var float
     */
    private $number;

    /**
     * Sets the number.
     *
     * @param float $number
     * @return NumberCharacteristic
     */
    public function setNumber($number = null)
    {
        $this->number = null !== $number ? floatval($number) : null;

        return $this;
    }

    /**
     * Returns the number.
     *
     * @return float
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * {@inheritdoc}
     */
    public function getValue()
    {
        return $this->number;
    }

    /**
     * {@inheritdoc}
     */
    public function setValue($value = null)
    {
        if ($this->supports($value)) {
            return $this->setNumber($value);
        }
        throw new UnexpectedValueException('Expected number.');
    }

    /**
     * {@inheritdoc}
     */
    public function supports($value = null)
    {
        if (null !== $value && !is_numeric($value)) {
            return false;
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function equals(CharacteristicInterface $characteristic)
    {
        return ($characteristic instanceof NumberCharacteristic)
            && ($characteristic->getNumber() === $this->number);
    }

    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return 'number';
    }
}
