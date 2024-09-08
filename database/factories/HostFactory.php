<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Host;
use App\Models\Scan;

class HostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Host::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'ip' => $this->faker->word(),
            'has_http' => $this->faker->boolean(),
            'scan_id' => Scan::factory(),
        ];
    }
}
