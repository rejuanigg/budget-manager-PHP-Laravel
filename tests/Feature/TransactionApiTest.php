<?php
use App\Models\User;
use App\Models\Category;

test('Test Store Transaction API', function () {
    $user = User::factory()->create();

    $category = Category::create([
    'name' => 'Test',
    'user_id' => $user->id
    ]);

    $response = $this->actingAs($user)
    ->postJson(
        'api/transactions',
        [
            'transaction_date' => '2023-02-02',
            'type' => 'expense',
            'detail' => 'Testing Api',
            'amount' => '9999',
            'category_id' => $category->id
        ]
    );

    $response->assertStatus(201);
});
