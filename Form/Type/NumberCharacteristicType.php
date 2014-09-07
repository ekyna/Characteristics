<?php

namespace Ekyna\Component\Characteristics\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class NumberCharacteristicType
 * @package Ekyna\Component\Characteristics\Form\Type
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class NumberCharacteristicType extends AbstractCharacteristicType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('number', 'number', array(
            'label' => false,
            'required' => false,
            'precision' => 3,
        ));
    }

    /**
     * {@inheritDoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        parent::setDefaultOptions($resolver);

        $resolver->setDefaults(array(
            'data_class' => 'Ekyna\Component\Characteristics\Entity\NumberCharacteristic'
        ));
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'ekyna_number_characteristic';
    }
} 