<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
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
        $permissions = [
            [
                'name'=>'create task',
                'guard_name'=>'web',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'name'=>'read task',
                'guard_name'=>'web',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'name'=>'update task',
                'guard_name'=>'web',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'name'=>'delete task',
                'guard_name'=>'web',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'name'=>'assign task',
                'guard_name'=>'web',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'name'=>'start task',
                'guard_name'=>'web',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'name'=>'complete task',
                'guard_name'=>'web',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'name'=>'create user',
                'guard_name'=>'web',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'name'=>'read user',
                'guard_name'=>'web',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'name'=>'update user',
                'guard_name'=>'web',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'name'=>'delete user',
                'guard_name'=>'web',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
        ];

        Permission::insert($permissions);
    }
}
