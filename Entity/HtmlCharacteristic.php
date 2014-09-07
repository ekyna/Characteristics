<?php

namespace Ekyna\Component\Characteristics\Entity;

use Ekyna\Component\Characteristics\Model\CharacteristicInterface;

/**
 * Class HtmlCharacteristic
 * @package Ekyna\Component\Characteristics\Entity
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class HtmlCharacteristic extends AbstractCharacteristic
{
    /**
     * @var string
     */
    private $html;

    /**
     * @param string $html
     *
     * @return HtmlCharacteristic
     */
    public function setHtml($html = null)
    {
        $this->html = $html !== null ? trim($html) : $html;

        return $this;
    }

    /**
     * @return string
     */
    public function getHtml()
    {
        return $this->html;
    }

    /**
     * {@inheritdoc}
     */
    public function getValue()
    {
        return $this->html;
    }

    /**
     * {@inheritdoc}
     */
    public function equals(CharacteristicInterface $characteristic)
    {
        return ($characteristic instanceof HtmlCharacteristic)
            && ($characteristic->getHtml() === $this->html);
    }

    /**
     * {@inheritdoc}
     */
    public function isNull()
    {
        return 0 === strlen($this->html);
    }
}
