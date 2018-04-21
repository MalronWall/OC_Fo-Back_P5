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
    /** @var UserManager */
    private $userManager;

    public function __construct()
    {
        $this->userManager = new UserManager();
        parent::__construct();
    }

    public function getPosts()
    {
        $req = $this->db->requestDb('
                                    SELECT id, title, slug, chapo, content,
                                    DATE_FORMAT(last_update, "%e/%m/%y à %Hh%m") last_update, id_user
                                    FROM post
                                    ORDER BY id
        ');
        $results = $this->fetchAllResults($req);

        $datas = [];

        /** @var Post $post */
        foreach ($results as $post) {
            $user = $this->userManager->getUser($post->getIdUser());
            $post->setIdUser($user);
            $datas[] = $post;
        }

        return $datas;
    }

    public function getPost($slug)
    {
        $req = $this->db->requestDb('
                                    SELECT id, title, slug, chapo, content,
                                    DATE_FORMAT(lastUpdate, "%e/%m/%y à %Hh%m") lastUpdate, id_User
                                    FROM post
                                    WHERE slug = :slug
                                    ', [
                                        'slug' => $slug,
        ]);

//        $results = $this->fetchAllResults($req);
        $datas = $req->fetch();
        $datas['id_user'] = $this->userManager->getUser($datas['id_user']);

        return Hydrator::hydrate(Post::class, serialize(array_values($datas)));
//        return $results;
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
