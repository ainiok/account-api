<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Admin::updateOrCreate([
            'email' => \App\Common\Constant::ADMIN_EMAIL,
            'uid'   => \App\Common\Constant::ADMIN_UID
        ], [
            'password' => \App\Common\Constant::ADMIN_INIT_PWD
        ]);
    }
}
