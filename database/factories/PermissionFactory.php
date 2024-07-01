<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Permission>
 */
class PermissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => 11,
            'permit_type' => $this->faker->randomElement(['annual', 'sick', 'wfh']),
            'leave_date' => $this->faker->date(),
            'duration' => $this->faker->numberBetween(1, 10),
            'reason' => $this->faker->text(),
            'file_url' => $this->faker->imageUrl(),
            'status' => $this->faker->randomElement(['pending', 'approved', 'rejected']),
        ];
    }
}
