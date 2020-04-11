<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = 100;
        factory(App\User::class, $count)->create()->each(function($u) {
            $u->assignRole('UnVerify');
        });
    }
}
