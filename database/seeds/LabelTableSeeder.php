<?php
use Illuminate\Database\Seeder;
use App\Models\Label;

class LabelTableSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['priority' => 10,
                'name' => 'equipment',
                'label' => 'Комплектация'

            ],
            [
                'priority' => 10,
                'name' => 'engine',
                'label' => 'Мотор'
            ],
            [
                'priority' => 10,
                'name' => 'power',
                'label' => 'Мощность'
            ],
            [
                'priority' => 10,
                'name' => 'transmission',
                'label' => 'Трансмиссия'
            ],
            [
                'priority' => 10,
                'name' => 'drive_unit',
                'label' => 'Привод'
            ],
            [
                'priority' => 150,
                'name' => 'body_type',
                'label' => 'Тип кузова'
            ],
            [
                'priority' => 10,
                'name' => 'colour',
                'label' => 'Цвет'
            ]
        ];

        foreach($data as $value)
        {
            Label::forceCreate($value);
        }
    }
}
