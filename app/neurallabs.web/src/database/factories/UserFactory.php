<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'role_id' => 1,
            'telephone'=> $this->faker->phoneNumber,
            'password' => Hash::make('12345678'),
            'remember_token' => Str::random(10),
            'updated_at'=> $this->faker->dateTimeBetween($startDate = '-7 days', $endDate = 'now')
        ];
    }
}