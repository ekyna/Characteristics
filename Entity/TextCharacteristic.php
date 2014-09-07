<?php

namespace Ekyna\Component\Characteristics\Entity;

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
     * @param string $text
     *
     * @return TextCharacteristic
     */
    public function setText($text = null)
    {
        $text = trim($text);
        $this->text = 0 < strlen($text) ? $text : null;

        return $this;
    }

    /**
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
        return $this->text;
    }

    /**
     * {@inheritdoc}
     */
    public function equals(CharacteristicInterface $characteristic)
    {
        return ($characteristic instanceof TextCharacteristic)
            && ($characteristic->getText() === $this->text);
    }

    /**
     * {@inheritdoc}
     */
    public function isNull()
    {
        return 0 === strlen($this->text);
    }
}
