<?php

namespace Ekyna\Component\Characteristics\Entity;

use Ekyna\Component\Characteristics\Model\CharacteristicInterface;

/**
 * Class NumberCharacteristic
 * @package Ekyna\Component\Characteristics\Entity
 */
class NumberCharacteristic extends AbstractCharacteristic
{
    /**
     * @var integer
     */
    private $number;

    /**
     * @param int $number
     */
    public function setNumber($number = null)
    {
        $this->number = $number;
    }

    /**
     * @return int
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
