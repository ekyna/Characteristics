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
    public function __construct(Manager $manager, array $options = array())
    {
        $this->manager = $manager;

        $this->options = array_merge(array(
            'template' => '@characteristics/Show/characteristics.html.twig',
        ), $options);
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
        return array(
            new \Twig_SimpleFunction('render_characteristics', array($this, 'renderCharacteristics'), array('is_safe' => array('html'))),
        );
    }

    /**
     * Renders a characteristics view table.
     *
     * @param CharacteristicsInterface $characteristics
     * @param array $options
     *
     * @return string
     */
    public function renderCharacteristics(CharacteristicsInterface $characteristics, array $options = array())
    {
        $options = array_merge(array(
            'table_class' => 'table table-striped table-bordered table-condensed',
            'highlight_inherited' => false,
        ), $options);
        return $this->template->render(array(
            'view' => $this->manager->createView($characteristics),
            'options' => $options,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ekyna_characteristics';
    }
}
