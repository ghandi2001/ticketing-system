<?php

namespace Database\Factories;

use App\Models\TicketPriority;
use App\Models\Unit;
use Illuminate\Database\Eloquent\Factories\Factory;

class TicketTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'=>$this->faker->title(),
            'description'=>$this->faker->paragraph(),
            'unit_id'=>self::factoryForModel(Unit::class),
            'ticket_priority_id'=>self::factoryForModel(TicketPriority::class),
        ];
    }
}
