<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Teacher;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class TeacherSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');
        
        $subjects = ['Matematika', 'Fisika', 'Kimia', 'Biologi', 'Bahasa Indonesia', 
                     'Bahasa Inggris', 'Sejarah', 'Geografi', 'Ekonomi', 'Sosiologi', 
                     'PKn', 'Prakarya', 'Informatika', 'Seni Budaya', 'PJOK'];
        
        for ($i = 1; $i <= 30; $i++) {
            $user = User::create([
                'name' => $faker->name,
                'email' => "guru{$i}@sekolah.sch.id",
                'password' => Hash::make('password'),
            ]);
            $user->assignRole('teacher');
            
            Teacher::create([
                'user_id' => $user->id,
                'nik' => '16' . $faker->randomNumber(8, true),
                'nuptk' => $faker->optional()->numerify('##############'),
                'place_of_birth' => $faker->city,
                'date_of_birth' => $faker->date('Y-m-d', '-25 years'),
                'gender' => $faker->randomElement(['L', 'P']),
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'subject_specialization' => $faker->randomElement($subjects),
                'education' => $faker->randomElement(['S1', 'S2', 'S3']),
                'hire_date' => $faker->date('Y-m-d', '-5 years'),
                'is_active' => true,
            ]);
        }
    }
}