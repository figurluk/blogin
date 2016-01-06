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
        DB::table('articles')->delete();

        $user = App\User::create(array(
            'name' => 'Lukas',
            'surname' => 'Figura',
            'email' => 'figurluk@gmail.com',
            'password' => Hash::make('qwerty')
        ));

        for ($i = 0; $i < 8; $i++) {

            $article = App\Articles::create(array(
                'title' => 'Skusobny clanok' . $i,
                'topped' => 1,
                'content' => 'kajsdh kjashd k jsahdjkhaskdh uahsd haskjhd pasd phasdh ajshdu has;dh ashd asdasd
                kajsdh kjashd k jsahdjkhaskdh uahsd haskjhd pasd phasdh ajshdu has;dh ashd asdasd
                kajsdh kjashd k jsahdjkhaskdh uahsd haskjhd pasd phasdh ajshdu has;dh ashd asdasd
                kajsdh kjashd k jsahdjkhaskdh uahsd haskjhd pasd phasdh ajshdu has;dh ashd asdasd
                kajsdh kjashd k jsahdjkhaskdh uahsd haskjhd pasd phasdh ajshdu has;dh ashd asdasd
                kajsdh kjashd k jsahdjkhaskdh uahsd haskjhd pasd phasdh ajshdu has;dh ashd asdasd
                kajsdh kjashd k jsahdjkhaskdh uahsd haskjhd pasd phasdh ajshdu has;dh ashd asdasd
                kajsdh kjashd k jsahdjkhaskdh uahsd haskjhd pasd phasdh ajshdu has;dh ashd asdasd
                kajsdh kjashd k jsahdjkhaskdh uahsd haskjhd pasd phasdh ajshdu has;dh ashd asdasd'
            ));

            $user->articles()->save($article);

        }

    }

}
