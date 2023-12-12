<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Tag::count()) {
            return;
        }

        Tag::insert([
            [
                'name' => 'Eloquent',
            ],
            [
                'name' => 'Blade',
            ],
            [
                'name' => 'Migrations',
            ],
            [
                'name' => 'Seeding',
            ],
            [
                'name' => 'Routing',
            ],
            [
                'name' => 'Controllers',
            ], [
                'name' => 'Middleware',
            ],
            [
                'name' => 'Requests',
            ],
            [
                'name' => 'Responses',
            ],
            [
                'name' => 'Views',
            ],
            [
                'name' => 'Forms',
            ],
            [
                'name' => 'Validation',
            ],
            [
                'name' => 'Mail',
            ],
            [
                'name' => 'Notifications',
            ],

        ]);
    }
}
