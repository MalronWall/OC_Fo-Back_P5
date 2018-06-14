<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace Blog\Helper;

use Blog\Controller\ErrorController;
use Core\Application\Exception\NotFoundHttpException;

class PaginatorHelper
{
    // Données à traiter
    private $datas;
    // Nombre total d'objet
    private $nbTotal;
    // Nombre d'objet par page
    private $nbPerPage;
    // N° de la page courante
    private $currentPage;
    // Nombre total de pagination
    private $totalPaging;

    /**
     * @param array $datas
     * @param int $currentPage
     * @param int $nbPerPage
     * @return array
     */
    public function getPaging(array $datas, int $currentPage = 1, int $nbPerPage = 5)
    {
        $this->datas = $datas;
        $this->nbTotal = count($datas);
        $this->currentPage = $currentPage;
        $this->nbPerPage = $nbPerPage;
        $this->totalPaging = $this->totalPaging();
        
        return [
            'previous' => $this->previous(),
            'next' => $this->next(),
            'totalPaging' => $this->getTotalPaging(),
            'currentPage' => $this->getCurrentPage(),
            'nbPerPage' => $this->getNbPerPage(),
            'nbTotal' => $this->getNbTotal(),
            'datas' => $this->limitDatas()
        ];
    }

    /**
     * @return float
     */
    private function totalPaging()
    {
        return ceil($this->getNbTotal()/$this->getNbPerPage());
    }

    /**
     * @return array
     */
    private function previous()
    {
        $currentPage = $this->getCurrentPage();

        return [
            'display' => $currentPage>1 ? '' : 'disabled',
            'href' => $currentPage-1>0 ? $currentPage-1 : $currentPage
        ];
    }

    /**
     * @return array
     */
    private function next()
    {
        $currentPage = $this->getCurrentPage();
        $totalPaging = $this->getTotalPaging();

        return [
            'display' => $currentPage<$totalPaging ? '' : 'disabled',
            'href' => $currentPage<$totalPaging ? $currentPage+1 : $currentPage
        ];
    }

    /**
     * @return array
     */
    private function limitDatas()
    {
        return array_slice(
            $this->getDatas(),
            $this->getNbPerPage()*($this->getCurrentPage()-1),
            $this->getNbPerPage()
        );
    }

    /**
     * @return mixed
     */
    private function getNbTotal()
    {
        return $this->nbTotal;
    }

    /**
     * @param mixed $nbTotal
     */
    private function setNbTotal($nbTotal)
    {
        $this->nbTotal = $nbTotal;
    }

    /**
     * @return mixed
     */
    private function getNbPerPage()
    {
        return $this->nbPerPage;
    }

    /**
     * @param mixed $nbPerPage
     */
    private function setNbPerPage($nbPerPage)
    {
        $this->nbPerPage = $nbPerPage;
    }

    /**
     * @return mixed
     */
    private function getCurrentPage()
    {
        try {
            if (($this->getTotalPaging() < $this->currentPage)&&($this->getTotalPaging()!=0)) {
                throw new NotFoundHttpException('No page found for this id !');
            }

            if ($this->currentPage == 0) {
                return 1;
            }
            return $this->currentPage;
        } catch (NotFoundHttpException $e) {
            $error = new ErrorController();
            return $error->notFound();
        }
    }

    /**
     * @param mixed $currentPage
     */
    private function setCurrentPage($currentPage)
    {
        $this->currentPage = $currentPage;
    }

    /**
     * @return float
     */
    private function getTotalPaging(): float
    {
        return $this->totalPaging;
    }

    /**
     * @param float $total
     */
    private function setTotal(float $total)
    {
        $this->totalPaging = $total;
    }

    /**
     * @return array
     */
    private function getDatas(): array
    {
        return $this->datas;
    }

    /**
     * @param array $datas
     */
    private function setDatas(array $datas)
    {
        $this->datas = $datas;
    }
}
