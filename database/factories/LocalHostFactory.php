<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\LocalHost;
use App\Models\Scan;

class LocalHostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = LocalHost::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'operative_system' => $this->faker->text(),
            'scan_id' => Scan::factory(),
        ];
    }
}
