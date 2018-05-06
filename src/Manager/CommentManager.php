<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace Blog\Manager;

use Core\Application\Database\AbstractManager;
use Blog\Model\Comment;
use Core\Application\Database\Hydrator;

class CommentManager extends AbstractManager
{
    public function getValidComments($idPost)
    {
        $req = $this->db->requestDb('
                                    SELECT id, content, DATE_FORMAT(published, "%e/%m/%y à %Hh%m") published, valid,
                                    id_Post, id_User
                                    FROM comment
                                    WHERE id_Post = :idPost AND valid = 1
                                    ORDER BY id DESC
                                    ', [
                                    'idPost' => $idPost
        ]);

        $results = $this->fetchAllResults($req);

        return $results;
    }

    private function fetchAllResults($req)
    {
        $results = [];
        foreach ($req->fetchAll() as $datas) {
            $results[] = Hydrator::hydrate(Comment::class, serialize(array_values($datas)));
        }

        return $results;
    }
    
    public function createComment($content, $idPost, $idUser)
    {
        $req = $this->db->requestDb('
                                    INSERT INTO comment (content, id_Post, id_User)
                                    VALUES (:content, :idPost, :idUser)
                                    ', [
            'content' => $content,
            'idPost' => $idPost,
            'idUser' => $idUser
        ]);

        return true;
    }
}
