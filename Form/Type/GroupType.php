<?php

namespace Ekyna\Component\Characteristics\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class GroupType
 * @package Ekyna\Component\Characteristics\Form\Type
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class GroupType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'mapped' => false,
            'inherit_data' => true,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ekyna_characteristics_group';
    }
}
