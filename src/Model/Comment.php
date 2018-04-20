<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace Blog\Model;

class Comment implements \Serializable
{
    protected $id;
    protected $content;
    protected $published;
    protected $valid;
    protected $id_Post;
    protected $id_User;

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
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getPublished()
    {
        return $this->published;
    }

    /**
     * @param mixed $published
     */
    public function setPublished($published)
    {
        $this->published = $published;
    }

    /**
     * @return mixed
     */
    public function getValid()
    {
        return $this->valid;
    }

    /**
     * @param mixed $valid
     */
    public function setValid($valid)
    {
        $this->valid = $valid;
    }

    /**
     * @return mixed
     */
    public function getIdPost()
    {
        return $this->id_Post;
    }

    /**
     * @param mixed $slugPost
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
        return $this->id_User;
    }

    /**
     * @param mixed $pseudoUser
     */
    public function setIdUser($id_User)
    {
        $this->id_User = $id_User;
    }

    public function serialize()
    {
        return [
            $this->id,
            $this->content,
            $this->published,
            $this->valid,
            $this->id_Post,
            $this->id_User
        ];
    }

    public function unserialize($serialized)
    {
        list(
            $this->id,
            $this->content,
            $this->published,
            $this->valid,
            $this->id_Post,
            $this->id_User
            ) = unserialize($serialized);

        return $this;
    }
}
