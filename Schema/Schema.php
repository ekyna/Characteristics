<?php

namespace Ekyna\Component\Characteristics\Schema;

/**
 * Class Schema
 * @package Ekyna\Component\Characteristics\Schema
 */
class Schema
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $title;

    /**
     * @var Group[]
     */
    private $groups;

    /**
     * @var array
     */
    private $index;

    /**
     * Constructor.
     */
    public function __construct($name, $title)
    {
        $this->name = $name;
        $this->title = $title;
        $this->groups = array();
        $this->index = array();
    }

    /**
     * Sets the name.
     *
     * @param string $name
     *
     * @return Schema
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Returns the name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets the title.
     *
     * @param string $title
     *
     * @return Schema
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Returns the title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Returns whether the Schema has the given Group or not.
     *
     * @param Group $group
     *
     * @return bool
     */
    public function hasGroup(Group $group)
    {
        return array_key_exists($group->getName(), $this->groups);
    }

    /**
     * Adds the group.
     *
     * @param Group $group
     *
     * @throws \InvalidArgumentException
     *
     * @return Schema
     */
    public function addGroup(Group $group)
    {
        if ($this->hasGroup($group)) {
            throw new \InvalidArgumentException(sprintf('Group "%s" is allready defined.', $group->getName()));
        }

        $this->groups[$group->getName()] = $group;

        return $this;
    }

    /**
     * Returns a group by his name.
     *
     * @param string $name
     *
     * @throws \InvalidArgumentException
     *
     * @return Group
     */
    public function getGroupByName($name)
    {
        if (!array_key_exists($name, $this->groups)) {
            throw new \InvalidArgumentException(sprintf('Can\'t find "%s" group.', $name));
        }

        return $this->groups[$name];
    }

    /**
     * Returns the groups.
     *
     * @return Group[]
     */
    public function getGroups()
    {
        return $this->groups;
    }
    /**
     * Returns a characteristic definition by his identifier.
     *
     * @param $identifier
     * @return Definition|null
     */
    public function getDefinitionByIdentifier($identifier)
    {
        foreach($this->groups as $group) {
            foreach($group->getDefinitions() as $definition) {
                if ($definition->getIdentifier() === $identifier) {
                    return $definition;
                }
            }
        }
        return null;
    }
}
