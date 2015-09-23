<?php

namespace Ekyna\Component\Characteristics\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class TextCharacteristicType
 * @package Ekyna\Component\Characteristics\Form\Type
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class TextCharacteristicType extends AbstractCharacteristicType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('text', 'text', [
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
            'data_class' => 'Ekyna\Component\Characteristics\Entity\TextCharacteristic'
        ]);
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'ekyna_text_characteristic';
    }
} 