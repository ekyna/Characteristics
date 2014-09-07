<?php

namespace Ekyna\Component\Characteristics\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

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
        $builder->add('html', 'textarea', array(
            'label' => false,
            'required' => false,
            'attr' => array(
                'class' => 'tinymce',
                'data-theme' => 'simple',
            )
        ));
    }

    /**
     * {@inheritDoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        parent::setDefaultOptions($resolver);

        $resolver->setDefaults(array(
            'data_class' => 'Ekyna\Component\Characteristics\Entity\HtmlCharacteristic'
        ));
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'ekyna_html_characteristic';
    }
} 