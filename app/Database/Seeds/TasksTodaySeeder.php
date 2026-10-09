<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TasksTodaySeeder extends Seeder
{
    public function run()
    {
        $today = date('Y-m-d');
        $yesterday = date('Y-m-d', strtotime('-1 day'));
        $twoDaysAgo = date('Y-m-d', strtotime('-2 days'));
        $tomorrow = date('Y-m-d', strtotime('+1 day'));
        $createdAt = date('Y-m-d H:i:s');

        $tasksTable = $this->db->table('tasks');
        if ($tasksTable->countAllResults() === 0) {
            $tasksTable->insertBatch([
                ['title' => 'Review today’s sales summary', 'status' => 'pending', 'task_date' => $today, 'created_at' => $createdAt],
                ['title' => 'Confirm the morning inventory count', 'status' => 'in_progress', 'task_date' => $today, 'created_at' => $createdAt],
                ['title' => 'Send the daily team update', 'status' => 'completed', 'task_date' => $today, 'created_at' => $createdAt],
                ['title' => 'Check the delivery schedule', 'status' => 'pending', 'task_date' => $yesterday, 'created_at' => $createdAt],
                ['title' => 'Organize supplier receipts', 'status' => 'completed', 'task_date' => $yesterday, 'created_at' => $createdAt],
                ['title' => 'Prepare the weekly report', 'status' => 'pending', 'task_date' => $twoDaysAgo, 'created_at' => $createdAt],
                ['title' => 'Update the product checklist', 'status' => 'in_progress', 'task_date' => $tomorrow, 'created_at' => $createdAt],
                ['title' => 'Plan the next stock review', 'status' => 'pending', 'task_date' => $tomorrow, 'created_at' => $createdAt],
            ]);
        }

        $usersTable = $this->db->table('users');
        $demoPassword = password_hash('TasksDemo2026!', PASSWORD_DEFAULT);
        $existingUser = $usersTable->where('username', 'johneinstein')->get()->getRowArray();
        if ($existingUser === null) {
            $usersTable->insert([
                'username' => 'johneinstein',
                'full_name' => 'John Einstein Sison',
                'email' => 'john.einstein@example.test',
                'password' => $demoPassword,
                'created_at' => $createdAt,
            ]);
        } else {
            $usersTable->where('id', $existingUser['id'])->update(['password' => $demoPassword]);
        }
    }
}
