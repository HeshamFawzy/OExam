<?php

use Illuminate\Database\Seeder;

class UserExamEnrollSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = 30;
        factory(App\user_exam_enroll::class, $count)->create();
    }
}
