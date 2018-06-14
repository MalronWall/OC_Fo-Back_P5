<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace Blog\Manager;

use Core\Application\Database\AbstractManager;
use Blog\Model\Image;
use Core\Application\Database\Hydrator;

class ImageManager extends AbstractManager
{
    /**
     * ImageManager constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param $idPost
     * @return array
     */
    public function getImagePost($idPost)
    {
        $req = $this->db->requestDb('
                                    SELECT *
                                    FROM image
                                    WHERE id_Post = :idPost
                                    ', [
            'idPost' => $idPost
        ]);

        $results = $this->fetchAllResults($req);

        return $results;
    }

    /**
     * @param $idUser
     * @return array
     */
    public function getImageUser($idUser)
    {
        $req = $this->db->requestDb('
                                    SELECT *
                                    FROM image
                                    WHERE id_User = :idUser
                                    ', [
            'idUser' => $idUser
        ]);

        $results = $this->fetchAllResults($req);

        return $results;
    }

    /**
     * @param $req
     * @return array
     */
    private function fetchAllResults($req)
    {
        $results = [];
        foreach ($req->fetchAll() as $datas) {
            $results[] = Hydrator::hydrate(Image::class, serialize(array_values($datas)));
        }

        return $results;
    }

    /**
     * @param array $objects
     * @return array
     */
    public function replaceIdsPostByImages(array $objects)
    {
        foreach ($objects as $object) {
            $this->replaceIdPostByImage($object);
        }
        return $objects;
    }

    /**
     * @param $object
     * @return mixed
     */
    public function replaceIdPostByImage($object)
    {
        $image = $this->getImagePost($object->getId());
        $object->setImage($image);
        return $object;
    }

    /**
     * @param array $objects
     * @return array
     */
    public function replaceIdsUserByImages(array $objects)
    {
        foreach ($objects as $object) {
            $this->replaceIdUserByImage($object);
        }
        return $objects;
    }

    /**
     * @param $object
     * @return mixed
     */
    public function replaceIdUserByImage($object)
    {
        $image = $this->getImageUser($object->getId());
        $object->setImage($image);
        return $object;
    }

    /**
     * @param $idUser
     * @return bool|mixed
     */
    public function createAndLinkImageUser($idUser)
    {
        if (empty($this->getImageUser($idUser))) {
            if ($this->createImageUser($idUser)) {
                $newImage = $this->getImageUser($idUser);
                if ($newImage != false) {
                    if ($this->linkImageUser($newImage[0]->getId(), $idUser)) {
                        return $newImage[0];
                    }
                }
            }
            return false;
        }
        return true;
    }

    /**
     * @param $idUser
     * @return bool
     */
    private function createImageUser($idUser)
    {
        $req = $this->db->requestDb('
                                    INSERT INTO image (id_User)
                                    VALUES (:idUser)
                                    ', [
            'idUser' => $idUser
        ]);

        return true;
    }

    /**
     * @param $idImage
     * @param $idUser
     * @return bool
     */
    private function linkImageUser($idImage, $idUser)
    {
        $req = $this->db->requestDb('
                                    UPDATE user
                                    SET id_Image = :idImage
                                    WHERE id = :idUser
                                    ', [
            'idImage' => $idImage,
            'idUser' => $idUser
        ]);
        
        return true;
    }

    /**
     * @param $idPost
     * @return bool|mixed
     */
    public function createAndLinkImagePost($idPost)
    {
        if (empty($this->getImagePost($idPost))) {
            if ($this->createImagePost($idPost)) {
                $newImage = $this->getImagePost($idPost);
                if ($newImage != false) {
                    if ($this->linkImagePost($newImage[0]->getId(), $idPost)) {
                        return $newImage[0];
                    }
                }
            }
            return false;
        }
        return true;
    }

    /**
     * @param $idUser
     * @return bool
     */
    private function createImagePost($idUser)
    {
        $req = $this->db->requestDb('
                                    INSERT INTO image (id_Post)
                                    VALUES (:idUser)
                                    ', [
            'idUser' => $idUser
        ]);

        return true;
    }

    /**
     * @param $idImage
     * @param $idPost
     * @return bool
     */
    private function linkImagePost($idImage, $idPost)
    {
        $req = $this->db->requestDb('
                                    UPDATE post
                                    SET id_Image = :idImage
                                    WHERE id = :idPost
                                    ', [
            'idImage' => $idImage,
            'idPost' => $idPost
        ]);

        return true;
    }
}
