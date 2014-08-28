<?php
namespace Ekyna\Component\Characteristics\Entity;
use Ekyna\Component\Characteristics\Model\CharacteristicInterface;

/**
 * Class TextCharacteristic
 * @package Ekyna\Component\Characteristics\Entity
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
        $this->text = $text !== null ? trim($text) : $text;

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
