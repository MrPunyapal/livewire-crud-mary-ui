<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Category::count()) {
            return;
        }

        Category::insert([
            [
                'name' => 'Laravel',
            ],
            [
                'name' => 'PHP',
            ],
            [
                'name' => 'JavaScript',
            ],
            [
                'name' => 'Vue.js',
            ],
            [
                'name' => 'React.js',
            ],
            [
                'name' => 'Angular.js',
            ],
            [
                'name' => 'Java',
            ],
            [
                'name' => 'C#',
            ],
        ]);
    }
}
