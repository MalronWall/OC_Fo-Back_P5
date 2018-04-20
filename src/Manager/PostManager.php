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
    public function getPosts()
    {
        $req = $this->db->requestDb('
                                    SELECT id, title, slug, chapo, content,
                                    DATE_FORMAT(lastUpdate, "%e/%m/%y à %Hh%m") lastUpdate, id_User
                                    FROM post
                                    ORDER BY id
        ');

        $results = $this->fetchAllResults($req);

        return $results;
    }

    public function getPost($slug)
    {
        $req = $this->db->requestDb('
                                    SELECT id, title, slug, chapo, content,
                                    DATE_FORMAT(lastUpdate, "%e/%m/%y à %Hh%m") lastUpdate, id_User
                                    FROM post
                                    WHERE slug = :slug
                                    ', [
                                        'slug' => $slug
        ]);

        $results = $this->fetchAllResults($req);

        return $results;
    }

    private function fetchAllResults($req)
    {
        $results = [];
        foreach ($req->fetchAll() as $datas) {
            $results[] = Hydrator::hydrate(Post::class, serialize(array_values($datas)));
        }

        return $results;
    }
}
