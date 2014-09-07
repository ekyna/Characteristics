<?php

namespace Ekyna\Component\Characteristics\Form\Type;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class ChoiceCharacteristicType
 * @package Ekyna\Component\Characteristics\Form\Type
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class ChoiceCharacteristicType extends AbstractCharacteristicType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('choice', 'entity', array(
            'label' => false,
            'required' => false,
            'empty_value' => 'Undefined',
            'empty_data'  => null,
            'class' => 'Ekyna\Component\Characteristics\Entity\ChoiceCharacteristicValue',
            'property' => 'value',
            'query_builder' => function(EntityRepository $er) use ($options) {
                return $er
                    ->createQueryBuilder('c')
                    ->where('c.name = :name')
                    ->setParameter('name', $options['identifier'])
                    ->orderBy('c.name', 'ASC')
                ;
            }
        ));
    }

    /**
     * {@inheritDoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        parent::setDefaultOptions($resolver);

        $resolver
            ->setDefaults(array(
                'data_class' => 'Ekyna\Component\Characteristics\Entity\ChoiceCharacteristic',
                'identifier' => null
            ))
            ->setAllowedTypes(array(
                'identifier' => 'string'
            ))
            ->setRequired(array('identifier'))
        ;
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'ekyna_choice_characteristic';
    }
}
