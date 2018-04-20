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
    protected $image;
    protected $id_Post;
    protected $id_user;

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
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return mixed
     */
    public function getIdPost()
    {
        return $this->id_Post;
    }

    /**
     * @param mixed $id_Post
     */
    public function setIdPost($id_Post)
    {
        $this->id_Post = $id_Post;
    }

    /**
     * @return mixed
     */
    public function getIdUser()
    {
        return $this->id_user;
    }

    /**
     * @param mixed $id_user
     */
    public function setIdUser($id_user)
    {
        $this->id_user = $id_user;
    }

    public function serialize()
    {
        return [
            $this->id,
            $this->label,
            $this->image,
            $this->id_Post,
            $this->id_user
        ];
    }

    public function unserialize($serialized)
    {
        list(
            $this->id,
            $this->label,
            $this->image,
            $this->id_Post,
            $this->id_user
            ) = unserialize($serialized);

        return $this;
    }
}
