<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace Blog\Manager;

use Core\Application\Database\AbstractManager;
use Core\Application\Database\Hydrator;

class PostManager extends AbstractManager
{
    public function getPosts()
    {
        $results = [];
        $req = $this->db->requestDb('SELECT * FROM post ORDER BY id');

        $results = $req->fetchAll();

        return $results;
        /*
        foreach ($req->fetchAll() as $datas) {
            $results[] = Hydrator::hydrate(Post::class, serialize(array_values($datas)));
        }*/
    }
}
