<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccessManagementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Users

        DB::table('admin_users')->insert([/* id => 1 */'name' => 'Administrator', 'username' => 'admin', 'password' => bcrypt('admin')]);
        DB::table('admin_users')->insert([/* id => 2 */'name' => 'Manager', 'username' => 'manager', 'password' => bcrypt('manager')]);


        // Roles

        DB::table('admin_roles')->insert([/* id => 1 */'name' => 'Administrator', 'slug' => 'administrator']);
        DB::table('admin_roles')->insert([/* id => 2 */'name' => 'Gestor de información', 'slug' => 'info_manager']);

        DB::table('admin_role_users')->insert(['role_id' => 1, 'user_id' => 1]);
        DB::table('admin_role_users')->insert(['role_id' => 2, 'user_id' => 2]);


        // Permissions

        DB::table('admin_permissions')->insert([/* id => 1 */'name' => 'Todos los permisos', 'slug' => '*', 'http_method' => '', 'http_path' => '*']);
        DB::table('admin_permissions')->insert([/* id => 2 */'name' => 'Dashboard', 'slug' => 'dashboard', 'http_method' => 'GET', 'http_path' => '/']);
        DB::table('admin_permissions')->insert([/* id => 3 */'name' => 'Login', 'slug' => 'auth.login', 'http_method' => '', 'http_path' => '/auth/login' . "\n" . '/auth/logout']);
        DB::table('admin_permissions')->insert([/* id => 4 */'name' => 'Editar perfil', 'slug' => 'auth.setting', 'http_method' => 'GET,PUT', 'http_path' => '/auth/setting']);
        DB::table('admin_permissions')->insert([/* id => 5 */'name' => 'Administrar accesos', 'slug' => 'auth.management', 'http_method' => '', 'http_path' => '/auth/roles' . "\n" . '/auth/permissions' . "\n" . '/auth/menu' . "\n" . '/auth/logs']);
        DB::table('admin_permissions')->insert([/* id => 6 */'name' => 'Gestionar información', 'slug' => 'info.management', 'http_method' => '', 'http_path' => '/api*']);

        DB::table('admin_role_permissions')->insert(['role_id' => 1, 'permission_id' => 1]);
        DB::table('admin_role_permissions')->insert(['role_id' => 2, 'permission_id' => 2]);
        DB::table('admin_role_permissions')->insert(['role_id' => 2, 'permission_id' => 4]);
        DB::table('admin_role_permissions')->insert(['role_id' => 2, 'permission_id' => 6]);


        // Menu

        DB::table('admin_menu')->insert([/* id => 1 */'parent_id' => 0, 'order' => 1, 'title' => 'Dashboard', 'icon' => 'fa-bar-chart', 'uri' => '/']);
        DB::table('admin_menu')->insert([/* id => 2 */'parent_id' => 0, 'order' => 2, 'title' => 'Administración', 'icon' => 'fa-tasks', 'uri' => '']);
        DB::table('admin_menu')->insert([/* id => 3 */'parent_id' => 2, 'order' => 3, 'title' => 'Usuarios', 'icon' => 'fa-users', 'uri' => 'auth/users']);
        DB::table('admin_menu')->insert([/* id => 4 */'parent_id' => 2, 'order' => 4, 'title' => 'Roles', 'icon' => 'fa-user', 'uri' => 'auth/roles']);
        DB::table('admin_menu')->insert([/* id => 5 */'parent_id' => 2, 'order' => 5, 'title' => 'Permisos', 'icon' => 'fa-ban', 'uri' => 'auth/permissions']);
        DB::table('admin_menu')->insert([/* id => 6 */'parent_id' => 2, 'order' => 6, 'title' => 'Menú', 'icon' => 'fa-bars', 'uri' => 'auth/menu']);
        DB::table('admin_menu')->insert([/* id => 7 */'parent_id' => 2, 'order' => 7, 'title' => 'Logs de Operaciones', 'icon' => 'fa-history', 'uri' => 'auth/logs']);
        DB::table('admin_menu')->insert([/* id => 8 */'parent_id' => 0, 'order' => 8, 'title' => 'Proyectos', 'icon' => 'fa-folder-open', 'uri' => 'api/projects']);
        DB::table('admin_menu')->insert([/* id => 9 */'parent_id' => 0, 'order' => 9, 'title' => 'Normas', 'icon' => 'fa-book', 'uri' => 'api/standards']);
        DB::table('admin_menu')->insert([/* id => 10 */'parent_id' => 0, 'order' => 10, 'title' => 'Vehículos', 'icon' => 'fa-car', 'uri' => 'api/']);
        DB::table('admin_menu')->insert([/* id => 11 */'parent_id' => 10, 'order' => 11, 'title' => 'Números de Placas', 'icon' => 'fa-list', 'uri' => 'api/no-placas']);
        DB::table('admin_menu')->insert([/* id => 12 */'parent_id' => 10, 'order' => 12, 'title' => 'Bombas de Abastecimiento', 'icon' => 'fa-list', 'uri' => 'api/bombas-abastecimiento']);
        DB::table('admin_menu')->insert([/* id => 13 */'parent_id' => 10, 'order' => 13, 'title' => 'Sistemas de Amortiguación', 'icon' => 'fa-list', 'uri' => 'api/sistemas-amortiguacion']);
        DB::table('admin_menu')->insert([/* id => 14 */'parent_id' => 10, 'order' => 14, 'title' => 'Estados de Medición', 'icon' => 'fa-list', 'uri' => 'api/estados-medicion']);

        DB::table('admin_role_menu')->insert(['role_id' => 1, 'menu_id' => 2]);
        // DB::table('admin_role_menu')->insert(['role_id' => 2, 'menu_id' => 8]);
        // DB::table('admin_role_menu')->insert(['role_id' => 2, 'menu_id' => 9]);
    }
}
