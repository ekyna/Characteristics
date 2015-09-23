<?php

namespace Ekyna\Component\Characteristics\Twig;

use Ekyna\Component\Characteristics\Manager;
use Ekyna\Component\Characteristics\Model\CharacteristicsInterface;

/**
 * Class CharacteristicsExtension
 * @package Ekyna\Component\Characteristics\Twig
 */
class CharacteristicsExtension extends \Twig_Extension
{
    /**
     * @var \Ekyna\Component\Characteristics\Manager
     */
    private $manager;

    /**
     * @var array
     */
    private $options;

    /**
     * @var \Twig_Template
     */
    private $template;

    /**
     * Constructor.
     *
     * @param Manager $manager
     * @param array $options
     */
    public function __construct(Manager $manager, array $options = [])
    {
        $this->manager = $manager;

        $this->options = array_merge([
            'template' => '@characteristics/Show/characteristics.html.twig',
        ], $options);
    }

    /**
     * {@inheritdoc}
     */
    public function initRuntime(\Twig_Environment $environment)
    {
        $this->template = $environment->loadTemplate($this->options['template']);
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('render_characteristics', [$this, 'renderCharacteristics'], ['is_safe' => ['html']]),
        ];
    }

    /**
     * Renders a characteristics view table.
     *
     * @param CharacteristicsInterface $characteristics
     * @param array $options
     *
     * @return string
     */
    public function renderCharacteristics(CharacteristicsInterface $characteristics, array $options = [])
    {
        $options = array_merge([
            'table_class' => 'table table-striped table-bordered table-condensed ekyna-characteristics',
            'highlight_inherited' => false,
            'display_group' => null,
        ], $options);

        return $this->template->render([
            'view' => $this->manager->createView($characteristics, $options['display_group']),
            'options' => $options,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ekyna_characteristics';
    }
}
