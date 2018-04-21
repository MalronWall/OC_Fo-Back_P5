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

namespace Blog\Controller;

use Blog\Helper\PaginatorHelper;
use Blog\Manager\RecipeManager;
use Core\Application\Controller\AbstractController;

/**
 * Class RecipeController
 */
class RecipeController extends AbstractController
{
    /** @var RecipeManager */
    private $recipeManager;

    /**
     * @return string
     */
    public function list()
    {
        return $this->listPerPage(1);
    }

    /**
     * @param $id
     *
     * @return string
     */
    public function listPerPage($id)
    {
        $recipes = $this->recipeManager->listRecipes();

        $paginatorHelper = new PaginatorHelper($recipes, $id, 5);
        $pagination = $paginatorHelper->getPaging();

        return $this->render('recipes.html.twig', [
            'title' => 'Recettes',
            'pagination' => $pagination,
        ]);
    }
}
