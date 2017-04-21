<?php
use Illuminate\Database\Seeder;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Количество создаваемых записей
     */
    const COUNT = 5;

    /**
     * Пароль для всех записей
     */
    const PASSWORD_FOR_ALL = '123';

    public function run()
    {
        $faker = Faker\Factory::create('ru_RU');

        foreach(range(1,25) as $index)
        {
            User::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => md5(str_random(random_int(5, 11))),
            ]);
        }
    }
}
