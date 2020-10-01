<?php

namespace Database\Factories;

use App\Models\Author;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AuthorFactory extends Factory
{
  protected $model =  Author::class;

  public function definition()
  {
    return [
      'gender' => $gender = $this->faker->randomElement(['male', 'female']),
      'name' => $this->faker->name($gender),
      'country' => $this->faker->country
    ];
  }
}
