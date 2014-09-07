<?php

namespace Ekyna\Component\Characteristics\Entity;

use Ekyna\Component\Characteristics\Exception\UnexpectedValueException;
use Ekyna\Component\Characteristics\Model\CharacteristicInterface;

/**
 * Class TextCharacteristic
 * @package Ekyna\Component\Characteristics\Entity
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class TextCharacteristic extends AbstractCharacteristic
{
    /**
     * @var string
     */
    private $text;

    /**
     * Sets the text.
     *
     * @param string $text
     * @return TextCharacteristic
     */
    public function setText($text = null)
    {
        $text = trim($text);
        $this->text = 0 < strlen($text) ? $text : null;

        return $this;
    }

    /**
     * Returns the text.
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * {@inheritdoc}
     */
    public function getValue()
    {
        return $this->getText();
    }

    /**
     * {@inheritdoc}
     */
    public function setValue($value = null)
    {
        if ($this->supports($value)) {
            return $this->setText($value);
        }
        throw new UnexpectedValueException('Expected string.');
    }

    /**
     * {@inheritdoc}
     */
    public function supports($value = null)
    {
        if (null !== $value && !is_string($value)) {
            return false;
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function equals(CharacteristicInterface $characteristic)
    {
        return ($characteristic instanceof TextCharacteristic)
            && ($characteristic->getText() === $this->getText());
    }

    /**
     * {@inheritdoc}
     */
    public function isNull()
    {
        return 0 === strlen($this->text);
    }

    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return 'text';
    }
}
