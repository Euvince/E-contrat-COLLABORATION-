<?php

namespace Database\Seeders;
use App\Models\Role;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'Administrateur',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Ufr',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Manager',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Chef de Département',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Comptabilité',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Programmation',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Assistant Programmation',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Personnel',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Assistant Personnel',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Responsable',
                'guard_name' => 'web',
            ],
        ];

        foreach ($roles as $role) {

            Role::create([
                'name' => $role['name'],
                'guard_name' => $role['guard_name'],
            ]);
        }
    }
}
