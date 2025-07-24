<?php

namespace Database\Seeders;

use App\Models\listing;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        // User::factory(10)->create();

        /*User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);*/
        //ketache yalew single line code 10 user seed yemiyareg nw
        User::factory(10)->create();
        listing::create([
            'title'=>'laravel senior developer',
            'tags'=>'laravel, Javascript',
            'company'=>'Acme Corp',
            'location'=>'Boston',
            'email'=>'email@email.com',
            'website'=>'https://Acme.com',
            'description'=>'We are looking for a senior Laravel developer with 5+ years of experience.'
        ]);
        listing::create([
            'title'=>'Full-Stack Developer',
            'tags'=>'Laravel, Backend, Api',
            'company'=>'KurazTech',
            'location'=>'Addis Ababa',
            'email'=>'email2@email.com',
            'website'=>'https://kuraztech.com',
            'description'=>'We are looking for a full-stack developer with expertise in Laravel and API development',
        ]);
    }
}
