<?php

namespace Database\Factories;

use App\Models\Reservation;
use App\Models\User;
use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
{
    protected $model = Reservation::class;

    public function definition(): array
    {
        $checkIn = fake()->dateTimeBetween('+1 day', '+30 days');
        $checkOut = fake()->dateTimeBetween($checkIn, '+60 days');

        return [
            'user_id'    => User::factory(),
            'service_id' => Service::factory(),
            'status'     => fake()->randomElement(['pending', 'confirmed', 'cancelled']),
            'check_in'   => $checkIn,
            'check_out'  => $checkOut,
            'notes'      => fake()->optional()->sentence(),
        ];
    }

    public function pending(): static
    {
        return $this->state(fn () => ['status' => 'pending']);
    }

    public function confirmed(): static
    {
        return $this->state(fn () => ['status' => 'confirmed']);
    }

    public function cancelled(): static
    {
        return $this->state(fn () => [
            'status'       => 'cancelled',
            'cancelled_at' => now(),
        ]);
    }
}
