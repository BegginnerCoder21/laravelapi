<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'invoice_number' => Str::uuid(),
            'total_vat' => $vat = fake()->randomFloat(2,5000,50000),
            'total_price_excluding_vat' => $price = fake()->randomFloat(2,5000,50000),
            'total_price' => $vat + $price
        ];
    }
}
