<?php

namespace Ekyna\Component\Characteristics\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Ekyna\Component\Characteristics\Model\CharacteristicInterface;
use Ekyna\Component\Characteristics\Model\CharacteristicsInterface;

/**
 * Class AbstractCharacteristics
 * @package Ekyna\Component\Characteristics\Entity
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
abstract class AbstractCharacteristics implements CharacteristicsInterface
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var AbstractCharacteristic[]
     */
    protected $characteristics;

    /**
     * @var \DateTime
     */
    protected $updatedAt;

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
    public function findCharacteristicByIdentifier($identifier)
    {
        foreach ($this->characteristics as $characteristic) {
            if ($characteristic->getIdentifier() === $identifier) {
                return $characteristic;
            }
        }
        return null;
    }

    /**
     * @param \DateTime $updatedAt
     */
    public function setUpdatedAt(\DateTime $updatedAt = null)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * {@inheritDoc}
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
}
