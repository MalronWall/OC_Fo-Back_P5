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
    protected $tokenLogon;
    protected $tokenForgotPwd;
    protected $Image;
    protected $Role;

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
        return htmlspecialchars($this->pseudo);
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
        return htmlspecialchars($this->name);
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
        return htmlspecialchars($this->firstname);
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
        return htmlspecialchars($this->email);
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
    public function getTokenLogon()
    {
        return $this->tokenLogon;
    }

    /**
     * @param mixed $tokenLogon
     */
    public function setTokenLogon($tokenLogon)
    {
        $this->tokenLogon = $tokenLogon;
    }

    /**
     * @return mixed
     */
    public function getTokenForgotPwd()
    {
        return $this->tokenForgotPwd;
    }

    /**
     * @param mixed $tokenForgotPwd
     */
    public function setTokenForgotPwd($tokenForgotPwd)
    {
        $this->tokenForgotPwd = $tokenForgotPwd;
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
     * @return mixed
     */
    public function getRole()
    {
        return $this->Role;
    }

    /**
     * @param mixed $Role
     */
    public function setRole($Role)
    {
        $this->Role = $Role;
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
            $this->tokenLogon,
            $this->tokenForgotPwd,
            $this->Image,
            $this->Role
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
            $this->tokenLogon,
            $this->tokenForgotPwd,
            $this->Image,
            $this->Role
            ) = unserialize($serialized);

        return $this;
    }
}
