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
    public function getPost()
    {
        return $this->Post;
    }

    /**
     * @param mixed $slugPost
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
     * @param mixed $pseudoUser
     */
    public function setUser($User)
    {
        $this->User = $User;
    }

    public function serialize()
    {
        return [
            $this->id,
            $this->content,
            $this->published,
            $this->valid,
            $this->Post,
            $this->User
        ];
    }

    public function unserialize($serialized)
    {
        list(
            $this->id,
            $this->content,
            $this->published,
            $this->valid,
            $this->Post,
            $this->User
            ) = unserialize($serialized);

        return $this;
    }
}
