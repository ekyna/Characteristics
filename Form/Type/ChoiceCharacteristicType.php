<?php

namespace Ekyna\Component\Characteristics\Form\Type;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class ChoiceCharacteristicType
 * @package Ekyna\Component\Characteristics\Form\Type
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class ChoiceCharacteristicType extends AbstractCharacteristicType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('choice', 'entity', [
            'label' => false,
            'required' => false,
            'empty_value' => 'Undefined',
            'empty_data'  => null,
            'class' => 'Ekyna\Component\Characteristics\Entity\ChoiceCharacteristicValue',
            'property' => 'value',
            'query_builder' => function(EntityRepository $er) use ($options) {
                return $er
                    ->createQueryBuilder('c')
                    ->where('c.identifier = :identifier')
                    ->setParameter('identifier', $options['identifier'])
                    ->orderBy('c.value', 'ASC')
                ;
            }
        ]);
    }

    /**
     * {@inheritDoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);

        $resolver
            ->setDefaults([
                'data_class' => 'Ekyna\Component\Characteristics\Entity\ChoiceCharacteristic',
                'identifier' => null
            ])
            ->setAllowedTypes([
                'identifier' => 'string'
            ])
            ->setRequired(['identifier'])
        ;
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'ekyna_choice_characteristic';
    }
}
