<?php


namespace Pageblok\Users\Databases;


use Pageblok\Users\Models\User;

class UserSeeder extends \Seeder
{

    public function run()
    {
        $user = new User();
        $user->username = 'adis';
        $user->email = 'adis@live.nl';
        $user->password = 'secret';
        $user->password_confirmation = 'secret';
//        $user->email = 'niek_vanbergen@hotmail.com';
//        $user->password = 'Gehe1mNI3k';
//        $user->password_confirmation = 'Gehe1mNI3k';
        $user->confirmation_code = md5(uniqid(mt_rand(), true));
        $user->confirmed = 1;

        $user->save();


    }
} 