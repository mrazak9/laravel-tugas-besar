<?php

namespace Database\Factories;

use App\Models\Subject;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Mockery\Matcher\Subset;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Khs>
 */
class KhsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $users = User::where('roles', 'mahasiswa')->pluck('id')->toArray();
        $subject = Subject::pluck('id')->toArray();
        return [
            'subject_id' => $this->faker->randomElement($subject),
            'student_id' => $this->faker->randomElement($users),
            'nilai' => $nilai = $this->faker->randomElement(['4', '3', '2', '1', '0']),
            'grade' => $grade = ($nilai == '4') ? 'A' : (($nilai == '3') ? 'B' : (($nilai == '2') ? 'C' : (($nilai == '1') ? 'D' : 'E'))),
            'keterangan' => ($grade == 'A' || $grade == 'B' || $grade == 'C') ? 'Lulus' : 'Tidak Lulus',
            'tahun_akademik' => $this->faker->randomElement(['2021/2022', '2022/2023', '2023/2024']),
            'semester' => $this->faker->randomElement(['Ganjil', 'Genap']),
            'created_by' => $this->faker->randomElement(['1', '2', '3']),
            'updated_by' => $this->faker->randomElement(['1', '2', '3']),
        ];
    }
}
