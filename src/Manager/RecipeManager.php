<?php

declare(strict_types=1);

/*
 * This file is part of Project Name
 *
 * (c) Aurelien Morvna <morvan.aurelien@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Blog\Manager;

use Blog\Model\Recipe;
use Core\Application\Database\AbstractManager;
use Core\Application\Database\Hydrator;

/**
 * Class RecipeManager
 */
class RecipeManager extends AbstractManager
{
    /** @var UserManager */
    private $userManager;

    /**
     * RecipeManager constructor.
     */
    public function __construct()
    {
        $this->userManager = new UserManager();
    }

    public function listRecipes()
    {
//        $req = $this->db->requestDb(
//            'SELECT * FROM recipe'
//        );
//        $recipes = [];
//        foreach ($req->fetchAll() as $datas) {
//            $datas['owner_id'] = $this->userManager->getUser($datas['owner_id']);
//            $recipes[] = Hydrator::hydrate(Recipe::class, serialize(array_values($datas)));
//        }
//
//        return $recipes;
        $req = $this->db->requestDb('SELECT * FROM recipe');
        $results = [];
        foreach ($req->fetchAll() as $datas) {
            $datas['owner_id'] = $this->userManager->getUser($datas['owner_id']);
            $results[] = Hydrator::hydrate(Recipe::class, serialize(array_values($datas)));
        }

        return $results;
    }
}
