<?php

namespace App\Entity;

use App\Models\Form;

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

    /**
     * @var array
     */
    private $menu;

    /**
     * @var
     */
    private $title;

    /**
     * @var Form[]
     */
    private $form = [];

    public function __construct()
    {
        $this->benefits = ['list' => []];
        $this->products = ['list' => []];
        $this->reviews = ['list' => []];
        $this->menu = [
            'logo' => [],
            'phone' => [],
            'list'=> []
        ];

        $this->form = [
            'modal' => [],
            'widget' => []
        ];

        $this->title = [];
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

    public function setProducts(array $list, array $label = [], $title = '', $button = [])
    {
        $this->products = [
            'title' => $title,
            'label' => $label,
            'list' => $list,
            'button' => $button
        ];
    }

    public function setReviews($list, $title = '')
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

    /**
     * @return array
     */
    public function getMenu()
    {
        return $this->menu;
    }

    /**
     * @param array $menu
     */
    public function setMenu($logo, $items, $phone)
    {
        $this->menu = [
            'logo' => $logo,
            'phone' => $phone,
            'list'=> $items
        ];
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return \App\Models\Form[]
     */
    public function getForm()
    {
        return $this->form;
    }

    /**
     * @param Form|null $modal
     * @param Form|null $widget
     */
    public function setForm($modal, $widget)
    {
        $this->form = [
            'modal' => $modal,
            'widget' => $widget
        ];
    }
}