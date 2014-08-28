<?php

namespace Ekyna\Component\Characteristics\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class BooleanCharacteristicType
 * @package Ekyna\Component\Characteristics\Form\Type
 */
class BooleanCharacteristicType extends AbstractCharacteristicType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('boolean', 'choice', array(
            'label' => false,
            'required' => false,
            'expanded' => true,
            'choices' => array(
                1 => 'Oui',
                0 => 'Non',
                null => 'NC',
            ),
            'attr' => array(
                'class' => 'inline',
            ),
        ));
    }

    /**
     * {@inheritDoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        parent::setDefaultOptions($resolver);

        $resolver->setDefaults(array(
            'data_class' => 'Ekyna\Component\Characteristics\Entity\BooleanCharacteristic'
        ));
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'ekyna_boolean_characteristic';
    }
}
