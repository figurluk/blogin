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
        DB::table('tags')->delete();
        DB::table('comments')->delete();
        DB::table('settings')->delete();

        $user = App\User::create(array(
            'name' => 'Milos',
            'surname' => 'Pridavok',
            'email' => 'pridavok@gmail.com',
            'password' => Hash::make('qwerty')
        ));

        \App\Settings::create([
            'design'=>1
        ]);

        $tag = App\Tags::create(array(
            'name' => 'Elektrik',
        ));
        $tag1 = App\Tags::create(array(
            'name' => 'Chemic',
        ));

        App\User::create(array(
            'name' => 'Lukas',
            'surname' => 'Figura',
            'admin' => 1,
            'email' => 'figurluk@gmail.com',
            'password' => Hash::make('qwerty')
        ));

        for ($i = 0; $i < 18; $i++) {

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

            if ($i % 2 == 0)
                $article->tags()->save($tag);

            $user->articles()->save($article);
        }
    }
}
