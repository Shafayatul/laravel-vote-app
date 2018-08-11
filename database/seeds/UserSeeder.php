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
      \DB::table('users')->delete();
      \DB::table('users')->insert(array(

        0 => array (

        'anr' => "Herr",
        'titel' => "MA",
        'vorname' => "Stefan",
        'name' => "Lehrner",
        'email' => "stefan@lehrner.org",
        'password' => Hash::make('x93rbinc!'),
        'rolle' => "0",
        'fb' => "stefan.lehrner1",
        'tel' => "+436505700550"
      ),

        1 => array (

        'anr' => "Frau",
        'titel' => "Mag.",
        'vorname' => "Bianca",
        'name' => "Lehrner",
        'email' => "office@hochzeitsplaner.co.at",
        'password' => Hash::make('x93rbinc!'),
        'rolle' => "9",
        'fb' => "stefan.lehrner1",
        'tel' => "+436505700550"
      ),

        2 => array (

        'anr' => "Frau",
        'titel' => "",
        'vorname' => "Bea",
        'name' => "Bewerterin",
        'email' => "bea@bewerterin.at",
        'password' => Hash::make('x93rbinc!'),
        'rolle' => "1",
        'fb' => "stefan.lehrner1",
        'tel' => "+436505700550"
      ),

        3 => array (

        'anr' => "Frau",
        'titel' => "",
        'vorname' => "User",
        'name' => "Userin",
        'email' => "user@userin.at",
        'password' => Hash::make('x93rbinc!'),
        'rolle' => "0",
        'fb' => "stefan.lehrner1",
        'tel' => "+436505700550"
        )

      ));
    }
}
