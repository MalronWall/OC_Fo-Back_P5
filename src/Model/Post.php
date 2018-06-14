<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace Blog\Model;

class Post implements \Serializable
{
    protected $id;
    protected $title;
    protected $slug;
    protected $chapo;
    protected $content;
    protected $lastUpdate;
    protected $User;
    protected $Image;

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
    public function getTitle()
    {
        return htmlspecialchars($this->title);
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param mixed $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * @return mixed
     */
    public function getChapo()
    {
        if (!empty($this->chapo)) {
            return htmlspecialchars($this->chapo);
        }
        return '';
    }

    /**
     * @param mixed $chapo
     */
    public function setChapo($chapo)
    {
        $this->chapo = $chapo;
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
    public function getLastUpdate()
    {
        return $this->lastUpdate;
    }

    /**
     * @param mixed $lastUpdate
     */
    public function setLastUpdate($lastUpdate)
    {
        $this->lastUpdate = $lastUpdate;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->User;
    }

    /**
     * @param mixed $user
     */
    public function setUser($User)
    {
        $this->User = $User;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->Image;
    }

    /**
     * @param mixed $Image
     */
    public function setImage($Image)
    {
        $this->Image = $Image;
    }

    /**
     * @return array|string
     */
    public function serialize()
    {
        return [
            $this->id,
            $this->title,
            $this->slug,
            $this->chapo,
            $this->content,
            $this->lastUpdate,
            $this->User,
            $this->Image
        ];
    }

    /**
     * @param string $serialized
     * @return $this|void
     */
    public function unserialize($serialized)
    {
        list(
            $this->id,
            $this->title,
            $this->slug,
            $this->chapo,
            $this->content,
            $this->lastUpdate,
            $this->User,
            $this->Image
            ) = unserialize($serialized);

        return $this;
    }
}
