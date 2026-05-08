<?php

namespace Database\Seeders;

use App\Models\ClassRoom;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class StudentSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');
        $classes = ClassRoom::all();

        for ($i = 1; $i <= 30; $i++) {
            $user = User::create([
                'name' => $faker->name,
                'email' => "student{$i}@example.com",
                'password' => Hash::make('password'),
            ]);
            $user->assignRole('student');

            Student::create([
                'user_id' => $user->id,
                'class_id' => $classes->random()->id,
                'nisn' => '100' . str_pad($i, 8, '0', STR_PAD_LEFT),
                'place_of_birth' => $faker->city,
                'date_of_birth' => $faker->date('Y-m-d', '-15 years'),
                'gender' => $faker->randomElement(['L', 'P']),
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'father_name' => $faker->name('male'),
                'mother_name' => $faker->name('female'),
                'parent_phone' => $faker->phoneNumber,
                'admission_year' => $faker->year,
                'is_active' => true,
            ]);
        }
    }
}