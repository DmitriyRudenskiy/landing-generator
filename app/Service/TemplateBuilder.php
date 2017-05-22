<?php

namespace App\Service;

use App\Entity\TemplateData;
use App\Models\Menu;
use App\Repository\BenefitsRepository;
use App\Repository\HeaderRepository;
use App\Repository\LabelRepository;
use App\Repository\ProductRepository;
use App\Repository\ReviewsRepository;
use App\Repository\TitleRepository;

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
     * @var ReviewsRepository
     */
    private $reviewsRepository;

    /**
     * @var Menu
     */
    private $menuRepository;

    /**
     * @var
     */
    private $titleRepository;

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
     * @param TitleRepository $titleRepository
     * @param ReviewsRepository $reviewsRepository
     */
    public function __construct(BenefitsRepository $benefitsRepository,
                                HeaderRepository $headerRepository,
                                ProductRepository $productRepository,
                                LabelRepository $labelRepository,
                                Menu $menuRepository,
                                TitleRepository $titleRepository,
                                ReviewsRepository $reviewsRepository
)
    {
        $this->benefitsRepository = $benefitsRepository;
        $this->headerRepository = $headerRepository;
        $this->productRepository = $productRepository;
        $this->labelRepository = $labelRepository;
        $this->menuRepository = $menuRepository;
        $this->titleRepository = $titleRepository;
        $this->reviewsRepository = $reviewsRepository;
        $this->result = new TemplateData();
    }

    /**
     * @return $this
     */
    public function init()
    {
        $titleList = $this->titleRepository->getList();
        $this->result->setTitle($titleList);

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

        $productTitle = '';

        if (!empty($titleList['title_product'])) {
            $productTitle = $titleList['title_product'];
        }

        // Устанавливаем товары
        $this->result->setProducts(
            $this->productRepository->getList(),
            $this->labelRepository->getList(),
            $productTitle
        );

        $reviewsTitle = 'Отзывы посетителей';

        if (!empty($titleList['title_reviews'])) {
            $reviewsTitle = $titleList['title_reviews'];
        }

        // Устанавливаем отзывы
        $this->result->setReviews(
            $this->reviewsRepository->getList(),
            $reviewsTitle
        );

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