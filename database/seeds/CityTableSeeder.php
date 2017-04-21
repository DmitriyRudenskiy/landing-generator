<?php
use Illuminate\Database\Seeder;
use App\Models\City;

class CityTableSeeder extends Seeder
{

    public function run()
    {
        City::create([
            'id' => 1,
            'name' => 'Новосибирск'
        ]);

        City::create([
            'id' => 2,
            'name' => 'Москва'
        ]);
    }
}
