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
            'OT SISTEMA VISOR',
            'OT SISTEMA PRESTA',
            'OT PATIO MRO VISOR',
            'OT PATIO MRO PRESTA',
            'FISCOMEX SISTEMAS VISOR',
            'FISCOMEX SISTEMAS PRESTA',
            'FISCOMEX PATIO VISOR',
            'FISCOMEX PATIO PRESTA',
            'LOANS ADMIN',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $vis_ot_sis = Role::firstOrCreate(['name' => 'OT SISTEMA VISOR']);
        $pre_ot_sis = Role::firstOrCreate(['name' => 'OT SISTEMA PRESTA']);
        $vis_ot_patio = Role::firstOrCreate(['name' => 'OT PATIO MRO VISOR']);
        $pre_ot_patio = Role::firstOrCreate(['name' => 'OT PATIO MRO PRESTA']);
        $vis_fis_sis = Role::firstOrCreate(['name' => 'FISCOMEX SISTEMAS VISOR']);
        $pre_fis_sis = Role::firstOrCreate(['name' => 'FISCOMEX SISTEMAS PRESTA']);
        $vis_fis_patio = Role::firstOrCreate(['name' => 'FISCOMEX PATIO VISOR']);
        $pre_fis_patio = Role::firstOrCreate(['name' => 'FISCOMEX PATIO PRESTA']);
        $adminRole = Role::firstOrCreate(['name' => 'ADMIN']);
        $loanadminRole = Role::firstOrCreate(['name' => 'LOANS ADMIN']);

        $vis_ot_sis->syncPermissions(['OT SISTEMA VISOR']);
        $pre_ot_sis->syncPermissions(['OT SISTEMA PRESTA']);
        $vis_ot_patio->syncPermissions(['OT PATIO MRO VISOR']);
        $pre_ot_patio->syncPermissions(['OT PATIO MRO PRESTA']);
        $vis_fis_sis->syncPermissions(['FISCOMEX SISTEMAS VISOR']);
        $pre_fis_sis->syncPermissions(['FISCOMEX SISTEMAS PRESTA']);
        $vis_fis_patio->syncPermissions(['FISCOMEX PATIO VISOR']);
        $pre_fis_patio->syncPermissions(['FISCOMEX PATIO PRESTA']);
        $adminRole->syncPermissions(Permission::all());
        $loanadminRole->syncPermissions(['LOANS ADMIN']);

        $adminUser = User::firstOrCreate(
            ['email' => 'ojrzsrmnt@gmail.com'],
            [
                'name' => 'Octavio',
                'password' => Hash::make('qwerty'),
            ]
        );
        $adminUser2 = User::firstOrCreate(
            ['email' => 'dsantiago@one-touch.com.mx'],
            [
                'name' => 'Daniel',
                'password' => Hash::make('fisco2020'),
            ]
        );
        $adminUser3 = User::firstOrCreate(
            ['email' => 'missael@fiscomexmxli.com'],
            [
                'name' => 'Missael',
                'password' => Hash::make('fiscomex123'),
            ]
        );
        $loanAdmin = User::firstOrCreate(
            ['email' => 'correo@correo.com'],
            [
                'name' => 'Autorizador',
                'password' => Hash::make('qwerty'),
            ]
        );

        $adminUser->assignRole($adminRole);
        $adminUser2->assignRole($adminRole);
        $adminUser3->assignRole($adminRole);
        $loanAdmin->assignRole($loanadminRole);
    }
}
