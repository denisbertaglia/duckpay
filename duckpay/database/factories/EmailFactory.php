<?php

namespace Database\Factories;

use App\Models\Email;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Email>
 */
class EmailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $count = $this->count;
        $logins = array_fill(1, $count,false);
        $logins[0] = true;
        $login = fake()->randomElements($logins);
        $isLogin = array_pop($login);
        return [
            'email' => fake()->unique()->email(),
            'login' => $isLogin,
        ];
    }
}
