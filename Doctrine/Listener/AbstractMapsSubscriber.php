<?php

namespace Ekyna\Component\Characteristics\Doctrine\Listener;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LoadClassMetadataEventArgs;
use Doctrine\ORM\Events;

/**
 * Class AbstractMapsSubscriber
 * @package Ekyna\Component\Characteristics\Doctrine\Listener
 */
class AbstractMapsSubscriber implements EventSubscriber
{
    /**
     * The abstract characteristics full qualified class name.
     *
     * @var string
     */
    const ROOT_CHARACTERISTICS_CLASS  = 'Ekyna\Component\Characteristics\Entity\AbstractCharacteristics';

    /**
     * The characteristics discriminator classes map [name => fqcn].
     *
     * @var array
     */
    protected $characteristicsClassesMap;

    public function __construct($characteristicsClassesMap)
    {
        $this->characteristicsClassesMap = $characteristicsClassesMap;
    }

    /**
     * Sets the discriminator maps on AbstractCharacteristics entity mappings.
     *
     * @param LoadClassMetadataEventArgs $eventArgs
     */
    public function loadClassMetadata(LoadClassMetadataEventArgs $eventArgs)
    {
        $metadata = $eventArgs->getClassMetadata();

        if ($metadata->getName() === self::ROOT_CHARACTERISTICS_CLASS) {
            $metadata->setDiscriminatorMap($this->characteristicsClassesMap);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getSubscribedEvents()
    {
        return array(
            Events::loadClassMetadata,
        );
    }
}
