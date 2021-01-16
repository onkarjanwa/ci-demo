<?php 

namespace App\Database\Seeds;

class MessageSeeder extends \CodeIgniter\Database\Seeder
{
    public function run()
    {
        $userAId = (int)$this->db->query("select id from users where email='user@cidemo.com' limit 1")->getRow()->id;
        $userBId = (int)$this->db->query("select id from users where email='admin@cidemo.com' limit 1")->getRow()->id;
        $subjectAId = (int)$this->db->query("select id from subjects where name='Sports' limit 1")->getRow()->id;
        $subjectBId = (int)$this->db->query("select id from subjects where name='Politics' limit 1")->getRow()->id;

        $messages = [
            [
                'text' => 'Text A',
                'subject_id' => $subjectAId,
                'user_id' => $userAId,
                'status' => 'active'
            ],
            [
                'text' => 'Text B',
                'subject_id' => $subjectAId,
                'user_id' => $userBId,
                'status' => 'active'
            ],
            [
                'text' => 'Text C',
                'subject_id' => $subjectBId,
                'user_id' => $userAId,
                'status' => 'active'
            ],
        ];

        foreach($messages as $message) {
            $this->db->table('messages')->insert($message);
        }
    }
}