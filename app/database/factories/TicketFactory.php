<?php

namespace Database\Factories;

use App\Models\TicketType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TicketFactory extends Factory
{
    public function definition()
    {
        return [
            'title'=> $this->faker->title(),
            'description'=> $this->faker->paragraph(),
            'ticket_type_id'=> self::factoryForModel(TicketType::class),
            'user_id'=> self::factoryForModel(User::class),
        ];
    }
}
