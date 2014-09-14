<?php

namespace Ekyna\Component\Characteristics\Entity;

use Ekyna\Component\Characteristics\Model\CharacteristicInterface;
use Ekyna\Component\Characteristics\Model\CharacteristicsInterface;
use Ekyna\Component\Characteristics\Schema\Definition;

/**
 * Class AbstractCharacteristic
 * @package Ekyna\Component\Characteristics\Entity
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
abstract class AbstractCharacteristic implements CharacteristicInterface
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var \Ekyna\Component\Characteristics\Model\CharacteristicsInterface
     */
    protected $characteristics;

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritDoc}
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * {@inheritDoc}
     */
    public function setCharacteristics(CharacteristicsInterface $characteristics)
    {
        $this->characteristics = $characteristics;
    }

    /**
     * {@inheritDoc}
     */
    public function getCharacteristics()
    {
        return $this->characteristics;
    }

    /**
     * {@inheritDoc}
     */
    abstract public function getValue();

    /**
     * {@inheritDoc}
     */
    abstract public function setValue($value = null);

    /**
     * {@inheritDoc}
     */
    abstract public function supports($value = null);

    /**
     * {@inheritDoc}
     */
    abstract public function equals(CharacteristicInterface $characteristic);

    /**
     * {@inheritDoc}
     */
    public function isNull()
    {
        return null === $this->getValue();
    }

    /**
     * {@inheritDoc}
     */
    public function display(Definition $definition)
    {
        if ($this->isNull()) {
            return 'NC';
        }

        return sprintf($definition->getFormat(), (string)$this->getValue());
    }

    /**
     * {@inheritDoc}
     */
    abstract public function getType();
}
