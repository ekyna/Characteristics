<?php

namespace Ekyna\Component\Characteristics\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Ekyna\Component\Characteristics\Model\CharacteristicInterface;
use Ekyna\Component\Characteristics\Model\CharacteristicsInterface;

/**
 * Class AbstractCharacteristics
 * @package Ekyna\Component\Characteristics\Entity
 */
abstract class AbstractCharacteristics implements CharacteristicsInterface//, \IteratorAggregate, \ArrayAccess
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var ArrayCollection
     */
    protected $characteristics;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->characteristics = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritDoc}
     */
    public function setCharacteristics(ArrayCollection $characteristics)
    {
        foreach($this->characteristics as $characteristic) {
            $characteristic->setCharacteristics($this);
        }
        $this->characteristics = $characteristics;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function hasCharacteristic(CharacteristicInterface $characteristic)
    {
        return $this->characteristics->contains($characteristic);
    }

    /**
     * {@inheritDoc}
     */
    public function addCharacteristic(CharacteristicInterface $characteristic)
    {
        if (!$this->hasCharacteristic($characteristic)) {
            $characteristic->setCharacteristics($this);
            $this->characteristics->add($characteristic);
        }

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function removeCharacteristic(CharacteristicInterface $characteristic)
    {
        $this->characteristics->removeElement($characteristic);

        return $this;
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
    public function getCharacteristicByName($name)
    {
        foreach ($this->characteristics as $characteristic) {
            if ($characteristic->getName() === $name) {
                return $characteristic;
            }
        }
        return null;
    }

    /*public function getIterator()
    {
        return $this->characteristics;
    }

    public function offsetSet($name, $characteristic)
    {
        $this->characteristics->offsetSet($name, $characteristic);
    }

    public function offsetExists($name)
    {
        return $this->characteristics->offsetExists($name);
    }

    public function offsetUnset($name)
    {
        $this->characteristics->offsetUnset($name);
    }

    public function offsetGet($name)
    {
        return $this->characteristics->offsetGet($name);
    }*/
}
