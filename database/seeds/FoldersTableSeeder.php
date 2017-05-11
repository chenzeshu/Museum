<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FoldersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

//        factory(\App\Folder::class, 50)->create();
        factory(\App\Folder::class, 50)->create()->each(function ($u) {
            $i = 0;
            while ($i < 50 && $u['id'] < 863 ){
                $u->files()->save(factory(App\File::class)->make());
                $i++;
            }
        });
    }
}
