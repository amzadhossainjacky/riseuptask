<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuthorPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'article_id',
        'payment_amount',
        'payment_status',
    ];
}
