<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TechnologiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $technologies = [];

        $technologies = [
            ['name' => 'HTML/CSS'],
            ['name' => 'JavaScript'],
            ['name' => 'Vue JS'],
            ['name' => 'PHP'],
            ['name' => 'Laravel'],
            ['name' => 'React'],
            ['name' => 'Node JS'],
            ['name' => 'MySQL'],
            ['name' => 'Angular'],
            ['name' => 'C++'],
            ['name' => 'Python'],
            ['name' => 'Java'],
            ['name' => 'Vite'],
            ['name' => 'Ruby'],
            ['name' => 'Bootstrap'],
        ];

        foreach ($technologies as $technology) {
            Technology::create($technology);
        }
    }
}
