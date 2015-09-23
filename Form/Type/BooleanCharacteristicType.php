<?php

namespace Ekyna\Component\Characteristics\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class BooleanCharacteristicType
 * @package Ekyna\Component\Characteristics\Form\Type
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class BooleanCharacteristicType extends AbstractCharacteristicType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('boolean', 'choice', [
            'label' => false,
            'required' => false,
            'expanded' => true,
            'choices' => [
                1 => 'Oui',
                0 => 'Non',
                null => 'NC',
            ],
            'attr' => [
                'class' => 'inline',
            ],
        ]);
    }

    /**
     * {@inheritDoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);

        $resolver->setDefaults([
            'data_class' => 'Ekyna\Component\Characteristics\Entity\BooleanCharacteristic'
        ]);
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'ekyna_boolean_characteristic';
    }
}
