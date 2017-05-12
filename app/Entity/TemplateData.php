<?php

namespace App\Entity;

class TemplateData
{
    /**
     * Шапка сайта
     * @var
     */
    private $header;

    /**
     * @var
     */
    private $benefits;

    /**
     * @var
     */
    private $products;


    /**
     * @var
     */
    private $reviews;

    public function __construct()
    {
        $this->benefits = ['list' => []];
        $this->products = ['list' => []];
        $this->reviews = ['list' => []];
    }

    public function setHeader($header)
    {
        $this->header = $header;
    }

    public function setBenefits(array $list, $title = '')
    {
        $this->benefits = [
            'title' => $title,
            'list' => $list
        ];
    }

    public function setProducts(array $list, array $label = [], $title = '')
    {
        $this->products = [
            'title' => $title,
            'label' => $label,
            'list' => $list
        ];
    }

    public function setReviews(array $list, $title = '')
    {
        $this->reviews = [
            'title' => $title,
            'list' => $list
        ];
    }

    /**
     * @return mixed
     */
    public function getHeader()
    {
        return $this->header;
    }

    /**
     * @return mixed
     */
    public function getBenefits()
    {
        return $this->benefits;
    }

    /**
     * @return mixed
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * @return mixed
     */
    public function getReviews()
    {
        return $this->reviews;
    }
}