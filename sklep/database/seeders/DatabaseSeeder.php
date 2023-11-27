<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //\App\Models\Category::factory(6)->create();
        \App\Models\Product::factory(16)->create();

        // \App\Models\User::factory(10)->create();
//
//         \App\Models\orders::factory()->create([
//        //     'name' => 'Test User',
//        //     'email' => 'test@example.com',
//             'firstName'=>'Ostap',
//'lastName'=>'Florchuk',
//'adres'=>'Polska, Nadbystrzycka',
//'city'=>'Lublin',
//'country'=>'Poland',
//'postCode'=>'20-501',
//'phone'=>'+48730941662',
//'email'=>'fljortchuk@gmail.com',
//'productIds'=>'1,2,3,4'

//             $table->string('firstName');
//        $table->string('lastName');
//        $table->string('adres');
//        $table->string('city');
//        $table->string('country');
//        $table->string('postCode');
//        $table->string('phone')->unique();
//        $table->string('email');
//        $table->string('productIds');
         //]);
    }
}
