<?php

namespace Database\Seeders;

use App\Models\ClassRoom; // atau App\Models\Classes
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ClassroomSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        
        $majors = [
            'IPA', 'IPS', 'Bahasa', 
            'TKJ', 'RPL', 'MM', 'AKL', 'OTKP', 'BDP'
        ];
        
        $grades = [10, 11, 12];
        
        $currentYear = date('Y');
        $academicYears = [
            ($currentYear - 1) . '/' . $currentYear,
            $currentYear . '/' . ($currentYear + 1)
        ];
        
        for ($i = 1; $i <= 30; $i++) {
            $grade = $faker->randomElement($grades);
            $major = $faker->randomElement($majors);
            
            $romanGrade = $this->romanize($grade);
            $classNumber = $faker->numberBetween(1, 5);
            $name = "{$romanGrade} {$major} {$classNumber}";
            
            if ($faker->boolean(20)) {
                $name = "{$romanGrade} {$faker->randomElement(['A', 'B', 'C', 'D'])}";
            }
            
            ClassRoom::create([
                'name' => $name,
                'grade' => (string) $grade,
                'academic_year' => $faker->randomElement($academicYears),
                'teacher_id' => $faker->numberBetween(1, 10),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
    
    private function romanize($number)
    {
        $romanNumbers = [
            10 => 'X',
            11 => 'XI',
            12 => 'XII',
        ];
        return $romanNumbers[$number] ?? (string) $number;
    }
}