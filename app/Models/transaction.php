<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;

class Transaction extends Model
{
    public function category():BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

        public function scopeExpenses (Builder $query): void
    {
        $query->where('type', 'expense');
    }

    public function scopeIncomes (Builder $query): void
    {
        $query->where('type', 'income');
    }

    protected $fillable = [
        'user_id',
        'transaction_date',
        'type',
        'detail',
        'amount',
        'category_id'
    ];
};
