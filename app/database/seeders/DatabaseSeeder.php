<?php

namespace Database\Seeders;

use App\Models\Ticket;
use App\Models\TicketPriority;
use App\Models\TicketType;
use App\Models\Unit;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        TicketPriority::factory()->count(10)->create();
        Unit::factory()->count(10)->create();
        TicketType::factory()->count(10)->create();
        Ticket::factory()->count(10)->create();
        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
    }
}
