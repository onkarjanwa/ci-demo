<?php 

namespace App\Database\Seeds;

class SubjectSeeder extends \CodeIgniter\Database\Seeder
{
    public function run()
    {
        $subjects = [
            [
                'name' => 'Sports',
            ],
            [
                'name' => 'Politics',
            ],
            [
                'name' => 'AI / ML',
            ],
        ];

        foreach($subjects as $subject) {
            $this->db->table('subjects')->insert($subject);
        }
    }
}