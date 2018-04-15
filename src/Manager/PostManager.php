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
/*
        try {
            $bdd = new \PDO(
                "mysql:hostname=localhost;dbname=oc_back_p5",
                'root',
                ''
            );
            $bdd->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $bdd->setAttribute(\PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES 'utf8'");
        } catch (\PDOException $e) {
            die("Erreur : " . $e->getMessage());
        }

        $req = $bdd->prepare("SELECT * FROM post ORDER BY id");

        $req -> execute();
*/
        $req = $this->db->requestDb('SELECT * FROM post ORDER BY id');

        $results = $req->fetchAll();

        return $results;
        /*
        foreach ($req->fetchAll() as $datas) {
            $results[] = Hydrator::hydrate(Post::class, serialize(array_values($datas)));
        }*/
    }
}
