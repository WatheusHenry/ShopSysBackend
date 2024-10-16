<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'seller_id',
        'commission'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }
}
