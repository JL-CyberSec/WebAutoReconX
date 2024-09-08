<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Host;
use App\Models\Port;

class PortFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Port::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'number' => $this->faker->word(),
            'host_id' => Host::factory(),
        ];
    }
}
