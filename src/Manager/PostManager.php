<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace Blog\Manager;

use Blog\Model\Post;
use Core\Application\Database\AbstractManager;
use Core\Application\Database\Hydrator;

class PostManager extends AbstractManager
{
    public function getPosts()
    {
        $results = [];
        $req = $this->db->requestDb('
                                    SELECT p.id, title, slug, chapo, content,
                                    DATE_FORMAT(lastUpdate, "le %e/%m/%y à %Hh%m") lastUpdate, pseudo, label, image
                                    FROM post p JOIN user u on p.id_User = u.id LEFT JOIN image i on p.id = i.id_Post
                                    ORDER BY id
        ');

        foreach ($req->fetchAll() as $datas) {
            $results[] = Hydrator::hydrate(Post::class, serialize(array_values($datas)));
        }

        return $results;
    }

    public function getPost($slug)
    {
        $results = [];
        $req = $this->db->requestDb('
                                    SELECT p.id, title, slug, chapo, content,
                                    DATE_FORMAT(lastUpdate, "le %e/%m/%y à %Hh%m") lastUpdate, pseudo, label, image
                                    FROM post p JOIN user u on p.id_User = u.id LEFT JOIN image i on p.id = i.id_Post
                                    WHERE slug = :slug
                                    ', [
                                        'slug' => $slug
        ]);

        foreach ($req->fetchAll() as $datas) {
            $results[] = Hydrator::hydrate(Post::class, serialize(array_values($datas)));
        }

        return $results;
    }
}
