<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Firewall;
use App\Models\LocalHost;

class FirewallFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Firewall::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'detail' => $this->faker->text(),
            'local_host_id' => LocalHost::factory(),
        ];
    }
}
