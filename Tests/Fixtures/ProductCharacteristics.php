<?php

namespace Ekyna\Component\Characteristics\Tests\Fixtures;

use Ekyna\Component\Characteristics\Entity\AbstractCharacteristics;
use Ekyna\Component\Characteristics\Annotation as Characteristics;

/**
 * Class ProductCharacteristics
 * @package Ekyna\Component\Characteristics\Tests\Fixtures
 *
 * @Characteristics\Schema("product")
 */
class ProductCharacteristics extends AbstractCharacteristics
{
    /**
     * @var \Ekyna\Component\Characteristics\Tests\Fixtures\Product
     */
    private $product;

    /**
     * @param \Ekyna\Component\Characteristics\Tests\Fixtures\Product $product
     *
     * @return \Ekyna\Component\Characteristics\Tests\Fixtures\ProductCharacteristics
     */
    public function setProduct($product)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * @return \Ekyna\Component\Characteristics\Tests\Fixtures\Product
     */
    public function getProduct()
    {
        return $this->product;
    }
}
