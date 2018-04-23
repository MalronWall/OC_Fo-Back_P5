<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace Blog\Model;

class Role implements \Serializable
{
    protected $id;
    protected $role;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param mixed $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }

    public function serialize()
    {
        return [
            $this->id,
            $this->role
        ];
    }

    public function unserialize($serialized)
    {
        list(
            $this->id,
            $this->role
            ) = unserialize($serialized);

        return $this;
    }
}
