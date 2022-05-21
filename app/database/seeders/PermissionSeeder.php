<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name'=>'see dashboard']);
        Permission::create(['name'=>'see charts']);

        Permission::create(['name'=>'see units']);
        Permission::create(['name'=>'see unit']);
        Permission::create(['name'=>'edit unit']);
        Permission::create(['name'=>'add unit']);
        Permission::create(['name'=>'delete unit']);
        Permission::create(['name'=>'export unit']);

        Permission::create(['name'=>'see ticketTypes']);
        Permission::create(['name'=>'see ticketType']);
        Permission::create(['name'=>'edit ticketType']);
        Permission::create(['name'=>'add ticketType']);
        Permission::create(['name'=>'delete ticketType']);
        Permission::create(['name'=>'export ticketTypes']);

        Permission::create(['name'=>'see ticketPriorities']);
        Permission::create(['name'=>'see ticketPriority']);
        Permission::create(['name'=>'edit ticketPriority']);
        Permission::create(['name'=>'add ticketPriority']);
        Permission::create(['name'=>'delete ticketPriority']);
        Permission::create(['name'=>'export ticketPriorities']);

        Permission::create(['name'=>'see readyAnswers']);
        Permission::create(['name'=>'see readyAnswer relations']);
        Permission::create(['name'=>'see readyAnswer']);
        Permission::create(['name'=>'edit readyAnswer']);
        Permission::create(['name'=>'edit readyAnswer relations']);
        Permission::create(['name'=>'add readyAnswer']);
        Permission::create(['name'=>'delete readyAnswer']);
        Permission::create(['name'=>'export readyAnswers']);

        Permission::create(['name'=>'see users']);
        Permission::create(['name'=>'see user']);
        Permission::create(['name'=>'edit user']);
        Permission::create(['name'=>'add user']);
        Permission::create(['name'=>'delete user']);
        Permission::create(['name'=>'import users']);
        Permission::create(['name'=>'export users']);

        Permission::create(['name'=>'see roles']);
        Permission::create(['name'=>'edit role']);
        Permission::create(['name'=>'add role']);
        Permission::create(['name'=>'delete role']);
        Permission::create(['name'=>'show rolePermissions']);
        Permission::create(['name'=>'edit rolePermissions']);

        Permission::create(['name'=>'see tickets']);
        Permission::create(['name'=>'see ticket']);
        Permission::create(['name'=>'answer ticket']);
        Permission::create(['name'=>'add ticket']);
        Permission::create(['name'=>'close ticket']);

        Permission::create(['name'=>'make report']);
    }
}
