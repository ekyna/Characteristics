<?php

namespace Ekyna\Component\Characteristics\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class DatetimeCharacteristicType
 * @package Ekyna\Component\Characteristics\Form\Type
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class DatetimeCharacteristicType extends AbstractCharacteristicType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('datetime', 'datetime', [
            'label' => false,
            'required' => false,
        ]);
    }

    /**
     * {@inheritDoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);

        $resolver->setDefaults([
            'data_class' => 'Ekyna\Component\Characteristics\Entity\DatetimeCharacteristic'
        ]);
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'ekyna_datetime_characteristic';
    }
} 