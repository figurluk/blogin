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

        \App\Settings::create([
            'design' => 1
        ]);

        $tag = App\Tags::create(array(
            'name' => 'Elektrik',
        ));
        $tag1 = App\Tags::create(array(
            'name' => 'Chemic',
        ));

        $user = App\User::create(array(
            'name' => 'Lukáš',
            'surname' => 'Figura',
            'admin' => 1,
            'email' => 'figurluk@gmail.com',
            'password' => Hash::make('qwerty')
        ));

        for ($i = 0; $i < 18; $i++) {

            $article = App\Articles::create(array(
                'title' => 'Nový článok' . $i,
                'topped' => 1,
                'content' => 'Lorem Ipsum je fiktívny text, používaný pri návrhu tlačovín a typografie. Lorem Ipsum je štandardným výplňovým textom už od 16. storočia, keď neznámy tlačiar zobral sadzobnicu plnú tlačových znakov a pomiešal ich, aby tak vytvoril vzorkovú knihu. Prežil nielen päť storočí, ale aj skok do elektronickej sadzby, a pritom zostal v podstate nezmenený. Spopularizovaný bol v 60-tych rokoch 20.storočia, vydaním hárkov Letraset, ktoré obsahovali pasáže Lorem Ipsum, a neskôr aj publikačným softvérom ako Aldus PageMaker, ktorý obsahoval verzie Lorem Ipsum.'
            ));

            $article->tags()->save($tag);
            $user->articles()->save($article);
        }
    }
}
