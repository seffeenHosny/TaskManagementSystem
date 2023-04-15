<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $manager = User::create([
            'name'=>'manager',
            'email'=>'manager@gmail.com',
            'password'=>bcrypt('123456')
        ]);

        $manager->assignRole('manager');

        for($i= 0 ; $i <=10 ; $i++){

            $employee = User::create([
                'name'=>"employee_$i",
                'email'=>"employee_$i@gmail.com",
                'password'=>bcrypt('123456')
            ]);

            $employee->assignRole('employee');
        }
    }
}
