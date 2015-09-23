<?php

namespace Ekyna\Component\Characteristics\Form\Type;

use Doctrine\Common\Persistence\ObjectManager;
use Ekyna\Component\Characteristics\Form\EventListener\CharacteristicsFormSubscriber;
use Ekyna\Component\Characteristics\Form\EventListener\CharacteristicsSchemaListener;
use Ekyna\Component\Characteristics\ManagerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class CharacteristicsType
 * @package Ekyna\Component\Characteristics\Form\Type
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class CharacteristicsType extends AbstractType
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
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->addEventSubscriber(new CharacteristicsSchemaListener($this->manager, $this->em))
        ;
    }

    /**
     * {@inheritDoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setDefaults([
                'data_class' => 'Ekyna\Component\Characteristics\Entity\AbstractCharacteristics'
            ]);
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'ekyna_characteristics';
    }
}
