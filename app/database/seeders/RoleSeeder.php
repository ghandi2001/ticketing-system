<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdmin = Role::create(['name' => 'superAdmin']);

        $superAdmin->givePermissionTo('see dashboard');
        $superAdmin->givePermissionTo('see charts');

        $superAdmin->givePermissionTo('see units');
        $superAdmin->givePermissionTo('see unit');
        $superAdmin->givePermissionTo('edit unit');
        $superAdmin->givePermissionTo('add unit');
        $superAdmin->givePermissionTo('delete unit');
        $superAdmin->givePermissionTo('export unit');

        $superAdmin->givePermissionTo('see ticketTypes');
        $superAdmin->givePermissionTo('see ticketType');
        $superAdmin->givePermissionTo('edit ticketType');
        $superAdmin->givePermissionTo('add ticketType');
        $superAdmin->givePermissionTo('delete ticketType');
        $superAdmin->givePermissionTo('export ticketTypes');

        $superAdmin->givePermissionTo('see ticketPriorities');
        $superAdmin->givePermissionTo('see ticketPriority');
        $superAdmin->givePermissionTo('edit ticketPriority');
        $superAdmin->givePermissionTo('add ticketPriority');
        $superAdmin->givePermissionTo('delete ticketPriority');
        $superAdmin->givePermissionTo('export ticketPriorities');

        $superAdmin->givePermissionTo('see readyAnswers');
        $superAdmin->givePermissionTo('see readyAnswer');
        $superAdmin->givePermissionTo('see readyAnswer relations');
        $superAdmin->givePermissionTo('edit readyAnswer relations');
        $superAdmin->givePermissionTo('edit readyAnswer');
        $superAdmin->givePermissionTo('add readyAnswer');
        $superAdmin->givePermissionTo('delete readyAnswer');
        $superAdmin->givePermissionTo('export readyAnswers');

        $superAdmin->givePermissionTo('see users');
        $superAdmin->givePermissionTo('see user');
        $superAdmin->givePermissionTo('edit user');
        $superAdmin->givePermissionTo('add user');
        $superAdmin->givePermissionTo('delete user');
        $superAdmin->givePermissionTo('import users');
        $superAdmin->givePermissionTo('export users');

        $superAdmin->givePermissionTo('see roles');
        $superAdmin->givePermissionTo('edit role');
        $superAdmin->givePermissionTo('add role');
        $superAdmin->givePermissionTo('delete role');
        $superAdmin->givePermissionTo('show rolePermissions');
        $superAdmin->givePermissionTo('edit rolePermissions');

        $superAdmin->givePermissionTo('see tickets');
        $superAdmin->givePermissionTo('see ticket');
        $superAdmin->givePermissionTo('answer ticket');
        $superAdmin->givePermissionTo('add ticket');
        $superAdmin->givePermissionTo('close ticket');

        $superAdmin->givePermissionTo('make report');

    }
}
