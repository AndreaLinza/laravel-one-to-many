<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Generator as Faker;


class TechnologiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {

        $technologies = [
            [
                'name' => 'Vue',
                'icon' => 'fa-brands fa-vuejs'
            ],
            [
                'name' => 'React',
                'icon' => 'fa-brands fa-react'
            ],
            [
                'name'=>'JS',
                'icon'=>'fa-brands fa-js'

            ],
            [
                'name'=>'CSS',
                'icon'=>'fa-brands fa-css3-alt'

            ],
            [
                'name'=>"SCSS",
                'icon'=>'fa-brands fa-sass'

            ],
            [
                'name'=>"Bootstrap",
                'icon'=>'fa-brands fa-bootstrap'

            ],
            [
                'name'=>"PHP",
                'icon'=>'fa-brands fa-php'

            ],
            [
                'name'=>"Laravel",
                'icon'=>'fa-brands fa-laravel'

            ],
            [
                'name'=>"NodeJs",
                'icon'=>'fa-brands fa-node'
            ]

        ];



        //faccio un ciclo foreach sull'array che per ogni ciclo 
        foreach ($technologies as $technology) {
            //Ci andiamo a creare un nuovo technology
            $new_technology = new Technology();
            //assegniamo i valori alle varie proprietà
            $new_technology->name = $technology['name'];
            $new_technology->icon = $technology['icon'];
            $new_technology->slug = Str::slug($new_technology->name);
            $new_technology->color = $faker->rgbColor();
            //ce lo salviamo
            $new_technology->save();
        }
    }
}
