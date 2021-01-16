<?php 

namespace App\Database\Seeds;

class UserSeeder extends \CodeIgniter\Database\Seeder
{
    public function run()
    {
        $users = [
            [
                'name' => 'User',
                'email'    => 'user@cidemo.com',
                'password' => password_hash('user@123', PASSWORD_DEFAULT),
                'is_super_admin' => false,
            ],
            [
                'name' => 'Admin',
                'email'    => 'admin@cidemo.com',
                'password' => password_hash('admin@123', PASSWORD_DEFAULT),
                'is_super_admin' => false,
            ],
            [
                'name' => 'Super Admin',
                'email'    => 'superadmin@cidemo.com',
                'password' => password_hash('superadmin@123', PASSWORD_DEFAULT),
                'is_super_admin' => true,
            ],
        ];

        foreach($users as $user) {
            $this->db->table('users')->insert($user);
        }
    }
}