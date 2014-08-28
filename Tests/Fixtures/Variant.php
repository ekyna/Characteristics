<?php

namespace Ekyna\Component\Characteristics\Tests\Fixtures;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Variant
 * @package Ekyna\Component\Characteristics\Tests\Fixtures
 *
 * @ORM\Table()
 * @ORM\Entity()
 */
class Variant
{
    /**
     * @var \Ekyna\Component\Characteristics\Tests\Fixtures\VariantCharacteristics
     * @ORM\OneToOne(targetEntity="Ekyna\Component\Characteristics\Tests\Fixtures\VariantCharacteristics")
     */
    protected $characteristics;

    /**
     * @var \Ekyna\Component\Characteristics\Tests\Fixtures\Product
     * @ORM\ManyToOne(targetEntity="Ekyna\Component\Characteristics\Tests\Fixtures\Product", cascade={"all"})
     */
    protected $product;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->characteristics = new VariantCharacteristics();
    }

    /**
     * @param \Ekyna\Component\Characteristics\Tests\Fixtures\Product $product
     *
     * @return \Ekyna\Component\Characteristics\Tests\Fixtures\Variant
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

    /**
     * @param \Ekyna\Component\Characteristics\Tests\Fixtures\VariantCharacteristics $characteristics
     *
     * @return \Ekyna\Component\Characteristics\Tests\Fixtures\Variant
     */
    public function setCharacteristics($characteristics)
    {
        $this->characteristics = $characteristics;

        return $this;
    }

    /**
     * @return \Ekyna\Component\Characteristics\Tests\Fixtures\VariantCharacteristics
     */
    public function getCharacteristics()
    {
        return $this->characteristics;
    }
}
