<?php

namespace Database\Factories;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $models =User::class;
    
    public function definition()
    {
        return [
            'name' => $this->faker->name(), // generate name
            'email' => $this->faker->unique()->safeEmail(), //generate format email
            'role'=>'user',
            'password'=>'user',// samakan password dengan user
            'status'=>'aktif',
            'last_login'=>now() 
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
