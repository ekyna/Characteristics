<?php

namespace Ekyna\Component\Characteristics\View;

/**
 * Class Group
 * @package Ekyna\Component\Characteristics\View
 */
class Group
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $title;

    /**
     * @var array
     */
    public $entries;

    /**
     * Constructor
     *
     * @param string $name
     * @param string $title
     */
    public function __construct($name, $title)
    {
        $this->name = $name;
        $this->title = $title;
        $this->entries = [];
    }
}
