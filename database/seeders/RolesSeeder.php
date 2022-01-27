<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::truncate();

        $roles =  [
            [
              'role_id' => '1',
              'role_name' => 'SuperAdmin',
            ],
            [
                'role_id' => '2',
                'role_name' => 'Admin',
            ],
            [
                'role_id' => '3',
                'role_name' => 'Inventory manager',
            ],
            [
                'role_id' => '4',
                'role_name' => 'Order manager',
            ],
            [
                'role_id' => '5',
                'role_name' => 'Customer',
            ]
          ];

          Role::insert($roles);

    }
}
