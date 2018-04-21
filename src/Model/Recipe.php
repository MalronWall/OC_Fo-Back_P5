<?php

declare(strict_types=1);

/*
 * This file is part of Project Name
 *
 * (c) Aurelien Morvna <morvan.aurelien@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Blog\Model;

/**
 * Class Recipe
 */
class Recipe implements \Serializable
{
    /** @var int */
    private $id;

    /** @var string */
    private $name;

    /** @var User|int */
    private $owner;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return Recipe
     */
    public function setName(string $name): Recipe
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return User|int
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * @param User|int $owner
     *
     * @return Recipe
     */
    public function setOwner($owner)
    {
        $this->owner = $owner;

        return $this;
    }

    public function serialize()
    {
        // TODO: Implement serialize() method.
    }

    /**
     * {@inheritdoc}
     */
    public function unserialize($serialized)
    {
        list(
            $this->id,
            $this->name,
            $this->owner
            ) = $this->unserialize($serialized);
    }
}
