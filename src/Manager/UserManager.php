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

    public function replaceIdsByUsers(array $objects)
    {
        foreach ($objects as $object) {
            $user = $this->getUser($object->getUser());
            $object->setUser($user);
        }
        return $objects;
    }

    public function replaceIdByUser($object)
    {
        $user = $this->getUser($object->getUser());
        $object->setUser($user);
        return $object;
    }
    
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

    public function createUser($post, $token)
    {
        $req = $this->db->requestDb('
                                    INSERT INTO user (pseudo, name, firstname, email, password, token) 
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

    public function checkToken($token)
    {
        $req = $this->db->requestDb('
                                    SELECT COUNT(*)
                                    FROM user
                                    WHERE token = :token
                                    ', [
            'token' => $token
        ]);

        return $req->fetch();
    }

    public function deleteToken($token)
    {
        $req = $this->db->requestDb('
                                    UPDATE user
                                    SET token = null
                                    WHERE token = :token
                                    ', [
            'token' => $token
        ]);

        return true;
    }

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
}
