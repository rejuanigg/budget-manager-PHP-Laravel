<?php

namespace App\Services;

use App\Models\Transaction;

class TransactionService
{
    public function store (array $data, int $userId): Transaction
    {
        $data['user_id'] = $userId;
        return Transaction::create($data);
    }

    public function update(Transaction $transaction, array $data): Transaction
    {
        $transaction->update($data);
        return $transaction;
    }

    public function destroy(Transaction $transaction): void
    {
        $transaction->delete();
    }
}

?>
