<?php

namespace Ekyna\Component\Characteristics\Form\Type;

use Doctrine\Common\Persistence\ObjectManager;
use Ekyna\Component\Characteristics\Form\EventListener\CharacteristicsResizeListener;
use Ekyna\Component\Characteristics\ManagerInterface;
use Ekyna\Component\Characteristics\Model\CharacteristicsInterface;
use Ekyna\Component\Characteristics\Schema\Schema;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class CharacteristicsCollectionType
 * @package Ekyna\Component\Characteristics\Form\Type
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class CharacteristicsCollectionType extends AbstractType
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
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addEventSubscriber(
            new CharacteristicsResizeListener(
                $this->manager,
                $this->em,
                $this->schema,
                $this->parentDatas
            )
        );
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'ekyna_characteristics_collection';
    }
}
