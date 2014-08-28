<?php

namespace Ekyna\Component\Characteristics\Form\EventListener;

use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Persistence\ObjectManager;
use Ekyna\Component\Characteristics\Entity\BooleanCharacteristic;
use Ekyna\Component\Characteristics\Entity\ChoiceCharacteristic;
use Ekyna\Component\Characteristics\Entity\NumberCharacteristic;
use Ekyna\Component\Characteristics\Entity\TextCharacteristic;
use Ekyna\Component\Characteristics\Form\Type\GroupType;
use Ekyna\Component\Characteristics\ManagerInterface;
use Ekyna\Component\Characteristics\Model\CharacteristicInterface;
use Ekyna\Component\Characteristics\Model\CharacteristicsInterface;
use Ekyna\Component\Characteristics\Schema\Definition;
use Ekyna\Component\Characteristics\Schema\Schema;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\Exception\UnexpectedTypeException;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;

/**
 * Class CharacteristicsResizeListener
 * @package Ekyna\Component\Characteristics\Form\EventListener
 */
class CharacteristicsResizeListener implements EventSubscriberInterface
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
     * @var \Ekyna\Component\Characteristics\Schema\Schema
     */
    private $schema;

    /**
     * @var \Ekyna\Component\Characteristics\Model\CharacteristicsInterface
     */
    private $parentDatas;

    /**
     * Constructor.
     *
     * @param \Ekyna\Component\Characteristics\ManagerInterface $manager
     * @param \Doctrine\Common\Persistence\ObjectManager $em
     * @param \Ekyna\Component\Characteristics\Schema\Schema $schema
     * @param \Ekyna\Component\Characteristics\Model\CharacteristicsInterface $parentDatas
     */
    public function __construct(ManagerInterface $manager, ObjectManager $em, Schema $schema, CharacteristicsInterface $parentDatas = null)
    {
        $this->manager = $manager;
        $this->em = $em;
        $this->schema = $schema;
        $this->parentDatas = $parentDatas;
    }

    /**
     * {@inheritDoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
            FormEvents::PRE_SET_DATA => 'preSetData',
            FormEvents::SUBMIT => array('onSubmit', 50),
        );
    }

    /**
     * Pre set data event handler.
     *
     * @param \Symfony\Component\Form\FormEvent $event
     *
     * @throws \Symfony\Component\Form\Exception\UnexpectedTypeException
     *
     * @throws \InvalidArgumentException
     */
    public function preSetData(FormEvent $event)
    {
        $form = $event->getForm();
        $data = $event->getData();

        if (null === $data) {
            throw new \InvalidArgumentException('Can\'t handle null datas.');
        }

        if (!is_array($data) && !($data instanceof \Traversable && $data instanceof \ArrayAccess)) {
            throw new UnexpectedTypeException($data, 'array or (\Traversable and \ArrayAccess)');
        }

        foreach ($form as $name => $child) {
            $form->remove($name);
        }

        foreach ($this->schema->getGroups() as $schemaGroup) {
            $form->add($schemaGroup->getName(), new GroupType(), array('label' => $schemaGroup->getTitle()));
            $groupForm = $form->get($schemaGroup->getName());
            foreach ($schemaGroup->getDefinitions() as $schemaDefinition) {
                $this->appendProperForm($groupForm, $schemaDefinition);
                $this->appendProperData($data, $schemaDefinition);
            }
        }

        $event->setData($data);
    }

    /**
     * Submit event handler.
     *
     * @param \Symfony\Component\Form\FormEvent $event
     *
     * @throws \Symfony\Component\Form\Exception\UnexpectedTypeException
     *
     * @throws \RuntimeException
     */
    public function onSubmit(FormEvent $event)
    {
        $data = $event->getData();

        if (null === $data) {
            $data = array();
        }

        if (!is_array($data) && !($data instanceof \Traversable && $data instanceof \ArrayAccess)) {
            throw new UnexpectedTypeException($data, 'array or (\Traversable and \ArrayAccess)');
        }

        foreach ($this->schema->getGroups() as $schemaGroup) {
            foreach ($schemaGroup->getDefinitions() as $schemaDefinition) {
                $name = $schemaDefinition->getIdentifier();
                if ($data->offsetExists($name)) {
                    $characteristic = $data->offsetGet($name);
                    if ($this->isNullOrEqualsParentData($characteristic)) {
                        $data->offsetUnset($name);
                        $this->em->remove($characteristic);
                    } else {
                        $characteristic->setName($name);
                    }
                } else {
                    throw new \RuntimeException(sprintf('Missing [%s] characteristic data.', $name));
                }
            }
        }

        $event->setData($data);
    }

    /**
     * Returns whether the characteristic is null or equals parent's or not.
     *
     * @param \Ekyna\Component\Characteristics\Model\CharacteristicInterface $characteristic
     *
     * @return bool
     */
    private function isNullOrEqualsParentData(CharacteristicInterface $characteristic)
    {
        if ($characteristic->isNull()) {
            return true;
        } elseif (null !== $this->parentDatas &&
            null !== $parentCharacteristic = $this->parentDatas->getCharacteristicByName($characteristic->getName())) {
            return $parentCharacteristic->equals($characteristic);
        }

        return false;
    }

    /**
     * Appends a form that matches the characteristic type.
     *
     * @param \Symfony\Component\Form\FormInterface $form
     *
     * @param \Ekyna\Component\Characteristics\Schema\Definition $definition
     */
    private function appendProperForm(FormInterface $form, Definition $definition)
    {
        $name = $definition->getIdentifier();
        if ($form->has($name)) {
            return;
        }

        $type = sprintf('ekyna_%s_characteristic', $definition->getType());
        $options = array();
        if ($definition->getType() == 'choice') {
            $options['identifier'] = $name;
        }

        $parentData = null;
        if (null !== $this->parentDatas && null !== $characteristic = $this->parentDatas->getCharacteristicByName($name)) {
            $parentData = $characteristic->display($definition);
        }

        $form->add($name, $type, array_merge(array(
            'property_path' => '[' . $name . ']',
            'label' => $definition->getTitle(),
            'parent_data' => $parentData,
        ), $options));
    }

    /**
     * Fills the data with the proper characteristic type.
     *
     * @param \Doctrine\Common\Collections\Collection $data
     *
     * @param \Ekyna\Component\Characteristics\Schema\Definition $definition
     *
     * @throws \InvalidArgumentException
     */
    private function appendProperData(Collection $data, Definition $definition)
    {
        $name = $definition->getIdentifier();
        if ($data->offsetExists($name)) {
            return;
        }
        $characteristic = null;
        switch ($definition->getType()) {
            case 'text' :
                $characteristic = new TextCharacteristic();
                break;
            case 'number' :
                $characteristic = new NumberCharacteristic();
                break;
            case 'boolean' :
                $characteristic = new BooleanCharacteristic();
                break;
            case 'choice' :
                $characteristic = new ChoiceCharacteristic();
                break;
            default:
                throw new \InvalidArgumentException('Unexpected characteristic type.');
        }
        $characteristic->setName($name);
        $data->set($name, $characteristic);
    }
}
