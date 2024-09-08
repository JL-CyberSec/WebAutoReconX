<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Pentesting;
use App\Models\Scan;

class ScanFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Scan::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'type' => $this->faker->randomElement(["blackbox",""]),
            'nmap_timing' => $this->faker->randomElement(["1","2","3","4","5"]),
            'pentesting_id' => Pentesting::factory(),
        ];
    }
}
