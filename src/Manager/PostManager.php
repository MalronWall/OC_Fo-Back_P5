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
                                    SELECT p.id, title, chapo, content,
                                    DATE_FORMAT(lastUpdate, "Le %e/%m/%y à %Hh%m") lastUpdate, pseudo
                                    FROM post p JOIN user u ON p.id_User = u.id
                                    ORDER BY id
                                    ');

        foreach ($req->fetchAll() as $datas) {
            $results[] = Hydrator::hydrate(Post::class, serialize(array_values($datas)));
        }

        return $results;
    }
}
