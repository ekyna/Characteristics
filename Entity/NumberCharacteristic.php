<?php

namespace Ekyna\Component\Characteristics\Entity;

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
     * @param float $number
     */
    public function setNumber($number = null)
    {
        $this->number = null !== $number ? floatval($number) : null;
    }

    /**
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
    public function equals(CharacteristicInterface $characteristic)
    {
        return ($characteristic instanceof NumberCharacteristic)
            && ($characteristic->getNumber() === $this->number);
    }
}
