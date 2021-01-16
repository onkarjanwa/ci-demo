<?php 

namespace App\Database\Seeds;

class SubjectAccessSeeder extends \CodeIgniter\Database\Seeder
{
    public function run()
    {
        $userId = (int)$this->db->query("select id from users where email='admin@cidemo.com' limit 1")->getRow()->id;
        $subjectId = (int)$this->db->query("select id from subjects where name='Sports' limit 1")->getRow()->id;
        
        $subjectAccesses = [
            [
                'subject_id' => $subjectId,
                'user_id' => $userId,
                'access_type' => 'admin'
            ],
        ];

        foreach($subjectAccesses as $subjectAccess) {
            $this->db->table('subject_accesses')->insert($subjectAccess);
        }
    }
}