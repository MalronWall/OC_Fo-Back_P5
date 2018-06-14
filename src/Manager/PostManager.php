<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace Blog\Manager;

use Core\Application\Database\AbstractManager;
use Blog\Model\Post;
use Core\Application\Database\Hydrator;

class PostManager extends AbstractManager
{
    /**
     * PostManager constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return array
     */
    public function getPosts()
    {
        $req = $this->db->requestDb('
                                    SELECT id, title, slug, chapo, content,
                                    DATE_FORMAT(lastUpdate, "%d/%m/%y à %Hh%m") lastUpdate, id_user, id_Image
                                    FROM post
                                    ORDER BY id desc
        ');
        $results = $this->fetchAllResults($req);

        return $results;
    }

    /**
     * @param $slug
     * @return bool|string
     */
    public function getPostBySlug($slug)
    {
        $req = $this->db->requestDb('
                                    SELECT id, title, slug, chapo, content,
                                    DATE_FORMAT(lastUpdate, "%d/%m/%y à %Hh%m") lastUpdate, id_User, id_Image
                                    FROM post
                                    WHERE slug = :slug
                                    ', [
                                        'slug' => $slug,
        ]);

        $datas = $req->fetch();

        if ($datas == false) {
            return false;
        }

        return Hydrator::hydrate(Post::class, serialize(array_values($datas)));
    }

    /**
     * @param $id
     * @return string
     */
    public function getPostById($id)
    {
        $req = $this->db->requestDb('
                                    SELECT id, title, slug, chapo, content,
                                    DATE_FORMAT(lastUpdate, "%d/%m/%y à %Hh%m") lastUpdate, id_User, id_Image
                                    FROM post
                                    WHERE id = :id
                                    ', [
            'id' => $id,
        ]);

        $datas = $req->fetch();

        return Hydrator::hydrate(Post::class, serialize(array_values($datas)));
    }

    /**
     * @param array $objects
     * @return array
     */
    public function replaceIdsByPost(array $objects)
    {
        foreach ($objects as $object) {
            $post = $this->getPostById($object->getPost());
            $object->setPost($post);
        }
        return $objects;
    }

    /**
     * @param $post
     * @param $slug
     * @param $idUser
     * @return bool
     */
    public function createPost($post, $slug, $idUser)
    {
        $req = $this->db->requestDb('
                                    INSERT INTO post (title, slug, content, id_User)
                                    VALUES (:title, :slug, :content, :id_User)
                                    ', [
            'title' => $post['title'],
            'slug' => $slug,
            'content' => $post['content'],
            'id_User' => $idUser
        ]);

        return true;
    }

    /**
     * @param $slug
     * @param $chapo
     * @return bool
     */
    public function updateChapo($slug, $chapo)
    {
        $req = $this->db->requestDb('
                                    UPDATE post
                                    SET chapo = :chapo
                                    WHERE slug = :slug
                                    ', [
            'chapo' => $chapo,
            'slug' => $slug
        ]);

        return true;
    }

    /**
     * @param $title
     * @return array
     */
    public function checkTitle($title)
    {
        $req = $this->db->requestDb('
                                    SELECT COUNT(*)
                                    FROM post
                                    WHERE title = :title
                                    ', [
            'title' => $title
        ]);

        return array_values($req->fetch());
    }

    /**
     * @param $slug
     * @return array
     */
    public function checkSlug($slug)
    {
        $req = $this->db->requestDb('
                                    SELECT COUNT(*)
                                    FROM post
                                    WHERE slug = :slug
                                    ', [
            'slug' => $slug
        ]);

        return array_values($req->fetch());
    }

    /**
     * @param $slug
     * @return bool
     */
    public function deletePost($slug)
    {
        $req = $this->db->requestDb('
                                    DELETE FROM post
                                    WHERE slug = :slug
                                    ', [
            'slug' => $slug
        ]);

        return true;
    }

    /**
     * @param $oldSlug
     * @param $slug
     * @param $title
     * @return bool
     */
    public function updateSlugTitle($oldSlug, $slug, $title)
    {
        $req = $this->db->requestDb('
                                    UPDATE post
                                    SET slug = :slug, title = :title
                                    WHERE slug = :oldSlug
                                    ', [
            'oldSlug' => $oldSlug,
            'slug' => $slug,
            'title' => $title
        ]);

        return true;
    }

    /**
     * @param $slug
     * @return bool
     */
    public function updateLastUpdate($slug)
    {
        $req = $this->db->requestDb('
                                    UPDATE post
                                    SET lastUpdate = CURRENT_TIMESTAMP
                                    WHERE slug = :slug
                                    ', [
            'slug' => $slug
        ]);

        return true;
    }

    /**
     * @param $slug
     * @param $content
     * @return bool
     */
    public function updateContent($slug, $content)
    {
        $req = $this->db->requestDb('
                                    UPDATE post
                                    SET content = :content
                                    WHERE slug = :slug
                                    ', [
            'content' => $content,
            'slug' => $slug
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
            $results[] = Hydrator::hydrate(Post::class, serialize(array_values($datas)));
        }

        return $results;
    }
}
