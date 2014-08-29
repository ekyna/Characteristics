<?php

namespace Ekyna\Component\Characteristics\Tests\Fixtures;

/**
 * Class Brand
 * @package Ekyna\Component\Characteristics\Tests\Fixtures
 */
class Brand
{
    /**
     * @var string
     */
    private $title;

    /**
     * @param string $title
     *
     * @return Brand
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }
} 