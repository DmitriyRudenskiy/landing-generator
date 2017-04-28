<?php
use Illuminate\Database\Seeder;
use App\Models\Benefits;

class CityTableSeeder extends Seeder
{

    public function run()
    {
        Benefits::create([
            'id' => 1,
            'name' => 'Новосибирск'
        ]);

        Benefits::create([
            'id' => 2,
            'name' => 'Москва'
        ]);
    }
}
