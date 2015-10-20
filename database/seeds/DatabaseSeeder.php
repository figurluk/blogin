<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

         $this->call('UserTableSeeder');

    }
}


class UserTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('users')->delete();

        App\User::create(array(
            'name' => 'Lukas',
            'surname' => 'Figura',
            'email' => 'figurluk@gmail.com',
            'password' => Hash::make('qwerty')
        ));

    }

}
