<?php

namespace App\Http\Controllers;

use Tests\TestCase;
use App\Models\User;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tymon\JWTAuth\Facades\JWTAuth;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_store_task()
    {
        $user = User::factory()->create();

        $token = JWTAuth::fromUser($user);

        $taskData = [
            'judul' => 'Test Task',
            'deskripsi' => 'This is a test description',
            'selesai' => false,
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->postJson('/api/v1/tasks', $taskData);

        $response->assertStatus(201);

        $this->assertDatabaseHas('tasks', [
            'judul' => 'Test Task',
            'deskripsi' => 'This is a test description',
            'selesai' => false,
            'user_id' => $user->id,
        ]);

        $response->assertJsonStructure([
            'success',
            'task' => [
                'id',
                'judul',
                'deskripsi',
                'selesai',
                'created_at',
                'updated_at',
            ]
        ]);
    }
}
