<?php

namespace App\Service;

use App\Entity\TemplateData;
use App\Repository\BenefitsRepository;
use App\Repository\HeaderRepository;
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
     * @var TemplateData
     */
    private $result;

    /**
     * TemplateBuilder constructor.
     *
     * @param BenefitsRepository $benefitsRepository
     * @param HeaderRepository $headerRepository
     * @param ProductRepository $productRepository
     */
    public function __construct(BenefitsRepository $benefitsRepository,
                                HeaderRepository $headerRepository,
                                ProductRepository $productRepository)
    {
        $this->benefitsRepository = $benefitsRepository;
        $this->headerRepository = $headerRepository;
        $this->productRepository = $productRepository;
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
            'Шведские стенки для взрослых и детей'
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