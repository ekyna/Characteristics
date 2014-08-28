<?php

namespace Ekyna\Component\Characteristics\View;

use Ekyna\Component\Characteristics\Schema\Definition;

/**
 * Class Entry
 * @package Ekyna\Component\Characteristics\View
 */
class Entry
{
    /**
     * @var string
     */
    public $definition;

    /**
     * @var string
     */
    public $value;

    /**
     * @var bool
     */
    public $inherited;

    /**
     * Constructor
     *
     * @param \Ekyna\Component\Characteristics\Schema\Definition $definition
     * @param mixed $value
     * @param bool $inherited
     */
    public function __construct(Definition $definition, $value, $inherited = false)
    {
        $this->definition = $definition;
        $this->value = $value;
        $this->inherited = $inherited;
    }
}
