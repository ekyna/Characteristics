<?php

namespace Ekyna\Component\Characteristics\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class HtmlCharacteristicType
 * @package Ekyna\Component\Characteristics\Form\Type
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class HtmlCharacteristicType extends AbstractCharacteristicType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('html', 'textarea', [
            'label' => false,
            'required' => false,
            'attr' => [
                'class' => 'tinymce',
                'data-theme' => 'simple',
            ]
        ]);
    }

    /**
     * {@inheritDoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);

        $resolver->setDefaults([
            'data_class' => 'Ekyna\Component\Characteristics\Entity\HtmlCharacteristic'
        ]);
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'ekyna_html_characteristic';
    }
} 