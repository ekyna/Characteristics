<?php

namespace Ekyna\Component\Characteristics\Model;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Interface CharacteristicsInterface
 * @package Ekyna\Component\Characteristics\Model
 * @author Étienne Dauvergne <contact@ekyna.com>
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
     * @return CharacteristicInterface[]
     */
    public function getCharacteristics();

    /**
     * Finds a characteristic by identifier.
     *
     * @param string $identifier
     *
     * @return CharacteristicInterface|null
     */
    public function findCharacteristicByIdentifier($identifier);

    /**
     * Returns the date of the last update.
     *
     * @return \DateTime
     */
    public function getUpdatedAt();
}
