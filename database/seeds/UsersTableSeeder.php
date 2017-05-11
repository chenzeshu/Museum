<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
           'name'=>'陈泽书',
            'email'=>'1193297950@qq.com',
            'password'=> bcrypt('666666')
        ]);
    }
}
