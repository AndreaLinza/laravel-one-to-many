<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            [
                'name' => 'FrontEnd',
                'color' => '156,39,176'
            ],
            [
                'name' => 'Backend',
                'color' => '3,169,244'
            ],
            [

                'name' => 'Fullstack',
                'color' => '255,87,34'
            ],
            [
                'name' => 'Design',
                'color' => '76,175,80'
            ]
        ];

        //faccio un ciclo foreach sull'array che per ogni ciclo 
        foreach ($types as $type) {
            //Ci andiamo a creare un nuovo type
            $new_type = new Type();
            //assegniamo i valori alle varie proprietà
            $new_type->name = $type['name'];
            $new_type->color = $type['color'];
            //ce lo salviamo
            $new_type->save();
        }
    }
}
