<?php

namespace Ekyna\Component\Characteristics\Entity;

use Ekyna\Component\Characteristics\Model\CharacteristicInterface;
use Ekyna\Component\Characteristics\Schema\Definition;

/**
 * Class BooleanCharacteristic
 * @package Ekyna\Component\Characteristics\Entity
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class BooleanCharacteristic extends AbstractCharacteristic
{
    /**
     * @var boolean
     */
    protected $boolean;

    /**
     * @param boolean $boolean
     */
    public function setBoolean($boolean = null)
    {
        $this->boolean = null !== $boolean ? (bool) $boolean : null;
    }

    /**
     * @return boolean
     */
    public function getBoolean()
    {
        return $this->boolean;
    }

    /**
     * {@inheritdoc}
     */
    public function display(Definition $definition)
    {
        if (!$this->isNull()) {
             return $this->boolean ? 'Oui' : 'Non';
        }
        return parent::display($definition);
    }

    /**
     * {@inheritdoc}
     */
    public function getValue()
    {
        return $this->boolean;
    }

    /**
     * {@inheritdoc}
     */
    public function equals(CharacteristicInterface $characteristic)
    {
        return ($characteristic instanceof BooleanCharacteristic)
            && ($characteristic->getBoolean() === $this->boolean);
    }
} 