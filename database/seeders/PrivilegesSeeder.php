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
        // $permissions = [
        //     'ver patio',
        //     'ver oficina',
        //     'prestar patio',
        //     'prestar oficina',
        // ];
        $permissions = [
            'OT SISTEMA VISOR',
            'OT SISTEMA PRESTA',
            'OT PATIO MRO VISOR',
            'OT PATIO MRO PRESTA',
            'FISCOMEX SISTEMAS VISOR',
            'FISCOMEX SISTEMAS PRESTA',
            'FISCOMEX PATIO VISOR',
            'FISCOMEX PATIO PRESTA',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // $visorPatioRole = Role::firstOrCreate(['name' => 'visor_patio']);
        // $visorOficinaRole = Role::firstOrCreate(['name' => 'visor_oficina']);
        // $prestaOficinaRole = Role::firstOrCreate(['name' => 'presta_oficina']);
        // $prestaPatioRole = Role::firstOrCreate(['name' => 'presta_patio']);

        $vis_ot_sis = Role::firstOrCreate(['name' => 'OT SISTEMA VISOR']);
        $pre_ot_sis = Role::firstOrCreate(['name' => 'OT SISTEMA PRESTA']);
        $vis_ot_patio = Role::firstOrCreate(['name' => 'OT PATIO MRO VISOR']);
        $pre_ot_patio = Role::firstOrCreate(['name' => 'OT PATIO MRO PRESTA']);
        $vis_fis_sis = Role::firstOrCreate(['name' => 'FISCOMEX SISTEMAS VISOR']);
        $pre_fis_sis = Role::firstOrCreate(['name' => 'FISCOMEX SISTEMAS PRESTA']);
        $vis_fis_patio = Role::firstOrCreate(['name' => 'FISCOMEX PATIO VISOR']);
        $pre_fis_patio = Role::firstOrCreate(['name' => 'FISCOMEX PATIO PRESTA']);
        $adminRole = Role::firstOrCreate(['name' => 'ADMIN']);

        $vis_ot_sis->syncPermissions(['OT SISTEMA VISOR']);
        $pre_ot_sis->syncPermissions(['OT SISTEMA PRESTA']);
        $vis_ot_patio->syncPermissions(['OT PATIO MRO VISOR']);
        $pre_ot_patio->syncPermissions(['OT PATIO MRO PRESTA']);
        $vis_fis_sis->syncPermissions(['FISCOMEX SISTEMAS VISOR']);
        $pre_fis_sis->syncPermissions(['FISCOMEX SISTEMAS PRESTA']);
        $vis_fis_patio->syncPermissions(['FISCOMEX PATIO VISOR']);
        $pre_fis_patio->syncPermissions(['FISCOMEX PATIO PRESTA']);
        $adminRole->syncPermissions(Permission::all());

        // $visorPatioRole->syncPermissions(['ver patio']);
        // $visorOficinaRole->syncPermissions(['ver oficina']);
        // $prestaOficinaRole->syncPermissions(['prestar oficina']);
        // $prestaPatioRole->syncPermissions(['prestar patio']);

        $adminUser = User::firstOrCreate(
            ['email' => 'ojrzsrmnt@gmail.com'],
            [
                'name' => 'Administrador',
                'password' => Hash::make('qwerty'),
            ]
        );

        $adminUser->assignRole($adminRole);
        // $userVisorPatio->assignRole($visorPatioRole);
        // $userVisorOficina->assignRole($visorOficinaRole);
        // $userPrestaOficina->assignRole($prestaOficinaRole);
        // $userPrestaPatio->assignRole($prestaPatioRole);
    }
}
