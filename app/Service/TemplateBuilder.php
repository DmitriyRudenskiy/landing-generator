<?php

namespace App\Service;

use App\Entity\TemplateData;
use App\Models\Menu;
use App\Repository\BenefitsRepository;
use App\Repository\HeaderRepository;
use App\Repository\LabelRepository;
use App\Repository\ProductRepository;

class TemplateBuilder
{
    /**
     * @var BenefitsRepository
     */
    private $benefitsRepository;

    /**
     * @var HeaderRepository
     */
    private $headerRepository;

    /**
     * @var ProductRepository
     */
    private $productRepository;

    /**
     * @var
     */
    private $labelRepository;


    /**
     * @var Menu
     */
    private $menuRepository;

    /**
     * @var TemplateData
     */
    private $result;

    /**
     * TemplateBuilder constructor.
     * @param BenefitsRepository $benefitsRepository
     * @param HeaderRepository $headerRepository
     * @param ProductRepository $productRepository
     * @param LabelRepository $labelRepository
     * @param Menu $menuRepository
     */
    public function __construct(BenefitsRepository $benefitsRepository,
                                HeaderRepository $headerRepository,
                                ProductRepository $productRepository,
                                LabelRepository $labelRepository,
                                Menu $menuRepository)
    {
        $this->benefitsRepository = $benefitsRepository;
        $this->headerRepository = $headerRepository;
        $this->productRepository = $productRepository;
        $this->labelRepository = $labelRepository;
        $this->menuRepository = $menuRepository;
        $this->result = new TemplateData();
    }

    /**
     * @return $this
     */
    public function init()
    {

        // Устанавливаем шапку
        $this->result->setHeader($this->headerRepository->get());

        // Устанавливаем преимущества
        $benefits = [];
        $list = $this->benefitsRepository->getList();

        foreach ($list as $value) {
            $benefits[] = [
                'cover' => $value->getPath(),
                'title' => $value->title,
                'description' => $value->description,
            ];
        }

        $this->result->setBenefits($benefits);

        // Устанавливаем товары
        $this->result->setProducts(
            $this->productRepository->getList(),
            $this->labelRepository->getList(),
            'Полный модельный ряд MITSUBISHI FUSO CANTER'
        );

        // Устанавливаем отзывы
        $reviews = [
            [
                'avatar' => '/front/005.jpg',
                'name' => 'Лилия',
                'text' => 'Спасибо Вам огромное за шведскую стенку! Сына от неё не оттащишь! Комплектация просто отличная! Заглушки болтов и перекладины с покрытием против скольжения. Качество чувствуется в мелочах! За такую цену это самый толковый и укомплектованный детский спортивный комплекс. Буду рекомендовать друзьям!',
                'url' => 'https://vk.com/id32161717'
            ],
            [
                'avatar' => '',
                'name' => '',
                'text' => '',
                'url' => ''
            ]
        ];

        $this->result->setReviews($reviews);


        // Устанавливаем меню
        $this->result->setMenu(
            $this->menuRepository->getLogo(),
            $this->menuRepository->getItems(),
            $this->menuRepository->getPhone()
        );

        return $this;
    }

    /**
     * @return TemplateData
     *
     */
    public function get()
    {
        return $this->result;
    }
}