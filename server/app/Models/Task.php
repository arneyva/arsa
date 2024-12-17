<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'is_completed',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function scopeFilterStatus($query, $status)
    {
        if ($status === 'completed') {
            return $query->where('is_completed', true);
        } elseif ($status === 'pending') {
            return $query->where('is_completed', false);
        }
        return $query;
    }
}
