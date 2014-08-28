<?php

namespace Ekyna\Component\Characteristics\Tests\Fixtures;

use Ekyna\Component\Characteristics\Entity\AbstractCharacteristics;
use Ekyna\Component\Characteristics\Annotation as Characteristics;

/**
 * Class VariantCharacteristics
 * @package Ekyna\Component\Characteristics\Tests\Fixtures
 *
 * @Characteristics\Schema("product")
 * @Characteristics\Inherit("variant.product.characteristics")
 */
class VariantCharacteristics extends AbstractCharacteristics
{
    /**
     * @var \Ekyna\Component\Characteristics\Tests\Fixtures\Variant
     */
    private $variant;

    /**
     * @param \Ekyna\Component\Characteristics\Tests\Fixtures\Variant $variant
     *
     * @return \Ekyna\Component\Characteristics\Tests\Fixtures\VariantCharacteristics
     */
    public function setVariant($variant)
    {
        $this->variant = $variant;

        return $this;
    }

    /**
     * @return \Ekyna\Component\Characteristics\Tests\Fixtures\Variant
     */
    public function getVariant()
    {
        return $this->variant;
    }
}
