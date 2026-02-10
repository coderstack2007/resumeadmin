<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobsTableSeeder extends Seeder
{
    public function run(): void
    {
        $jobs = [
            ['name_ru' => 'DevOps Engineer', 'name_uz' => 'DevOps Engineer'],
            ['name_ru' => 'Cyber Security Specialist', 'name_uz' => 'Cyber Security Specialist'],
            ['name_ru' => 'Middle Developer', 'name_uz' => 'Middle Developer'],
            ['name_ru' => 'Senior Developer', 'name_uz' => 'Senior Developer'],
            ['name_ru' => 'Frontend Developer', 'name_uz' => 'Frontend Developer'],
            ['name_ru' => 'Backend Developer', 'name_uz' => 'Backend Developer'],
            ['name_ru' => 'Full Stack Developer', 'name_uz' => 'Full Stack Developer'],
            ['name_ru' => 'QA Engineer', 'name_uz' => 'QA Engineer'],
            ['name_ru' => 'Project Manager', 'name_uz' => 'Project Manager'],
            ['name_ru' => 'UI/UX Designer', 'name_uz' => 'UI/UX Designer'],
        ];

        foreach ($jobs as $job) {
            DB::table('jobs')->insert($job);
        }
    }
}