<?php

namespace Ekyna\Component\Characteristics\Entity;

use Ekyna\Component\Characteristics\Exception\UnexpectedValueException;
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
     * Sets the html.
     *
     * @param string $html
     * @return HtmlCharacteristic
     */
    public function setHtml($html = null)
    {
        $html = trim($html);
        $this->html = 0 < strlen($html) ? $html : null;

        return $this;
    }

    /**
     * Returns the html.
     *
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
        return $this->getHtml();
    }

    /**
     * {@inheritdoc}
     */
    public function setValue($value = null)
    {
        if ($this->supports($value)) {
            return $this->setHtml($value);
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
        return ($characteristic instanceof HtmlCharacteristic)
            && ($characteristic->getHtml() === $this->getHtml());
    }

    /**
     * {@inheritdoc}
     */
    public function isNull()
    {
        return 0 === strlen($this->html);
    }

    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return 'html';
    }
}
