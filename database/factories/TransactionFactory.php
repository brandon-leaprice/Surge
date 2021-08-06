<?php

namespace Database\Factories;

use App\Models\Model;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class TransactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Transaction::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'amount' => $this->faker->numberBetween(1, 9000),
            'status' => Arr::random(['success', 'processing', 'failed']),
            'date' => $this->faker->date,
        ];
    }
}
