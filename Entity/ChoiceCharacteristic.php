<?php

namespace Ekyna\Component\Characteristics\Entity;

use Ekyna\Component\Characteristics\Exception\UnexpectedValueException;
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
     * Sets the choice.
     *
     * @param ChoiceCharacteristicValue $choice
     * @return ChoiceCharacteristic
     */
    public function setChoice(ChoiceCharacteristicValue $choice = null)
    {
        $this->choice = $choice;

        return $this;
    }

    /**
     * Returns the choice.
     *
     * @return ChoiceCharacteristicValue
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
        return $this->getChoice();
    }

    /**
     * {@inheritdoc}
     */
    public function setValue($value = null)
    {
        if ($this->supports($value)) {
            return $this->setChoice($value);
        }
        throw new UnexpectedValueException('Expected Ekyna\Component\Characteristics\Entity\ChoiceCharacteristicValue.');
    }

    /**
     * {@inheritdoc}
     */
    public function equals(CharacteristicInterface $characteristic)
    {
        return ($characteristic instanceof ChoiceCharacteristic)
            && ($characteristic->getChoice() === $this->getChoice());
    }

    /**
     * {@inheritdoc}
     */
    public function supports($value = null)
    {
        if (null !== $value && !$value instanceof ChoiceCharacteristicValue) {
            return false;
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return 'choice';
    }
}
