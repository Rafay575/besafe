<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserRolesAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // $roles = Role::all();
        // foreach ($roles as $role) {
        //     $role->delete();
        // }

        $subModules = [
            'user',
            'role',
            'permission',
            'unsafe_behavior',
            'hazard',
            'near_miss',
            'fire_property_damage',
            'injury',
            'ptw',
            'ie_audit_cluase',
            'ie_audit_question',
            'ie_audit_type',
            'designation',
            'line',
            'department',
            'risk_level',
            'incident_status',
            'unsafe_behavior_type',
            'incident_category',
            'injury_category',
            'ptw_type',
            'ptw_item',
            'property_damage',
            'audit_hall',
            'audit_type',
            'immediate_cause',
            'basic_cuase',
            'root_cause',
            'fire_property_damage',
            'contact_type',
            'meta_data',
            'report',
            'setting',
            'dashboard'
        ];
        $subModulesAssociative = array_combine($subModules, array_map(function ($value) {
            $words = explode('_', $value);
            $capitalizedWords = array_map(function ($word) {
                return ucfirst($word);
            }, $words);
            return implode(' ', $capitalizedWords);
        }, $subModules));

        $roles = ['worker', 'sp', 'hod', 'admin'];
        $permissions = ['index', 'create', 'view', 'edit', 'delete'];

        // craeting roles
        foreach ($roles as $role) {
            $dbRole = Role::where('name', $role)->first();
            if ($dbRole)
                continue;
            Role::create(['name' => $role]);
        }

        // creating prmission
        foreach ($subModulesAssociative as $key => $value) {
            foreach ($permissions as $permission) {
                // permssino like hazard.show
                $permissionName = $key . "." . $permission;
                $permission = Permission::where('name', $permissionName)->first();
                if ($permission)
                    continue;
                Permission::create(['name' => $permissionName]);
            }
        }

        // assiging permissions to roles

        $roles = Role::all();
        $permissions = Permission::all();

        foreach ($roles as $role) {
            if ($role->name === "admin") {
                $role->givePermissionTo(...$permissions);
            }

            if ($role->name === 'level_1') {
                foreach ($role->permissions as $permission) {
                    if (strpos($permission->name, '.index') !== false || strpos($permission->name, '.create') !== false) {
                        $role->givePermissionTo($permission);
                    }
                }
            }

            if ($role->name === 'level_2') {
                foreach ($permissions as $permission) {
                    $permissionName = $permission->name;
                    if (strpos($permissionName, '.index') !== false || strpos($permissionName, '.create') !== false || strpos($permissionName, '.edit') !== false) {
                        $role->givePermissionTo($permission);
                    }
                }
            }
        }


    }
}