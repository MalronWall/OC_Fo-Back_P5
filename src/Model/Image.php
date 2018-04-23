<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace Blog\Model;

class Image implements \Serializable
{
    protected $id;
    protected $label;
    protected $Post;
    protected $User;

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
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param mixed $label
     */
    public function setLabel($label)
    {
        $this->label = $label;
    }

    /**
     * @return mixed
     */
    public function getPost()
    {
        return $this->Post;
    }

    /**
     * @param mixed $Post
     */
    public function setPost($Post)
    {
        $this->Post = $Post;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->User;
    }

    /**
     * @param mixed $User
     */
    public function setUser($User)
    {
        $this->User = $User;
    }

    public function serialize()
    {
        return [
            $this->id,
            $this->label,
            $this->Post,
            $this->User
        ];
    }

    public function unserialize($serialized)
    {
        list(
            $this->id,
            $this->label,
            $this->Post,
            $this->User
            ) = unserialize($serialized);

        return $this;
    }
}
