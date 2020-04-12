<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*$this->call(UserSeeder::class);
        $this->call(ExamSeeder::class);
        $this->call(ExaminerSeeder::class);
        $this->call(UserExamEnrollSeeder::class);*/
        $this->call(QuestionSeeder::class);
        $this->call(OptionSeeder::class);
    }
}
