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
    protected $user;
    protected $labelImage;
    protected $image;

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
        return $this->title;
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
        return $this->chapo;
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
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getLabelImage()
    {
        return $this->labelImage;
    }

    /**
     * @param mixed $labelImage
     */
    public function setLabelImage($labelImage)
    {
        $this->labelImage = $labelImage;
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

    public function serialize()
    {
        return [
            $this->id,
            $this->title,
            $this->slug,
            $this->chapo,
            $this->content,
            $this->lastUpdate,
            $this->user,
            $this->image,
            $this->labelImage
        ];
    }

    public function unserialize($serialized)
    {
        list(
            $this->id,
            $this->title,
            $this->slug,
            $this->chapo,
            $this->content,
            $this->lastUpdate,
            $this->user,
            $this->image,
            $this->labelImage
            ) = unserialize($serialized);

        return $this;
    }
}
