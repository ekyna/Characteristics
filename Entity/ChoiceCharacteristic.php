<?php

namespace Ekyna\Component\Characteristics\Entity;

use Ekyna\Component\Characteristics\Model\CharacteristicInterface;

/**
 * Class ChoiceCharacteristic
 * @package Ekyna\Component\Characteristics\Entity
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class ChoiceCharacteristic extends AbstractCharacteristic
{
    /**
     * @var ChoiceCharacteristicValue
     */
    protected $choice;

    /**
     * @param \Ekyna\Component\Characteristics\Entity\ChoiceCharacteristicValue $choice
     */
    public function setChoice(ChoiceCharacteristicValue $choice = null)
    {
        $this->choice = $choice;
    }

    /**
     * @return \Ekyna\Component\Characteristics\Entity\ChoiceCharacteristicValue
     */
    public function getChoice()
    {
        return $this->choice;
    }

    /**
     * {@inheritdoc}
     */
    public function getValue()
    {
        return ($this->choice instanceof ChoiceCharacteristicValue) ? $this->choice->getValue() : null;
    }

    /**
     * {@inheritdoc}
     */
    public function equals(CharacteristicInterface $characteristic)
    {
        return ($characteristic instanceof ChoiceCharacteristic)
            && ($characteristic->getChoice() === $this->choice);
    }
}
