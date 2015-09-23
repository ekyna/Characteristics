<?php

namespace Ekyna\Component\Characteristics\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class ChoiceCharacteristicValueType
 * @package Ekyna\Component\Characteristics\Form\Type
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class ChoiceCharacteristicValueType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('value', 'text', [
            'required' => true,
        ]);
    }

    /**
     * {@inheritDoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setDefaults([
                'data_class' => 'Ekyna\Component\Characteristics\Entity\ChoiceCharacteristicValue'
            ]);
    }

    public function getName()
    {
        return 'ekyna_choice_characteristic_value';
    }
}
