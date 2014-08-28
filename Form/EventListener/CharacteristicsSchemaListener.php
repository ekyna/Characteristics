<?php

namespace Ekyna\Component\Characteristics\Form\EventListener;

use Doctrine\Common\Persistence\ObjectManager;
use Ekyna\Component\Characteristics\Entity\AbstractCharacteristics;
use Ekyna\Component\Characteristics\Form\Type\CharacteristicsCollectionType;
use Ekyna\Component\Characteristics\ManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\PropertyAccess\PropertyAccess;

/**
 * Class CharacteristicsSchemaListener
 * @package Ekyna\Component\Characteristics\Form\EventListener
 */
class CharacteristicsSchemaListener implements EventSubscriberInterface
{
    /**
     * @var \Ekyna\Component\Characteristics\ManagerInterface
     */
    private $manager;

    /**
     * @var \Doctrine\Common\Persistence\ObjectManager
     */
    private $em;

    /**
     * Constructor.
     *
     * @param \Ekyna\Component\Characteristics\ManagerInterface $manager
     * @param \Doctrine\Common\Persistence\ObjectManager $em
     */
    public function __construct(ManagerInterface $manager, ObjectManager $em)
    {
        $this->manager = $manager;
        $this->em = $em;
    }

    /**
     * {@inheritDoc}
     */
    public static function getSubscribedEvents()
    {
        return array(FormEvents::PRE_SET_DATA => 'preSetData');
    }

    /**
     * {@inheritDoc}
     */
    public function preSetData(FormEvent $event)
    {
        $characteristics = $event->getData();
        if (!$characteristics instanceof AbstractCharacteristics) {
            throw new \InvalidArgumentException(sprintf('Expected AbstractCharacteristics instance, got "%s".', get_class($characteristics)));
        }

        $schema = $this->manager->getSchemaForClass($characteristics);
        $parentCharacteristics = $this->manager->getInheritedCharacteristics($characteristics);

        $form = $event->getForm();
        $form->add('characteristics', new CharacteristicsCollectionType($this->manager, $this->em, $schema, $parentCharacteristics), array(
            'label' => false,
            'by_reference' => false,
        ));
    }
}
