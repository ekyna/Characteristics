<?php

namespace Ekyna\Component\Characteristics\Model;

use Ekyna\Component\Characteristics\Schema\Definition;

/**
 * Interface CharacteristicInterface
 * @package Ekyna\Component\Characteristics\Model
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
interface CharacteristicInterface
{
    /**
     * Sets the name.
     *
     * @param string $name
     * @return \Ekyna\Component\Characteristics\Model\CharacteristicsInterface
     */
    public function setName($name);

    /**
     * Returns the name.
     *
     * @return string
     */
    public function getName();

    /**
     * Sets the characteristics.
     *
     * @param \Ekyna\Component\Characteristics\Model\CharacteristicsInterface $characteristics
     */
    public function setCharacteristics(CharacteristicsInterface $characteristics);

    /**
     * Returns the characteristics.
     *
     * @return \Ekyna\Component\Characteristics\Model\CharacteristicsInterface
     */
    public function getCharacteristics();

    /**
     * Returns the formatted value for display.
     *
     * @param \Ekyna\Component\Characteristics\Schema\Definition
     *
     * @return string
     */
    public function display(Definition $definition);

    /**
     * Returns the value.
     *
     * @return mixed
     */
    public function getValue();

    /**
     * Sets the value.
     *
     * @param mixed
     *
     * @return \Ekyna\Component\Characteristics\Model\CharacteristicsInterface
     */
    public function setValue($value = null);

    /**
     * Returns whether the characteristic support the value type.
     *
     * @param mixed
     *
     * @return bool
     */
    public function supports($value = null);

    /**
     * Returns whether the given characteristic equals this one or not.
     *
     * @param CharacteristicInterface $characteristic
     *
     * @return bool
     */
    public function equals(CharacteristicInterface $characteristic);

    /**
     * Returns whether the characteristic is considered as null or not.
     *
     * @return mixed
     */
    public function isNull();

    /**
     * Returns the type string representation.
     *
     * @return mixed
     */
    public function getType();
}
