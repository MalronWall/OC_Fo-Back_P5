<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace Blog\Manager;

use Core\Application\Database\AbstractManager;
use Blog\Model\User;
use Core\Application\Database\Hydrator;

class UserManager extends AbstractManager
{
    /**
     * UserManager constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param $idUser
     * @return string
     */
    public function getUser($idUser)
    {
        $req = $this->db->requestDb('
                                    SELECT *
                                    FROM user
                                    WHERE id = :idUser
                                    ', [
                                    'idUser' => $idUser
        ]);

        return Hydrator::hydrate(User::class, serialize(array_values($req->fetch())));
    }

    /**
     * @param $email
     * @return string
     */
    public function getUserByEmail($email)
    {
        $req = $this->db->requestDb('
                                    SELECT *
                                    FROM user
                                    WHERE email = :email
                                    ', [
            'email' => $email
        ]);

        return Hydrator::hydrate(User::class, serialize(array_values($req->fetch())));
    }

    /**
     * @return array
     */
    public function getUsers()
    {
        $req = $this->db->requestDb('
                                    SELECT *
                                    FROM user
                                    ORDER BY id_Role
                                    ');

        $results = $this->fetchAllResults($req);

        return $results;
    }

    /**
     * @param $pseudo
     * @return bool|string
     */
    public function getProfile($pseudo)
    {
        $req = $this->db->requestDb('
                                    SELECT *
                                    FROM user
                                    WHERE pseudo = :pseudo
                                    ', [
            'pseudo' => $pseudo
        ]);

        $fetchReq = $req->fetch();

        if ($fetchReq == false) {
            return false;
        }
        return Hydrator::hydrate(User::class, serialize(array_values($fetchReq)));
    }

    /**
     * @param array $objects
     * @return array
     */
    public function replaceIdsByUsers(array $objects)
    {
        foreach ($objects as $object) {
            $user = $this->getUser($object->getUser());
            $object->setUser($user);
        }
        return $objects;
    }

    /**
     * @param $object
     * @return mixed
     */
    public function replaceIdByUser($object)
    {
        $user = $this->getUser($object->getUser());
        $object->setUser($user);
        return $object;
    }

    /**
     * @param $post
     * @return mixed
     */
    public function checkEmailPseudo($post)
    {
        $req = $this->db->requestDb('
                                    SELECT COUNT(*)
                                    FROM user
                                    WHERE pseudo = :pseudo OR email = :email
                                    ', [
            'pseudo' => $post['emailPseudo'],
            'email' => $post['emailPseudo']
        ]);

        return $req->fetch();
    }

    /**
     * @param $post
     * @return mixed
     */
    public function checkEmail($post)
    {
        $req = $this->db->requestDb('
                                    SELECT COUNT(*)
                                    FROM user
                                    WHERE email = :email
                                    ', [
            'email' => $post['email']
        ]);

        return $req->fetch();
    }

    /**
     * @param $post
     * @return mixed
     */
    public function checkPseudo($post)
    {
        $req = $this->db->requestDb('
                                    SELECT COUNT(*)
                                    FROM user
                                    WHERE pseudo = :pseudo
                                    ', [
            'pseudo' => $post['pseudo']
        ]);

        return $req->fetch();
    }

    /**
     * @param $post
     * @return bool|string
     */
    public function checkUser($post)
    {
        $req = $this->db->requestDb('
                                    SELECT *
                                    FROM user
                                    WHERE (pseudo = :pseudo OR email = :email) AND password = :pwd
                                    ', [
            'pseudo' => $post['emailPseudo'],
            'email' => $post['emailPseudo'],
            'pwd' => md5($post['password'])
        ]);

        $arrayFetch = $req->fetch();
        if ($arrayFetch != false) {
            return Hydrator::hydrate(User::class, serialize(array_values($arrayFetch)));
        }
        return false;
    }

    /**
     * @param $post
     * @return mixed
     */
    public function checkBlocked($post)
    {
        $req = $this->db->requestDb('
                                    SELECT blocked
                                    FROM user
                                    WHERE pseudo = :pseudo OR email = :email
                                    ', [
            'pseudo' => $post['emailPseudo'],
            'email' => $post['emailPseudo']
        ]);

        return $req->fetch();
    }

    /**
     * @param $post
     * @return mixed
     */
    public function checkTokenLogonByUser($post)
    {
        $req = $this->db->requestDb('
                                    SELECT COUNT(*)
                                    FROM user
                                    WHERE (pseudo = :pseudo OR email = :email) AND tokenLogon is not null
                                    ', [
            'pseudo' => $post['emailPseudo'],
            'email' => $post['emailPseudo']
        ]);

        return $req->fetch();
    }

    /**
     * @param $token
     * @return mixed
     */
    public function checkTokenLogonByToken($token)
    {
        $req = $this->db->requestDb('
                                    SELECT COUNT(*)
                                    FROM user
                                    WHERE tokenLogon = :token
                                    ', [
            'token' => $token
        ]);

        return $req->fetch();
    }

    /**
     * @param $token
     * @return bool
     */
    public function deleteTokenLogon($token)
    {
        $req = $this->db->requestDb('
                                    UPDATE user
                                    SET tokenLogon = null
                                    WHERE tokenLogon = :token
                                    ', [
            'token' => $token
        ]);

        return true;
    }

    /**
     * @param $token
     * @return mixed
     */
    public function checkTokenForgotPwdByToken($token)
    {
        $req = $this->db->requestDb('
                                    SELECT tokenForgotPwd
                                    FROM user
                                    WHERE tokenForgotPwd = :token
                                    ', [
            'token' => $token
        ]);

        return $req->fetch();
    }

    /**
     * @param $post
     * @return mixed
     */
    public function checkTokenForgotPwdByUser($post)
    {
        $req = $this->db->requestDb('
                                    SELECT COUNT(*)
                                    FROM user
                                    WHERE (pseudo = :pseudo OR email = :email) AND tokenForgotPwd is not null
                                    ', [
            'pseudo' => $post['emailPseudo'],
            'email' => $post['emailPseudo']
        ]);

        return $req->fetch();
    }

    /**
     * @param $post
     * @return bool
     */
    public function deleteTokenForgotPwd($post)
    {
        $req = $this->db->requestDb('
                                    UPDATE user
                                    SET tokenForgotPwd = null
                                    WHERE pseudo = :pseudo OR email = :email
                                    ', [
            'pseudo' => $post['emailPseudo'],
            'email' => $post['emailPseudo']
        ]);

        return true;
    }

    /**
     * @param $post
     * @param $token
     * @return bool
     */
    public function createUser($post, $token)
    {
        $req = $this->db->requestDb('
                                    INSERT INTO user (pseudo, name, firstname, email, password, tokenLogon) 
                                    VALUES (:pseudo, :lastname, :firstname, :email, :pwd, :token)
                                    ', [
            'pseudo' => $post['pseudo'],
            'lastname' => $post['lastname'],
            'firstname' => $post['firstname'],
            'email' => $post['email'],
            'pwd' => md5($post['password']),
            'token' => $token
        ]);

        return true;
    }

    /**
     * @param $post
     * @param $idUser
     * @return bool
     */
    public function updateDatas($post, $idUser)
    {
        $req = $this->db->requestDb('
                                    UPDATE user
                                    SET name = :lastname, firstname = :firstname, pseudo = :pseudo, email = :email 
                                    WHERE id = :idUser
                                    ', [
            'lastname' => $post['lastname'],
            'firstname' => $post['firstname'],
            'pseudo' => $post['pseudo'],
            'email' => $post['email'],
            'idUser' => $idUser
        ]);

        return true;
    }

    /**
     * @param $idUser
     * @param $blocked
     * @return bool
     */
    public function updateBlocked($idUser, $blocked)
    {
        $req = $this->db->requestDb('
                                    UPDATE user
                                    SET blocked = :blocked
                                    WHERE id = :idUser
                                    ', [
            'blocked' => $blocked,
            'idUser' => $idUser
        ]);

        return true;
    }

    /**
     * @param $idUser
     * @param $idRole
     * @return bool
     */
    public function updateRole($idUser, $idRole)
    {
        $req = $this->db->requestDb('
                                    UPDATE user
                                    SET id_Role = :idRole
                                    WHERE id = :idUser
                                    ', [
            'idRole' => $idRole,
            'idUser' => $idUser
        ]);

        return true;
    }

    /**
     * @param $password
     * @param $idUser
     * @return bool
     */
    public function updatePassword($password, $idUser)
    {
        $req = $this->db->requestDb('
                                    UPDATE user
                                    SET password = :pwd
                                    WHERE id = :idUser
                                    ', [
            'pwd' => md5($password),
            'idUser' => $idUser
        ]);

        return true;
    }

    /**
     * @param $password
     * @param $token
     * @return bool
     */
    public function updatePasswordByToken($password, $token)
    {
        $req = $this->db->requestDb('
                                    UPDATE user
                                    SET password = :pwd
                                    WHERE tokenForgotPwd = :token
                                    ', [
            'pwd' => md5($password),
            'token' => $token
        ]);

        return true;
    }

    /**
     * @param $email
     * @param $token
     * @return bool
     */
    public function updateTokenForgotPwd($email, $token)
    {
        $req = $this->db->requestDb('
                                    UPDATE user
                                    SET tokenForgotPwd = :token
                                    WHERE email = :email
                                    ', [
            'email' => $email,
            'token' => $token
        ]);

        return true;
    }

    /**
     * @param $req
     * @return array
     */
    private function fetchAllResults($req)
    {
        $results = [];
        foreach ($req->fetchAll() as $datas) {
            $results[] = Hydrator::hydrate(User::class, serialize(array_values($datas)));
        }

        return $results;
    }
}
