<?php

declare(strict_types=1);

/**
 * (c) Thibaut Tourte <thibaut.tourte17@gmail.com>
 */

namespace Blog\Helper;

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

    public function __construct(array $datas, int $currentPage = 1, int $nbPerPage = 5)
    {
        $this->datas = $datas;
        $this->nbTotal = count($datas);
        $this->currentPage = $currentPage;
        $this->nbPerPage = $nbPerPage;
        $this->totalPaging = $this->totalPaging();
    }

    public function totalPaging()
    {
        return ceil($this->getNbTotal()/$this->getNbPerPage());
    }

    public function getPaging()
    {
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

    public function previous()
    {
        return $this->getCurrentPage()>1 ? '' : 'disabled';
    }

    public function next()
    {
        return $this->getCurrentPage()<$this->getTotalPaging() ? '' : 'disabled';
    }

    public function limitDatas()
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
    public function getNbTotal()
    {
        return $this->nbTotal;
    }

    /**
     * @param mixed $nbTotal
     */
    public function setNbTotal($nbTotal)
    {
        $this->nbTotal = $nbTotal;
    }

    /**
     * @return mixed
     */
    public function getNbPerPage()
    {
        return $this->nbPerPage;
    }

    /**
     * @param mixed $nbPerPage
     */
    public function setNbPerPage($nbPerPage)
    {
        $this->nbPerPage = $nbPerPage;
    }

    /**
     * @return mixed
     */
    public function getCurrentPage()
    {
        return $this->currentPage;
    }

    /**
     * @param mixed $currentPage
     */
    public function setCurrentPage($currentPage)
    {
        $this->currentPage = $currentPage;
    }

    /**
     * @return float
     */
    public function getTotalPaging(): float
    {
        return $this->totalPaging;
    }

    /**
     * @param float $total
     */
    public function setTotal(float $total)
    {
        $this->totalPaging = $total;
    }

    /**
     * @return array
     */
    public function getDatas(): array
    {
        return $this->datas;
    }

    /**
     * @param array $datas
     */
    public function setDatas(array $datas)
    {
        $this->datas = $datas;
    }
}
