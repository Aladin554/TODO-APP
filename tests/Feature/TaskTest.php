<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    public function test_can_create_task()
    {
        Sanctum::actingAs($this->user, ['*']);

        $response = $this->postJson('/api/tasks', [
            'title' => 'Test Task',
            'body' => 'Test Body',
        ], ['Accept' => 'application/json']);

        $response->assertStatus(201);
        $this->assertDatabaseHas('tasks', ['title' => 'Test Task']);
    }

    public function test_can_update_task()
    {
        Sanctum::actingAs($this->user, ['*']);
        $task = Task::factory()->create(['user_id' => $this->user->id]);

        $response = $this->putJson("/api/tasks/{$task->id}", [
            'title' => 'Updated Task',
            'body' => 'Updated Body',
            'completed' => true,
        ], ['Accept' => 'application/json']);

        $response->assertStatus(200);
        $this->assertDatabaseHas('tasks', ['title' => 'Updated Task', 'completed' => true]);
    }

    public function test_can_delete_task()
    {
        Sanctum::actingAs($this->user, ['*']);
        $task = Task::factory()->create(['user_id' => $this->user->id]);

        $response = $this->deleteJson("/api/tasks/{$task->id}", [], ['Accept' => 'application/json']);

        $response->assertStatus(204);
        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }

    public function test_validation_fails_without_title()
    {
        Sanctum::actingAs($this->user, ['*']);

        $response = $this->postJson('/api/tasks', [
            'body' => 'Test Body',
        ], ['Accept' => 'application/json']);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('title');
    }
}