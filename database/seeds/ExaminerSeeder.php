<?php

use Illuminate\Database\Seeder;

class ExaminerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = 30;
        factory(App\examiner::class, $count)->create();
    }
}
