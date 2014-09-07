<?php

namespace Ekyna\Component\Characteristics\Entity;

use Ekyna\Component\Characteristics\Exception\UnexpectedValueException;
use Ekyna\Component\Characteristics\Model\CharacteristicInterface;
use Ekyna\Component\Characteristics\Schema\Definition;

/**
 * Class DatetimeCharacteristic
 * @package Ekyna\Component\Characteristics\Entity
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class DatetimeCharacteristic extends AbstractCharacteristic
{
    /**
     * @var \DateTime
     */
    private $datetime;

    /**
     * Sets the datetime.
     *
     * @param \DateTime $datetime
     * @return DatetimeCharacteristic
     */
    public function setDatetime(\DateTime $datetime = null)
    {
        $this->datetime = $datetime;

        return $this;
    }

    /**
     * Returns the datetime.
     *
     * @return \DateTime
     */
    public function getDatetime()
    {
        return $this->datetime;
    }

    /**
     * {@inheritdoc}
     */
    public function getValue()
    {
        return $this->getDatetime();
    }

    /**
     * {@inheritdoc}
     */
    public function setValue($value = null)
    {
        if ($this->supports($value)) {
            return $this->setDatetime($value);
        }
        throw new UnexpectedValueException('Expected \Datetime.');
    }

    /**
     * {@inheritdoc}
     */
    public function supports($value = null)
    {
        if (null !== $value && !$value instanceof \DateTime) {
            return false;
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function equals(CharacteristicInterface $characteristic)
    {
        return ($characteristic instanceof DatetimeCharacteristic)
            && ($characteristic->getDatetime() === $this->getDatetime());
    }

    /**
     * {@inheritdoc}
     */
    public function display(Definition $definition)
    {
        if (!$this->isNull()) {
            return $this->datetime->format($definition->getParameter('format'));
        }
        return parent::display($definition);
    }

    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return 'datetime';
    }
}
