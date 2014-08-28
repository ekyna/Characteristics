<?php

namespace Ekyna\Component\Characteristics\Model;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Interface CharacteristicsSubjectInterface
 * @package Ekyna\Component\Characteristics\Model
 */
interface CharacteristicsInterface
{
    /**
     * Sets the characteristics.
     *
     * @param ArrayCollection $characteristics
     *
     * @return CharacteristicsInterface
     */
    public function setCharacteristics(ArrayCollection $characteristics);

    /**
     * Returns whether the subject has the given characteristic or not.
     *
     * @param CharacteristicInterface $characteristic
     *
     * @return bool
     */
    public function hasCharacteristic(CharacteristicInterface $characteristic);

    /**
     * Adds a characteristic.
     *
     * @param CharacteristicInterface $characteristic
     *
     * @return CharacteristicsInterface
     */
    public function addCharacteristic(CharacteristicInterface $characteristic);

    /**
     * Removes a characteristic.
     *
     * @param CharacteristicInterface $characteristic
     *
     * @return CharacteristicsInterface
     */
    public function removeCharacteristic(CharacteristicInterface $characteristic);

    /**
     * Returns the characteristics.
     *
     * @return ArrayCollection
     */
    public function getCharacteristics();

    /**
     * Returns a characteristic by his name.
     *
     * @param string $name
     *
     * @return CharacteristicInterface|NULL
     */
    public function getCharacteristicByName($name);
} 