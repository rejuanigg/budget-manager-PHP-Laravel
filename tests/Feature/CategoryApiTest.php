<?php

use App\Models\Category;
use App\Models\User;
use App\Models\Transaction;

use function Pest\Laravel\assertDatabaseHas;

test('Test Store Categories', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)
    ->postJson(
        'api/categories',
        [
        'name' => 'Test',
        'user_id' => $user->id
        ]
    );

    $response->assertStatus(201);
});

test('Test Update Categories', function() {
    $user = User::factory()->create();

    $category = Category::create([
        'name' => 'Test',
        'user_id' => $user->id
    ]);

    $resource = $this->actingAs($user)
    ->patchJson(
        "api/categories/{$category->id}",
        [
        'name' => 'TestCHANGE',
        ]
    );

    $resource->assertStatus(200);

    assertDatabaseHas('categories', ['name' => 'TestCHANGE']);

});

test('Test Destroy Categories', function(){
    $user = User::factory()->create();

    $category = Category::create([
        'name' => 'Test',
        'user_id' => $user->id
    ]);

    $response = $this->actingAs($user)
    ->deleteJson("api/categories/{$category->id}");

    $response->assertStatus(204);

});
