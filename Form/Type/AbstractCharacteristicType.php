<?php

namespace Ekyna\Component\Characteristics\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class AbstractCharacteristicType
 * @package Ekyna\Component\Characteristics\Form\Type
 */
abstract class AbstractCharacteristicType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['parent_data'] = $options['parent_data'];
    }

    /**
     * {@inheritDoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver
            ->setDefaults(array(
                'parent_data' => null
            ))
            ->setAllowedTypes(array(
                'parent_data' => array('string', 'null')
            ))
        ;
    }
}
