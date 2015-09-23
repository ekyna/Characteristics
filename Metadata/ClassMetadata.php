<?php
namespace Ekyna\Component\Characteristics\Metadata;

use Metadata\MergeableClassMetadata;

class ClassMetadata extends MergeableClassMetadata
{
    public $schema;
    public $inherit;

    public function serialize()
    {
        return serialize([
            $this->schema,
            $this->inherit,
            parent::serialize(),
        ]);
    }

    public function unserialize($str)
    {
        list(
            $this->schema,
            $this->inherit,
            $parentStr
        ) = unserialize($str);

        parent::unserialize($parentStr);
    }
}
