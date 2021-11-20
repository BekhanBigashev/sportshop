<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [];
        $data [] = [
            'name'=>'Админ',
            'email'=>'admin@testmailg.ru',
            'password'=>bcrypt('qwerty1234'),
        ];
        for($i = 1; $i<=5; $i++){
            $data [] = [
                'name'=>'Пользователь '.$i,
                'email'=>'ueser'.$i.'@testmailg.ru',
                'password'=> '123456789',
            ];
        }


        DB::table('users')->insert($data);
    }
}
