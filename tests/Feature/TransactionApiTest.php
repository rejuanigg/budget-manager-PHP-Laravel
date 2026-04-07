<?php
use App\Models\User;
use App\Models\Category;
use App\Models\Transaction;

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

test('Test Destroy Transaction API', function(){
    $user = User::factory()->create();

    $category = Category::create([
    'name' => 'Test',
    'user_id' => $user->id
    ]);

    $transaction = Transaction::create([
        'user_id' => $user->id,
        'transaction_date' => '2023-02-02',
        'type' => 'expense',
        'detail' => 'Testing Api',
        'amount' => '9999',
        'category_id' => $category->id
    ]);

    $response = $this->actingAs($user)
    ->deleteJson("api/transactions/{$transaction->id}");

    $response->assertStatus(204);
});
