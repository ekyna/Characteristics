<?php

namespace Ekyna\Component\Characteristics\Entity;

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
     * @param \DateTime $datetime
     */
    public function setDatetime(\DateTime $datetime = null)
    {
        $this->datetime = $datetime;
    }

    /**
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
        return $this->datetime;
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
    public function equals(CharacteristicInterface $characteristic)
    {
        return ($characteristic instanceof DatetimeCharacteristic)
            && ($characteristic->getDatetime() === $this->datetime);
    }
}
