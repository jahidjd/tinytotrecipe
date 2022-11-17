<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Recipe;

class ReciepSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Recipe::create([
            'user_id' => '2',
            'recipe_name' => 'Test Recipe',
            'ingredients' => 'test etst test etst',
            'steps' => '["Test 1","Test 2","Test 3","Test 4"]',
            'cook_time' => '10',
            'prep_time' => '10',
            'serves' => '10',
            'image' => 'Test 220221111095510.jpg',
            'video' => 'https://www.youtube.com/embed/eb_E1UeywWQ',
            'recomended_age' => '5',
            
        ]);
    }
}
