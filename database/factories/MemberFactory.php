<?php

namespace Database\Factories;

use App\Models\Biaya;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Member>
 */
class MemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $biaya = Biaya::factory()->create(); // Membuat biaya baru
        return [
            // 'client_id' => fake()->randomElement(User::where('akses', 'client')->pluck('id')->toArray()),
            // // 'client_status' => 'ok',
            // 'nama' => fake()->name(),
            // 'nohp' => fake()->numberBetween(6285700000000, 6285799999999),
            // 'biaya_id' => 1,
            // 'idpel' => fake()->numberBetween(100000, 999999),
            // 'desa' => 'Kalikatir',
            // 'kecamatan' => 'Gondang',
            // 'alamat_lengkap' => 'Ds. Kalikatir Kec. Gondang',
            // 'paket' => '3 Mbps 120k',
            // 'user_id' => 1,
            // // 'status' => 'aktif'
            'client_id' => User::where('akses', 'client')->pluck('id')->random(),
            'nama' => $this->faker->name(),
            'nohp' => $this->faker->phoneNumber(),
            'biaya_id' => $biaya->id, // Menggunakan id biaya yang baru dibuat
            'idpel' => $this->faker->unique()->randomNumber(6),
            'desa' => 'Kalikatir',
            'kecamatan' => 'Gondang',
            'alamat_lengkap' => 'Ds. Kalikatir Kec. Gondang',
            'paket' => $biaya->nama, // Menggunakan nama biaya yang baru dibuat
            'user_id' => 1,
        ];
    }
}
