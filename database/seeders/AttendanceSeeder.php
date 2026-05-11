<?php

namespace Database\Seeders;

use App\Models\Attendance;
use App\Models\ClassRoom;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AttendanceSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil semua user dengan role student
        $students = User::role('student')->get();

        $statuses = ['hadir', 'izin', 'sakit', 'alpha'];
        $days = 30; // 30 hari ke belakang

        $startDate = Carbon::now()->subDays($days);

        for ($i = 0; $i < $days; $i++) {
            $date = $startDate->copy()->addDays($i);

            // Lewati hari Sabtu dan Minggu
            if ($date->isWeekend()) {
                continue;
            }

            foreach ($students as $student) {
                // Probabilitas status: 70% hadir, 30% lainnya
                $rand = rand(1, 100);
                $status = $rand <= 70 ? 'hadir' : $statuses[array_rand($statuses)];

                // Jam check-in acak antara 07:00 - 08:30
                $hour = rand(7, 8);
                $minute = ($hour == 8) ? rand(0, 30) : rand(0, 59);
                $checkInTime = Carbon::create($date->year, $date->month, $date->day, $hour, $minute, 0);

                // Koordinat GPS dummy (area sekitar sekolah)
                $latitude = -6.200000 + (rand(-100, 100) / 10000);
                $longitude = 106.800000 + (rand(-100, 100) / 10000);

                // Foto selfie dummy (isi dengan path placeholder jika status hadir)
                $photoSelfie = null;
                if ($status === 'hadir' && rand(1, 100) > 30) {
                    $photoSelfie = 'dummy/selfie_' . rand(1, 5) . '.jpg';
                }

                // Face recognition: umumnya true jika hadir, dengan sedikit error
                $faceMatched = ($status === 'hadir') ? (rand(1, 100) > 10) : false;

                // Ambil class_id dari relasi student (jika ada)
                $classId = null;
                if (method_exists($student, 'student') && $student->student) {
                    $classId = $student->student->class_id;
                } elseif ($student->class_id) {
                    $classId = $student->class_id;
                } else {
                    // Fallback: ambil kelas random
                    $classId = ClassRoom::inRandomOrder()->first()->id ?? null;
                }

                Attendance::create([
                    'user_id' => $student->id,
                    'class_id' => $classId,
                    'date' => $date,
                    'check_in_time' => $checkInTime,
                    'check_out_time' => null,
                    'status' => $status,
                    'latitude' => $latitude,
                    'longitude' => $longitude,
                    'photo_selfie' => $photoSelfie,
                    'face_matched' => $faceMatched,
                    'qr_code' => 'SEEDER_' . rand(100000, 999999),
                    'device_info' => 'SeederDevice/1.0',
                    'verified_by' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}