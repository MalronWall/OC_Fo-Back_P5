<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace Blog\Model;

class User implements \Serializable
{
    protected $id;
    protected $pseudo;
    protected $name;
    protected $firstname;
    protected $email;
    protected $password;
    protected $blocked;
    protected $token;
    protected $id_Image;
    protected $id_Role;

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
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * @param mixed $pseudo
     */
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param mixed $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getBlocked()
    {
        return $this->blocked;
    }

    /**
     * @param mixed $blocked
     */
    public function setBlocked($blocked)
    {
        $this->blocked = $blocked;
    }

    /**
     * @return mixed
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param mixed $token
     */
    public function setToken($token)
    {
        $this->token = $token;
    }

    /**
     * @return mixed
     */
    public function getIdImage()
    {
        return $this->id_Image;
    }

    /**
     * @param mixed $id_Image
     */
    public function setIdImage($id_Image)
    {
        $this->id_Image = $id_Image;
    }

    /**
     * @return mixed
     */
    public function getIdRole()
    {
        return $this->id_Role;
    }

    /**
     * @param mixed $id_Role
     */
    public function setIdRole($id_Role)
    {
        $this->id_Role = $id_Role;
    }

    public function serialize()
    {
        return [
            $this->id,
            $this->pseudo,
            $this->name,
            $this->firstname,
            $this->email,
            $this->password,
            $this->blocked,
            $this->token,
            $this->id_Image,
            $this->id_Role
        ];
    }

    public function unserialize($serialized)
    {
        list(
            $this->id,
            $this->pseudo,
            $this->name,
            $this->firstname,
            $this->email,
            $this->password,
            $this->blocked,
            $this->token,
            $this->id_Image,
            $this->id_Role
            ) = unserialize($serialized);

        return $this;
    }
}
