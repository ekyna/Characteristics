<?php

namespace Ekyna\Component\Characteristics\Tests\Fixtures;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Product
 * @package Ekyna\Component\Characteristics\Tests\Fixtures
 */
class Product
{
    /**
     * @var \Ekyna\Component\Characteristics\Tests\Fixtures\ProductCharacteristics
     * @ORM\OneToOne(targetEntity="Ekyna\Component\Characteristics\Tests\Fixtures\ProductCharacteristics")
     * @Schema("product")
     */
    protected $characteristics;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    protected $variants;

    /**
     * @var \Ekyna\Component\Characteristics\Tests\Fixtures\Brand
     */
    protected $brand;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->variants = new ArrayCollection();
        $this->characteristics = new ProductCharacteristics();
    }

    /**
     * @param \Ekyna\Component\Characteristics\Tests\Fixtures\ProductCharacteristics $characteristics
     * @return \Ekyna\Component\Characteristics\Tests\Fixtures\Product
     */
    public function setCharacteristics(ProductCharacteristics $characteristics)
    {
        $this->characteristics = $characteristics;

        return $this;
    }

    /**
     * @return \Ekyna\Component\Characteristics\Tests\Fixtures\ProductCharacteristics
     */
    public function getCharacteristics()
    {
        return $this->characteristics;
    }

    /**
     * @param Variant $variant
     * @return \Ekyna\Component\Characteristics\Tests\Fixtures\Product
     */
    public function addVariant(Variant $variant)
    {
        if (!$this->variants->contains($variant)) {
            $this->variants->add($variant);
        }

        return $this;
    }

    /**
     * @param ArrayCollection $variants
     * @return \Ekyna\Component\Characteristics\Tests\Fixtures\Product
     */
    public function setVariants(ArrayCollection $variants)
    {
        $this->variants = $variants;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getVariants()
    {
        return $this->variants;
    }

    /**
     * @param \Ekyna\Component\Characteristics\Tests\Fixtures\Brand $brand
     * @return \Ekyna\Component\Characteristics\Tests\Fixtures\Product
     */
    public function setBrand(Brand $brand)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * @return \Ekyna\Component\Characteristics\Tests\Fixtures\Brand
     */
    public function getBrand()
    {
        return $this->brand;
    }
}
