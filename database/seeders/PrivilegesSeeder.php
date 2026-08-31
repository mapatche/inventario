<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PrivilegesSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        $permissions = [
            'ver patio',
            'ver oficina',
            'prestar patio',
            'prestar oficina',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $visorPatioRole = Role::firstOrCreate(['name' => 'visor_patio']);
        $visorOficinaRole = Role::firstOrCreate(['name' => 'visor_oficina']);
        $prestaOficinaRole = Role::firstOrCreate(['name' => 'presta_oficina']);
        $prestaPatioRole = Role::firstOrCreate(['name' => 'presta_patio']);

        $adminRole->syncPermissions(Permission::all());
        $visorPatioRole->syncPermissions(['ver patio']);
        $visorOficinaRole->syncPermissions(['ver oficina']);
        $prestaOficinaRole->syncPermissions(['prestar oficina']);
        $prestaPatioRole->syncPermissions(['prestar patio']);

        $adminUser = User::firstOrCreate(
            ['email' => 'ojrzsrmnt@gmail.com'],
            [
                'name' => 'Administrador',
                'password' => Hash::make('qwerty'),
            ]
        );

        $userVisorPatio = User::firstOrCreate(
            ['email' => 'visor@patio.com'],
            [
                'name' => 'Patioman',
                'password' => Hash::make('qwerty'),
            ]
        );

        $userVisorOficina = User::firstOrCreate(
            ['email' => 'visor@oficina.com'],
            [
                'name' => 'Oficinaman',
                'password' => Hash::make('qwerty'),
            ]
        );

        $userPrestaOficina = User::firstOrCreate(
            ['email' => 'presta@oficina.com'],
            [
                'name' => 'PrestaOficina',
                'password' => Hash::make('qwerty'),
            ]
        );

        $userPrestaPatio = User::firstOrCreate(
            ['email' => 'presta@patio.com'],
            [
                'name' => 'PrestaPatio',
                'password' => Hash::make('qwerty'),
            ]
        );

        $adminUser->assignRole($adminRole);
        $userVisorPatio->assignRole($visorPatioRole);
        $userVisorOficina->assignRole($visorOficinaRole);
        $userPrestaOficina->assignRole($prestaOficinaRole);
        $userPrestaPatio->assignRole($prestaPatioRole);
    }
}
